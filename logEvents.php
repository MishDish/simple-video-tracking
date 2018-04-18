<?php

    
        /* 
         *
         *   @file Manages inserts of event records into database
         *   @author Misha Vucicevic
         *    NOTE : It is created in procedural php, it would be better to be create in Object oriented way and separate the concerns into classes
         *
         */

     if (isset($_POST['viewChanged'])) {
        echo "The insert function is called.";
        insert();
     } 

      function insert() {
        $dataForInsert = json_decode($_POST['viewChanged'],true);
        getDateBaseAndInsertRecord($dataForInsert);       
      }

      function getDateBaseAndInsertRecord($dataForInsert) {

        /* 
         *
         *  Communication with database . 
         *  NOTE : this is just a form how would look like simple talk with database. I would use PDO or even better some framework model.
         *  Please comment out the database connection when the file is executed.(It is just a form with mocked credentials)
         */

          echo " TIME : ".$dataForInsert['time']. ", Page Session : ". $dataForInsert['page_session'] .", Action : ". $dataForInsert['action']. ", Element Id: ". $dataForInsert['elementId'].", Page URL: ". $dataForInsert['page_url'];
         
          
         //    $servername = "localhost"; // mock
         //    $username = "username";   // mock
         //    $password = "password"; //mock
         //    $dbname = "myDB"; //mock
         
         //     // Create connection
         //     $conn = new mysqli($servername, $username, $password, $dbname);
         //     // Check connection
         //     if ($conn->connect_error) {
         //         die("Connection failed: " . $conn->connect_error);
         //     } 
         


         // $sql = "INSERT INTO raw_events_table (date, page_session, action, elementId, pageUrl)
         // VALUES (  $dataForInsert->time, $dataForInsert->page_session, $dataForInsert->action, $dataForInsert->elementId, $dataForInsert->page_url)";
         
         // if ($conn->query($sql) === TRUE) {
         //     echo "New raw event created successfully";
         // } else {
         //     echo "Error: " . $sql . "<br>" . $conn->error;
         // }
         
         // $conn->close();
         //    exit;
         //  }
     }

?>