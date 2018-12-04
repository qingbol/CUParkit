<?php
    /* Jack Tabb
     * 11/1/2018
    */

    // Import the interface that each model implements
    include_once 'model_interface.php';
    // Import Composer
    // require_once '../bin/vendor/autoload.php';
    require_once __DIR__ . '/../bin/vendor/autoload.php';
    // Use the library for checking strength of passwords
    use ZxcvbnPhp\Zxcvbn;

    // Owner needs to be able to register as a user
    // Owner needs to be able to register a vehicle
    // Owner owns vehicles -- need to assign a registered vehicle to a registered user
    class Owner implements model_interface {
        private $msg; // Message to communicate to API

        private $conn; // The connection to the database
        private $table = "owner"; // The name of the table in the mySQL database

        // Owner Attributes -- the attributes of the table in the mySQL database
        private $attr = array(
            "oid"   => "",
            "name"  => "",
            "tel"   => "",
            "type"  => "",
            "pass"  => "",
        );

        //used for pagination data
        private $pageInfo = array(
            "pageSeq" => "1",
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
                " SET OID = :oid, Name = :name, Tel = :tel, Type = :type, Password = :pass";

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean the data (reduce malicious SQL injection, etc.)
            $orig_pass = $this->attr['pass'];
            foreach ($this->attr as $key => $value) {
                $this->attr[$key] = htmlspecialchars(strip_tags($value));
            }

            // Password Handling
            /////////////////////////////////////////////////////////////////////
                // Check if password was modified by stripping HTML Special chars
                if ($orig_pass !== $this->attr['pass']) {
                    $this->msg = "ERROR: Password cannot contain: (&, \", ', >, <)";
                    return false;
                }

                // Ensure that the password has at least one capital letter
                // Get a version of the password with all lowercase letters
                $lower_pass = strtolower($this->attr['pass']);
                if ($lower_pass === $this->attr['pass']) {
                    // If the lowercase password is the same as the original password,
                    //      then the original password did not have any uppercase letters.
                    $this->msg = "Password must contain at least one capital letter.";
                    return false;
                }

                // Check strength of password
                $zxcvbn = new Zxcvbn();
                $strength = $zxcvbn->passwordStrength($this->attr['pass']);

                // Don't continue to register the user until the password is strong enough
                if ($strength['score'] <= 2) {
                    // If the password is too weak, respond with a message telling the user how to make it stronger
                    // $this->msg = $strength['feedback'];
                    // TODO: Use another zxcvbn library that has built-in feedback messages
                    $this->msg = "Password too weak. Don't use common words. Use capital letters, numbers, and special characters.";
                    return false;
                }

                // Salt and Hash the password using PHP's built-in functions and recommendations
                $this->attr['pass'] = password_hash($this->attr['pass'], PASSWORD_DEFAULT);
            //////////////////////////////////////////////////////////////

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
                " WHERE OID = :oid";

            // Prepare the statement
            $stmt = $this->conn->prepare($query);

            // Clean the query
            $this->attr["oid"] = htmlspecialchars(strip_tags($this->attr["oid"]));

            // Bind the data
            $stmt->bindValue(":oid", $this->attr["oid"]);
            
            // Execute the prepared statement and check for errors in running it
            if ($this->runPrepStmtChkErr($stmt) === false) {
                return false;
            }

            // Get the result of reading one of the rows of the relation
            $row_res = $stmt->fetch(PDO::FETCH_ASSOC);
            // Import the data into values this class understands
            return $db_data = array(
                "oid"   => $row_res["OID"],
                "name"  => $row_res["Name"],
                "tel"   => $row_res["Tel"],
                "type"  => $row_res["Type"],
                "pass"  => $row_res["Password"],
            );
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
                // $local_key = strtolower($key);
                // If user didn't specify property
                if ($this->attr[$local_key] === "") {
                    // Then use the value that's already in the database
                    $this->attr[$local_key] = $curr_vals[$key];
                }
            }

            // Create query
            $query = "UPDATE " . $this->table .
                " SET Name = :name, Tel = :tel, Type = :type, Password = :pass" .
                " WHERE OID = :oid";

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
            // print_r($this->attr["oid"]);
            // Create query
            $query = "DELETE FROM " . $this->table .
                " WHERE OID = :oid";
            // Prepare the statement
            $stmt = $this->conn->prepare($query);
            // Clean the query
            $this->attr["oid"] = htmlspecialchars(strip_tags($this->attr["oid"]));
            // Bind the data
            $stmt->bindValue(":oid", $this->attr["oid"]);
            // Execute the prepared statement and check for errors in running it
            return $this->runPrepStmtChkErr($stmt);
        }
        
         //list all the owner
         public function listAll() {
            $pageSequenceNum = $this->pageInfo["pageSeq"];
            if ( NULL == $pageSequenceNum){
                $pageSequenceNum = 2;
            }
            $recordPerPage = 5;
            $page = "";
            $output = "";
            $startFrom = ($pageSequenceNum - 1) * $recordPerPage;
            $totalRecords = "";
            $totalPages = "";

            // // =============start create pagination========================
            // //Create query for totalRecords
            $totalRecordsQuery = "SELECT COUNT(*) FROM " . $this->table; 
            $totalRecordsStmt = $this->conn->prepare($totalRecordsQuery);
            if ($this->runPrepStmtChkErr($totalRecordsStmt) === false) {
                return false;
            }
            // $totalRecordsResult = $totalRecordsStmt->fetchAll(PDO::FETCH_ASSOC);
            $totalRecordsResult = $totalRecordsStmt->fetch(PDO::FETCH_ASSOC);
            $keys = array_keys($totalRecordsResult);
            $totalRecords = $totalRecordsResult[$keys[0]];
            $totalPages = ceil($totalRecords / $recordPerPage);

            // //create pagination_link
                    // <div class="col-1"></div>
            $output .= '
                <div class="row bg-secondary mx-0 p-0 my-0" style="height:45px">
                    <div class="col pb-0 mb-0 text-left">
                        <nav aria-label="Page navigation example" class="mt-2 mb-0 p-0">
                            <ul class="pagination justify-content-left">
            '; 
            for($i = 1; $i <= $totalPages; $i++){
                $output .= '<li class="page-item" id="' . $i .'">' . '<a class="page-link border" href="#">' . $i . '</a></li> '; 
            }
            $output .= "
                            </ul>
                        </nav>
                  </div>
                </div>
            "; 
            // //=============end create pagination========================


            // //=============start query necessary result==================
            // //Create query
            $query = "SELECT * FROM " . $this->table . " ORDER BY OID ASC LIMIT $startFrom,$recordPerPage";
            ////Prepare the statement
            $stmt = $this->conn->prepare($query);
            ////Execute the prepared statement and check for errors in running it
            if ($this->runPrepStmtChkErr($stmt) === false) {
                return false;
            }
            // //Return all rows of the table
            // //Note: 'PDO::FETC_ASSOC' means only the associative, 
                // // and not positional (numerically indexed) array will be returned
            // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            // //=============end query necessary result==================

            // //=============start create result table header==============
            $output .= '
                <div class="row mx-0 mt-0 pt-0 bg-secondary justify-content-center">
            ';
            foreach($result as $key=>$value){
                $output .= '
                    <div class="col col-sm col-md col-lg border text-center bg-info">' . $key . '</div>
                ';
            }
            $output .= '
                </div>
            ';
                    // <div class="col-1 col-sm-1 col-md-1 col-lg-1 border text-center bg-info">Modify</div>
            // //=============end create result table header============== 

            // //=============start create result table body==============
            $i = 0;
            $j = 0;
            do{
              $i++;
              $output .= '
                <div class="row mx-0 bg-secondary pb-1 justify-content-center">
              ';
              foreach($result as $key=>$value){
                $j++;
                if("Password" == $key){
                  $value = "****";
                }
                $output .= '
                  <div class="col col-sm col-md col-lg border text-center bg-light" id="col_' . $i . '_' . $j . '">
                  ' . $value .'
                  </div>
                ';
              } 
            //   $output .= '
            //     <div class="col-1 col-sm-1 col-md-1 col-lg-1 border text-center bg-light" id="colBtn_' . $i . '">
            //       <button class="btn btn-outline-danger btn-sm">Modify</button>
            //     </div>
            //   ';
              $output .= '
                </div>
              ';
            } while($result = $stmt->fetch(PDO::FETCH_ASSOC));

            // //=============end create result table body==============

            return $output;
         }
        

         // // used for query one user
         public function listOne() {
            $output = "";

            // //=============start of the query ==========================
            // Create query
            $query = "SELECT * FROM " . $this->table . 
                " WHERE OID = :oid";
            // Prepare the statement
            $stmt = $this->conn->prepare($query);
            // Clean the query
            $this->attr["oid"] = htmlspecialchars(strip_tags($this->attr["oid"]));
            // Bind the data
            $stmt->bindValue(":oid", $this->attr["oid"]);
            // Execute the prepared statement and check for errors in running it
            if ($this->runPrepStmtChkErr($stmt) === false) {
                return false;
            }
            // Get the result of reading one of the rows of the relation
            $result = $stmt->fetch(PDO::FETCH_ASSOC); 
            // //=============end of the query ==========================

            // //=============start create result table header==============
            $output .= '
                <div class="row mx-0 mt-0 pb-1 bg-secondary justify-content-center">
            ';
            foreach($result as $key=>$value){
                $output .= '
                    <div class="col col-sm col-md col-lg border text-center bg-info">' . $key . '</div>
                ';
            }
            $output .= '
                </div>
            ';
                    // <div class="col-1 col-sm-1 col-md-1 col-lg-1 border text-center bg-info">Modify</div>
            // //=============end create result table header============== 

            // //=============start create result table body==============
            $i = 0;
            $j = 0;
            do {
              $i++;
              $output .= '
                <div class="row mx-0 pb-1 bg-secondary justify-content-center">
              ';
              foreach($result as $key=>$value){
                $j++;
                if("Password" == $key){
                  $value = "****";
                }
                $output .= '
                  <div class="col col-sm col-md col-lg border text-center bg-light" id="col_' . $i . '_' . $j . '">
                  ' . $value .'
                  </div>
                ';
              }
            //   $output .= '
            //     <div class="col-1 col-sm-1 col-md-1 col-lg-1 border text-center bg-light" id="colBtn_' . $i . '">
            //       <button class="btn btn-outline-danger btn-sm">Modify</button>
            //     </div>
            //   ';
              $output .= '
                </div>
              ';
            } while($result = $stmt->fetch(PDO::FETCH_ASSOC));
            // //=============end create result table body==============

            return $output;
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
                // echo json_encode(array("msg"=>"stmt->executed"));
                return true;
            }

            // Print error if something goes wrong
            echo "\nPDOStatement::errorInfo():\n";
            $err_arr = $stmt->errorInfo();
            print_r($err_arr);

            return false;
        }

        /* Get the any message the model outputs */
        public function getMsg() {
            return $this->msg;
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
        /* Set pageInfo */
        public function setPageInfo($name, $val) {
            $this->pageInfo[$name] = $val;
        }
        /* Get pageInfo */
        public function getPageInfo($name) {
            return $this->pageInfo[$name];
        }
    }
