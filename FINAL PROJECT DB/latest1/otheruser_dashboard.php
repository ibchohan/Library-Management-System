<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

$userloginid = $_SESSION["userid"] = $_GET['userlogid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>User Dashboard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <style>
        body {
            background-image: url('uploads/login3.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            top: 0; /* This will position the container at the top of the page */
            bottom: 20;
        }
        

        .left-panel,
        .right-panel {
            border: 1px solid black;
            box-sizing: border-box;
        }

        .left-panel {
            width: 25%;
            background-color: #272643;
            padding: 15px;
            border-radius: 10px;
            color: #fff;
        }

        .portion {
    padding: 20px;
    margin: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #f9f9f9;
}

        .right-panel {
            width: 70%;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            color: #333;
            height: 35vh;
        }

        .greenbtn {
            background-color: #bae8e8;
            color: #fff;
            width: 100%;
            height: 80px;
            margin-top: 16px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }

        .greenbtn:hover {
            background-color: #ecf0f1;
        }

        .greenbtn,
        a {
            text-decoration: none;
            color: black;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #272643;
            color: white;
            padding: 10px;
        }

        td {
            background-color: #ecf0f1;
            color: #333;
            padding: 10px;
        }

        td,
        a {
            color: #333;
        }

        .title {
            text-align: center; /* This will center the text horizontally */
            font-weight: bold; /* This will make the text bold */
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3); /* This will add a shadow to the text */
            margin-top: 135px; /* This will move the title 3px down */
            font-size: larger;
            color: black; /* This will make the font color black */
            background-color: rgba(255, 255, 255, 0.5); /* This will make the background color a shallow white */
        }


    </style>
</head>

<body>

    <?php
    include("data_class.php");
    ?>

<div class="title">
     <h1>BOOK SPHERE</h1>
</div>  <br>

<div class="container">
        <div class="left-panel">
            <button class="greenbtn" onclick="openpart('myaccount')">My Account</button>
            <button class="greenbtn" onclick="openpart('requestbook')">Request Book</button>
            <button class="greenbtn" onclick="openpart('searchBook')">Search Book</button>
            <button class="greenbtn" onclick="openpart('issuereport')">Book Report</button>
            <a href="index.php"><button class="greenbtn">Logout</button></a>

        </div>
        <br>

        <div class="right-panel">
            <!-- Add your PHP code for each function here -->

             <!-- My Account -->
             <div id="myaccount" class="portion">
    <?php
    $u = new data;
    $u->setconnection();
    $u->userdetail($userloginid);
    $recordset = $u->userdetail($userloginid);
    echo "<table>";
    echo "<tr><th>Person Name</th><th>Person Email</th><th>Account Type</th></tr>";
    foreach ($recordset as $row) {
        $id = $row[1];
        $name = $row[1];
        $email = $row[2];
        $pass = $row[3];
        $type = $row[4];
        echo "<tr><td>$id</td><td>$email</td><td>$type</td></tr>";
    }
    echo "</table>";
    ?>
</div>



           <!-- Request Book -->
            <div id="requestbook" class="portion" style="display:none;">
                <?php
                $u = new data;
                $u->setconnection();
                $u->getbookissue();
                $recordset = $u->getbookissue();

                $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr>
                <th>Image</th><th>Book Name</th><th>Book Authour</th><th>Branch</th><th>Price</th></th><th>Request Book</th></tr>";

                foreach ($recordset as $row) {
                    $table .= "<tr>";
                    $table .= "<td><img src='uploads/$row[1]' width='100px' height='100px' style='border:1px solid #333333;'></td>";
                    $table .= "<td>$row[2]</td>";
                    $table .= "<td>$row[4]</td>";
                    $table .= "<td>$row[6]</td>";
                    $table .= "<td>$row[7]</td>";
                    $table .= "<td><a href='requestbook.php?bookid=$row[0]&userid=$userloginid'><button type='button' class='btn btn-primary'>Request Book</button></a></td>";

                    $table .= "</tr>";
                }
                $table .= "</table>";

                echo $table;
                ?>
            </div>


            <!-- Book Record -->
            <div id="issuereport" class="portion" style="display:none;">
                <?php
                $u = new data;
                $u->setconnection();
                $u->getissuebook($userloginid);
                $recordset = $u->getissuebook($userloginid);

                $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr>
                <th>Name</th><th>Book Name</th><th>Issue Date</th><th>Return Date</th><th>Fine</th></tr>";

                foreach ($recordset as $row) {
                    $table .= "<tr>";
                    $table .= "<td>$row[2]</td>";
                    $table .= "<td>$row[3]</td>";
                    $table .= "<td>$row[6]</td>";
                    $table .= "<td>$row[7]</td>";
                    $table .= "<td>$row[8]</td>";
                
                    $table .= "</tr>";
                }                
                
                $table .= "</table>";

                echo $table;
                ?>
            </div>


            <!-- Search Book -->
            <div id="searchBook" class="portion" style="display:none;">
                <form action="searchbook.php" method="post">
                    <label for="bookname">Book Name:</label>
                    <input type="text" id="bookname" name="bookname" placeholder="Enter Book Name">
                    <br>
                    <label for="category">Category:</label>
                    <select id="category" name="category">
                        <option value="">Select Category</option>
                        <option value="Fiction">Fiction</option>
                        <option value="Non-Fiction">Non-Fiction</option>
                        <option value="Novel">Novel</option>
                        <option value="Romance">Romance</option>
                        <option value="Children's Books">Children's Books</option>
                        <option value="Biography">Biography</option>
                        <option value="Autobiography">Autobiography</option>
                        <option value="Mystery">Mystery</option>
                        <option value="Science">Science</option>
                        <option value="Technology">Technology</option>
                        <!-- Add other categories as needed -->
                    </select>
                    <input type="submit" value="Search Book"/>
                </form>
            </div>

        </div>
    </div>

    <script>
        function openpart(portion) {
            var i;
            var x = document.getElementsByClassName("portion");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            document.getElementById(portion).style.display = "block";
        }
    </script>
</body>
</html>
