<?php
    // Vehicle parks on ParkingSpot
    // Vehicle should have ability to be registered

    // Import the interface that each model implements
    include_once 'model_interface.php';

    // Owner needs to be able to register as a user
    // Owner needs to be able to register a vehicle
    // Owner owns vehicles -- need to assign a registered vehicle to a registered user
    class Vehicle implements model_interface {
        private $conn; // The connection to the database
        private $table = "vehicle"; // The name of the table in the mySQL database

        // Owner Attributes -- the attributes of the table in the mySQL database
        private $attr = array(
            "plate"   => "",
            "make"  => "",
            "model"   => "",
            "year"  => "",
            "color"  => "",
        );

        // Construct Owner with a connection to a database
        public function __construct($db_conn) {
            $this->conn = $db_conn;
        }

        /* Create an entry in the table for this Owner
            This function makes one tuple in the table */
        public function create() {
            // Create query
            $query = "INSERT INTO " . $this->table . 
                " SET Plate = :plate, Make = :make, Model = :model, Year = :year, Color = :color";

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean the data (reduce malicious SQL injection, etc.)
            foreach ($this->attr as $key => $value) {
                $this->attr[$key] = htmlspecialchars(strip_tags($value));
            }
            
            // Bind the data to a variable for an SQL attribute
            foreach ($this->attr as $key => $value) {
                $stmt->bindValue((":" . $key), $value);
            }

            // Execute the prepared statement and check for errors in running it
            return $this->runPrepStmtChkErr($stmt);
        }

        /* Get all owners' details */
        public function read() {
            // Create query
            $query = "SELECT * FROM " . $this->table;

            // Prepare the statement
            $stmt = $this->conn->prepare($query);

            // Execute the prepared statement and check for errors in running it
            if ($this->runPrepStmtChkErr($stmt) === false) {
                return false;
            }

            // Return all rows of the table
            // Note: 'PDO::FETC_ASSOC' means only the associative, 
                // and not positional (numerically indexed) array will be returned
            return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        /* Get one owner's details. 
            Expecting 'oid' to be set before running this function */
        public function read_single() {
            // Create query
            $query = "SELECT * FROM " . $this->table . 
                " WHERE Plate = :plate";

            // Prepare the statement
            $stmt = $this->conn->prepare($query);

            // Clean the query
            $this->attr["plate"] = htmlspecialchars(strip_tags($this->attr["plate"]));

            // Bind the data
            $stmt->bindValue(":plate", $this->attr["plate"]);
            
            // Execute the prepared statement and check for errors in running it
            if ($this->runPrepStmtChkErr($stmt) === false) {
                return false;
            }

            // Get the result of reading one of the rows of the relation
            return $row_res = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        /* Update this owner in the database
            Expecting 'oid' and other properties to be set before running this function 
            This function will find an owner with 'oid' and change all
            attributes to match this object's properties.
            If a property is empty, then that property will not be updated
            in the database.
            Note & TODO: This will cause issues with other relations */
        public function update() {
            // Get the values that are currently in the database
            $curr_vals = $this->read_single();

            // Set the values that will be added to the table
            foreach ($curr_vals as $key => $value) {
                // Convert key from the Database's capitalization to
                // this model's attribute capitalization style (all lowercase)
                $local_key = strtolower($key);
                // If user didn't specify property
                if ($this->attr[$local_key] === "") {
                    // Then use the value that's already in the database
                    $this->attr[$local_key] = $curr_vals[$key];
                }
            }

            // Create query
            $query = "UPDATE " . $this->table .
                " SET Make = :make, Model = :model, Year = :year, Color = :color " .
                " WHERE Plate = :plate";

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean the data (reduce malicious SQL injection, etc.)
            foreach ($this->attr as $key => $value) {
                $this->attr[$key] = htmlspecialchars(strip_tags($value));
            }
            
            // Bind the data to a variable for an SQL attribute
            foreach ($this->attr as $key => $value) {
                $stmt->bindValue((":" . $key), $value);
            }

            // Execute the prepared statement and check for errors in running it
            return $this->runPrepStmtChkErr($stmt);
        }

        /* Delete this owner from the database 
            Expecting 'oid' to be set before running this function 
            Note & TODO: This will cause issues with other relations */
            // TODO: Probably need to delete stuff from other tables too.
            // How does deleting an owner from the table effect the log? Etc.
        public function delete() {
            // Create query
            $query = "DELETE FROM " . $this->table .
                " WHERE Plate = :plate";
                
            // Prepare the statement
            $stmt = $this->conn->prepare($query);

            // Clean the query
            $this->attr["plate"] = htmlspecialchars(strip_tags($this->attr["plate"]));

            // Bind the data
            $stmt->bindValue(":plate", $this->attr["plate"]);
            
            // Execute the prepared statement and check for errors in running it
            return $this->runPrepStmtChkErr($stmt);
        }

        /* Assign values to Owner properties from the supplied array of data */
        /* Assumes the array of attributes passed in is appropriate for this class,
            meaning position 0 correlates with the first attribute in this class's 
            array of properties */
        public function fillAttributes($attr_arr) {
            // If $attr_arr is an associative array, convert it to numerically indexed
            // If it's a numerically indexed array, treat it the same
            $index_keys = array_keys($attr_arr);
            foreach ($index_keys as $num => $val) {
              $attr_to_add = $attr_arr[$val];
              /* echo "index_keys is $val \n"; */
              foreach ($this->attr as $key => $value) {
                /* echo "this->key is $key and index_keys is $val \n"; */
                if ($attr_to_add and $key === $val) {
                    $this->attr[$key] = $attr_to_add;
                    break 1;
                }
              }    
            }
        }

         /* Assign values to Owner properties from the supplied array of data */
        /* Assumes the array of attributes passed in is appropriate for this class,
            meaning position 0 correlates with the first attribute in this class's 
            array of properties */
            public function fillCsv($attr_arr) {
                // If $attr_arr is an associative array, convert it to numerically indexed
                // If it's a numerically indexed array, treat it the same
                $index_keys = array_keys($attr_arr);
                $i = 0;
                foreach ($this->attr as $key => $value) {
                    $this->attr[$key] = $attr_arr[$index_keys[$i]];
                    $i++;
                }
            }       

        /* Execute the prepared statement and return any errors 
        Note that 'stmt' is passed by reference */
        private function runPrepStmtChkErr(&$stmt) {
            // Execute the query
            if($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            echo "\nPDOStatement::errorInfo():\n";
            $err_arr = $stmt->errorInfo();
            print_r($err_arr);

            return false;
        }

        /* Get the name of the table in the database that this class is modeling */
        public function getTableName() {
            return $this->table;
        }
        /* Get Attribute */
        public function getAttr($name) {
            return $this->attr[$name];
        }
        /* Set attribute */
        public function setAttr($name, $val) {
            $this->attr[$name] = $val;
        }
    }

