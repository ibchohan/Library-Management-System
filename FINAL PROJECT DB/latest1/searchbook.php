<?php
session_start();
include("data_class.php");

if (!isset($_SESSION["userid"])) {
    header("Location: index.php");
    exit();
}

$userloginid = $_SESSION["userid"];

if (isset($_POST['bookname'])) {
    $bookname = $_POST['bookname'];
    $category = isset($_POST['category']) ? $_POST['category'] : '';

    $u = new data;
    $u->setconnection();
    $recordset = $u->searchBooks($bookname, $category);

    // Display the search results
    echo "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr>
        <th>Image</th><th>Title</th><th>Author</th><th>Publisher</th><th>Category</th><th>Request Book</th></tr>";

    foreach ($recordset as $row) {
        echo "<tr>";
        echo "<td><img src='uploads/$row[0]' width='100px' height='100px' style='border:1px solid #333333;'></td>";
        echo "<td>$row[1]</td>";
        echo "<td>$row[2]</td>";
        echo "<td>$row[3]</td>";
        echo "<td>$row[4]</td>";
        echo "<td><a href='requestbook.php?bookid={$row[4]}&userid={$userloginid}'><button type='button' class='btn btn-primary'>Request Book</button></a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    // Redirect back to otheruser_dashboard.php if the form is not submitted properly
    header("Location: otheruser_dashboard.php?userlogid=$userloginid");
    exit();
}
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

    .btn {
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
