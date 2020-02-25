<?php
session_start();
$getID = $_GET['id'];

        $queryCount = mysql_query('SELECT id FROM employee_edit WHERE emp_id = ' . $getID);
        $rowCount = mysql_num_rows($queryCount);

        if ($rowCount > 0) {
		
            echo 1;
        } else {
		echo 2
        }
        ?>