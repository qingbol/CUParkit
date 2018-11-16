<?php
    /* Jack Tabb
     * 11/1/18
     * 
     * Establish functions and things to help us set up and manage our database.
     * Look below these functions for the usage of them.
    */
    
    // Import Database connection class
    include_once 'config/Database.php';

    // import the models for the tables we wish to manage
    include_once 'models/Owner.php';
    include_once 'models/Vehicle.php';
    include_once 'models/ManageParking.php';
    include_once 'models/Manager.php';
    include_once 'models/ManageRecord.php';
    include_once 'models/model_interface.php';
    include_once 'models/Own.php';
    include_once 'models/ParkingRecord.php';
    include_once 'models/ParkingSpot.php';
    include_once 'models/ParkOn.php';

    // Instantiate DB & connect to it
    $database = new Database();
    $conn = $database->connect();

    // This function is not a part of the api. It's only for our convenience for development.
    // Fill in the table from a csv file
    // In production, the data folder should be cleared because the only data that
    // matters is what's in the database. Also, we don't want to expose usernames and passwords.
    // This function assumes each table has a model and that each model has a function called create()
    /* Fill a mySQL database table with a csv data file */
    // $conn = an instance of the database connection
    // $data_file = string that should be something like "data/owner_table.csv"
    // $obj = an instance of a data model
    function fill_table($conn, $data_file, $obj) {
        // Read the file into a 2D array
        $data_arr = read_data_file($data_file); // Get a 2D array of the data to put into the table
        // var_dump ($data_arr);
  //       print_r ($data_arr);
		// print ("<br>");
        // Add the data to the table one line at a time
        $num_rows = count($data_arr);
		// var_dump ($num_row);
	    // print_r($num_rows);
	    // print ("<br>");
        for ($i=0; $i<$num_rows; $i++) {
            // Supply the data from the file to the model object 
		    var_dump ($data_arr[$i]);
            $obj->fillAttributes($data_arr[$i]);

            // Each model has a 'create' function defined.
            // Use it to insert the data from the model object's properties
            //   into the mySQL table's attributes one line at a time.
            if (!$obj->create()) {
                // Print error if something goes wrong
                printf("Error in manage_tables fill_table");
                // If the operation did not work, break out of the loop and function
                return false; 
            }
        }
    }

    // This function is not a part of the api. It's only for our convenience for development.
    /* Empty all data from a mySQL database table, but retain the table */
    // $conn = an instance of the database connection
    // $obj = an instance of a data model
    function empty_table($conn, $model) {
        // Create query
        // Note that our database will break when we delete the data from one table
        // The foreign key and other relations should be considered when deleting data from tables
        // $query = "TRUNCATE TABLE " . $model->getTableName();
        $query = "SET FOREIGN_KEY_CHECKS = 0; " .
                "TRUNCATE TABLE " . $model->getTableName() . "; " .
                "SET FOREIGN_KEY_CHECKS = 1;";

        // Prepare statement
        $stmt = $conn->prepare($query);

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

    /* Read a csv file's contents into a 2D array */
    function read_data_file($data_file) {
        $data_arr = array(); // 2D array
        $row = 0;
        if (($handle = fopen($data_file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                // data is now an array that has one row of values
                // Its length is the number of attributes

                // Store one row of values into the 2D array
                $data_arr[$row] = $data;
                $row++;
            }
            fclose($handle);
        }
        return $data_arr;
    }

    ///////////////////////////////////////////////////////////////////////////
    /*
     * Use the above functions
    */

    // Instantiate the object whose table I'm working on
    $owner = new Owner($conn);
    
    // Fill in the Owner table with the data from our csv file.
    // fill_table($conn, "data/owner_data2.csv", $owner);
    //
    // Emtpy all entries from the Owner table
    // empty_table($conn, $owner);
    // 
    // Read all entries from the Owner table
    $res = $owner->read();
    print("Result of reading Owner: \n");
    print_r($res);
    print("\n");
    print("<br><br>");
    
    // Read one entry from the Owner table
    // $oid = "C10000000";
    // $owner->setAttr("oid", $oid);
    // $res = $owner->read_single();
    // print("Result of reading Owner '" . $oid . "': \n");
    // print_r($res);
    // print("\n");
    // print("<br>");
    // 
    // Update an entry in the Owner table
    // $oid = "C10000000";
    // $owner->setAttr("oid", $oid);
    // $owner->setAttr("name", "Jillian");
    // $owner->update();
    //
    // Delete an entry from the Owner table
    // $oid = "C10000003";
    // $owner->setAttr("oid", $oid);
    // $owner->delete();

    //======================Vehicle.php================
    // Instantiate the object whose table I'm working on
    $vehicle = new Vehicle($conn);

    // Fill in the Owner table with the data from our csv file.
     // fill_table($conn, "data/vehicle_data2.csv", $vehicle);

    // Emtpy all entries from the Owner table
    // empty_table($conn, $owner);

    // Read all entries from the Owner table
    $res = $vehicle->read();
    print("Result of reading Vehicle: \n");
    print_r($res);
    print("\n");
    print("<br><br>");
    
    // Read one entry from the Owner table
    // $plate = "1AWJ785";
    // $vehicle->setAttr("plate", $plate);
    // $res = $vehicle->read_single();
    // print("Result of reading Vehicle '" . $plate . "': \n");
    // print_r($res);
    // print("\n");
    // print("<br>");
    
    // Update an entry in the Owner table
    // $plate = "1AWJ785";
    // $vehicle->setAttr("plate", $plate);
    // $vehicle->setAttr("color", "blue");
    // $vehicle->update();

    // Delete an entry from the Owner table
    // $plate = "1AWJ785";
    // $vehicle->setAttr("plate", $plate);
    // $vehicle->delete();


    //======================own.php================
    // Instantiate the object whose table I'm working on
    $own = new Own($conn);

    // Fill in the Owner table with the data from our csv file.
     // fill_table($conn, "data/own_data2.csv", $own);

    // Emtpy all entries from the Owner table
    // empty_table($conn, $own);

    // Read all entries from the Owner table
    $res = $own->read();
    print("Result of reading Own: \n");
    print_r($res);
    print("\n");
    print("<br><br>");
    
    // Read one entry from the Owner table
    // $plate = "1AWJ785";
    // $oid = "C10000001";
    // $own->setAttr("plate", $plate);
    // $own->setAttr("oid", $oid);
    // $res = $own->read_single();
    // print("Result of reading Own '" . $plate . "And" . $oid . "': \n");
    // print_r($res);
    // print("\n");
    // print("<br>");
    
    // Update an entry in the Owner table
    // $plate = "1AWJ785";
    // $oid = "C10000001";
    // $own->setAttr("plate", $plate);
    // $own->setAttr("oid", $oid);
    // $vehicle->update();

    // Delete an entry from the Owner table
    // $plate = "PYY438";
    // $oid = "C10000002";
    // $own->setAttr("plate", $plate);
    // $own->setAttr("oid", $oid);
    // $own->delete();

    //======================ParkingSpot.php================
    // Instantiate the object whose table I'm working on
    $parkingspot = new ParkingSpot($conn);

    // Fill in the Owner table with the data from our csv file.
     // fill_table($conn, "data/parking_spot_data2.csv", $parkingspot);

    // Emtpy all entries from the Owner table
    // empty_table($conn, $parkingspot);

    // Read all entries from the Owner table
    $res = $parkingspot->read();
    print("Result of reading ParkingSpot: \n");
    print_r($res);
    print("\n");
    print("<br><br>");
    
    // Read one entry from the ParkingSpot table
    // $spot = "E01_001";
    // $parkingspot->setAttr("spot", $spot);
    // $res = $parkingspot->read_single();
    // print("Result of reading ParkingSpot '" . $spot . "': \n");
    // print_r($res);
    // print("\n");
    // print("<br>");
    
    // Update an entry in the ParkingSpot table
    // $spot = "E01_001";
    // $parkingspot->setAttr("spot", $spot);
    // $parkingspot->setAttr("status","vacant");
    // $parkingspot->update();

    // Delete an entry from the Owner table
    // $plate = "1AWJ785";
    // $oid = "C10000001";
    // $own->setAttr("plate", $plate);
    // $own->setAttr("oid", $oid);
    // $own->delete();


    //======================ParkOn.php================
    // Instantiate the object whose table I'm working on
    $parkon = new ParkOn($conn);

    // Fill in the Owner table with the data from our csv file.
     // fill_table($conn, "data/park_on_data2.csv", $parkon);
      // fill_table($conn, "data/park_on_data_err.csv", $parkon);

    // Emtpy all entries from the Owner table
    // empty_table($conn, $parkon);

    // Read all entries from the Owner table
    $res = $parkon->read();
    print("Result of reading ParkOn: \n");
    print_r($res);
    print("\n");
    print("<br><br>");
    
    // Read one entry from the ParkingSpot table
    // $spot = "V01_110";
    // $plate = "PYY438";
    // $parkon->setAttr("spot", $spot);
    // $parkon->setAttr("plate", $plate);
    // $res = $parkon->read_single();
    // print("Result of reading ParkingSpot '" . $spot . "': \n");
    // print_r($res);
    // print("\n");
    // print("<br>");
    
    // Update an entry in the ParkingSpot table
    // $spot = "E01_001";
    // $parkingspot->setAttr("spot", $spot);
    // $parkingspot->setAttr("status","vacant");
    // $parkingspot->update();

    // Delete an entry from the Owner table
    // $plate = "PYY438";
    // $spot = "V01_110";
    // $parkon->setAttr("plate", $plate);
    // $parkon->setAttr("spot", $spot);
    // $parkon->delete();

    //======================Manager.php================
    // Instantiate the object whose table I'm working on
    $manager = new Manager($conn);

    // Fill in the Owner table with the data from our csv file.
     // fill_table($conn, "data/manager_data.csv", $manager);

    // Emtpy all entries from the Owner table
    // empty_table($conn, $manager);

    // Read all entries from the Owner table
    $res = $manager->read();
    print("Result of reading Manager: \n");
    print_r($res);
    print("\n");
    print("<br><br>");
    
    // Read one entry from the manager table
    // $mid = "M001";
    // $manager->setAttr("mid", $mid);
    // $res = $manager->read_single();
    // print("Result of reading Manager '" . $mid . "': \n");
    // print_r($res);
    // print("\n");
    // print("<br><br>");
    
    // Update an entry in the Manager table
    // $mid = "M001";
    // $manager->setAttr("mid", $mid);
    // $manager->setAttr("name","Richard");
    // $manager->update();

    // Delete an entry from the Owner table
    // $mid = "M001";
    // $manager->setAttr("mid", $mid);
    // $manager->delete();


    //======================ManageParking.php================
    // Instantiate the object whose table I'm working on
    $manageparking = new ManageParking($conn);

    // Fill in the Owner table with the data from our csv file.
     // fill_table($conn, "data/manage_parking_data2.csv", $manageparking);

    // Emtpy all entries from the Owner table
    // empty_table($conn, $manageparking);

    // Read all entries from the Owner table
    $res = $manageparking->read();
    print("Result of reading ManageParking: \n");
    print_r($res);
    print("\n");
    print("<br><br>");
    
    // Read one entry from the manager table
    // $mid = "M002";
    // $spot = "E01_001";
    // $manager->setAttr("mid", $mid);
    // $res = $manager->read_single();
    // print("Result of reading ManageParking '" . $mid . "': \n");
    // print_r($res);
    // print("\n");
    // print("<br><br>");
    
    // Update an entry in the Manager table
    // $mid = "M002";
    // $spot = "E01_001";
    // $manageparking->setAttr("mid", $mid);
    // $manageparking->setAttr("spot",$spot);
    // $manageparking->update();

    // Delete an entry from the Owner table
    // $mid = "M002";
    // $spot = "E01_001";
    // $manageparking->setAttr("mid", $mid);
    // $manageparking->setAttr("spot", $spot);
    // $manageparking->delete();


    //======================ParkingRecord.php================
    // Instantiate the object whose table I'm working on
    $parkingrecord = new ParkingRecord($conn);

    // Fill in the Owner table with the data from our csv file.
     // fill_table($conn, "data/parking_record_data2.csv", $parkingrecord);

    // Emtpy all entries from the Owner table
    // empty_table($conn, $parkingrecord);

    // Read all entries from the Owner table
    $res = $parkingrecord->read();
    print("Result of reading ParkingRecord: \n");
    print_r($res);
    print("\n");
    print("<br><br>");
    
    // Read one entry from the manager table
    // $rcd_index = "r000003";
    // $parkingrecord->setAttr("rcd_index", $rcd_index);
    // $res = $parkingrecord->read_single();
    // print("Result of reading ParkingRecord '" . $rcd_index . "': \n");
    // print_r($res);
    // print("\n");
    // print("<br><br>");
    
    // Update an entry in the Manager table
    // $rcd_index = "r000003";
    // $parkingrecord->setAttr("rcd_index", $rcd_index);
    // $parkingrecord->setAttr("plate", "PYY438");
    // $parkingrecord->update();

    // Delete an entry from the Owner table
    // $rcd_index = "r000004";
    // $parkingrecord->setAttr("rcd_index", $rcd_index);
    // $parkingrecord->delete();


    //======================ManageRecord.php================
    // Instantiate the object whose table I'm working on
    $managerecord = new ManageRecord($conn);

    // Fill in the Owner table with the data from our csv file.
     // fill_table($conn, "data/manage_record_data2.csv", $managerecord);

    // Emtpy all entries from the Owner table
    // empty_table($conn, $managerecord);

    // Read all entries from the Owner table
    $res = $managerecord->read();
    print("Result of reading ManageRecord: \n");
    print_r($res);
    print("\n");
    print("<br><br>");
    
    // Read one entry from the manager table
    // $rcd_index = "r000003";
    // $mid = "M003";
    // $managerecord->setAttr("mid", $mid);
    // $managerecord->setAttr("rcd_index", $rcd_index);
    // $res = $managerecord->read_single();
    // print("Result of reading ManageParking '" . $mid . "': \n");
    // print_r($res);
    // print("\n");
    // print("<br><br>");
    
    // Update an entry in the Manager table
    // $mid = "M002";
    // $spot = "E01_001";
    // $manageparking->setAttr("mid", $mid);
    // $manageparking->setAttr("spot",$spot);
    // $manageparking->update();

    // Delete an entry from the Owner table
    // $rcd_index = "r000003";
    // $mid = "M003";
    // $managerecord->setAttr("mid", $mid);
    // $managerecord->setAttr("rcd_index", $rcd_index);
    // $managerecord->delete();

