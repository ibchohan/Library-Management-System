
<?php

    include("data_class.php");

    $u = new data;
    $u->setconnection();

    $v = new data;
    $v->setconnection();

    $userId = $_POST['userId'];
    $recordset = $u->fetchIssuedBooksByUserId($userId);
    $recordset2 = $v->fetchFineDatabyUserID($userId);


    $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='padding: 8px;'>User Name</th><th>Book Title</th><th>Issue Date</th><th>Return Date</th><th>Fine (Rs.)</th><th>Issue Type</th></tr>";
    
    foreach ($recordset as $row) {
        $table .= "<tr>";
        $table .= "<td>$row[0]</td>";
        $table .= "<td>$row[1]</td>";
        $table .= "<td>$row[2]</td>";
        $table .= "<td>$row[3]</td>";
        $table .= "<td>$row[4]</td>";
        $table .= "<td>$row[5]</td>";
        $table .= "</tr>";
    }
    $table .= "</table>";

    echo $table;


    $table2 = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 40%;'><tr><th style='padding: 8px;  text-align: center;'>Total Fine (Rs.)</th><th>Total Books Issued</th></tr>";
    foreach ($recordset2 as $row) {
        $table2 .= "<tr>";
        $table2 .= "<td>$row[0]</td>";
        $table2 .= "<td>$row[1]</td>";
        $table2 .= "</tr>";
    }
    $table2 .= "</table>";

    echo $table2;

    echo "\n\n\n";
    echo "<form action='admin_service_dashboard.php' method='post' style='text-align: left; padding-top: 20px;'>";
        echo "<button type='submit' style='background-color: #2c698d; color: white; border: none; padding: 5px 10px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer; border-radius: 3px;'>Return to Dashboard</button>";
    echo "</form>";
 ?>



<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: white;
    }

    table {
        font-family: Arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #bae8e8;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #2c698d;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #bae8e8;
    }

    img {
        max-width: 100px;
        max-height: 100px;
        border: 1px solid #333333;
    }

    btn. {
        background-color: #2c698d;
        color: white;
        border: none;
        padding: 5px 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 3px;
    }
</style>