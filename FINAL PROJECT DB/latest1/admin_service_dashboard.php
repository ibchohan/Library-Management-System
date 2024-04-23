<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Dashboard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
   
   <style>
    body {
    background-image: url('uploads/login 2.jpeg');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    font-family: Arial, sans-serif;
}


    .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 70vh; /* This will center the container vertically */
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

    .right-panel {
        width: 70%;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        color: #333;
    }

    .greenbtn {
        background-color: #bae8e8;
        color: #fff;
        width: 100%;
        height: 50px;
        margin-top: 8px;
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
            margin-top: 100px; /* This will move the title 3px down */
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
            <h1 style="text-align: center; color: white;">Admin Panel</h1>
            <button class="greenbtn" onclick="openpart('addbook')">Add Book</button>
            <button class="greenbtn" onclick="openpart('bookreport')">View Book Record</button>
            <button class="greenbtn" onclick="openpart('bookrequestapprove')">Approve Book Requests</button>
            <button class="greenbtn" onclick="openpart('addperson')">Add Student</button>
            <button class="greenbtn" onclick="openpart('studentrecord')">View Student Record</button>
            <button class="greenbtn" onclick="openpart('issuebook')">Issue Books</button>
            <button class="greenbtn" onclick="openpart('issuebookreport')">View Issued Books</button>
            <button class="greenbtn" onclick="openpart('searchBook')">Search Book</button>
            <a href="index.php"><button class="greenbtn">Logout</button></a>
        </div>

        <div class="right-panel">
            <!-- Add your PHP code for each function here -->

            <!-- ADD BOOK -->
            <div id="addbook" class="portion" style="display:none;">
                <h2>Add New Book</h2>
                <form action="addbookserver_page.php" method="post" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td><label>Book Name:</label></td>
                            <td><input type="text" name="bookname"/></td>
                        </tr>
                        <tr>
                            <td><label>Detail:</label></td>
                            <td><input type="text" name="bookdetail"/></td>
                        </tr>
                        <tr>
                            <td><label>Author:</label></td>
                            <td><input type="text" name="bookaudor"/></td>
                        </tr>
                        <tr>
                            <td><label>Publication:</label></td>
                            <td><input type="text" name="bookpub"/></td>
                        </tr>
                        <tr>
                            <td><label>Branch:</label></td>
                            <td>
                                <input type="radio" name="branch" value="other"/>Other
                                <input type="radio" name="branch" value="BSIT"/>BSIT
                                <input type="radio" name="branch" value="BSCS"/>BSCS
                                <input type="radio" name="branch" value="BSSE"/>BSSE
                            </td>
                        </tr>
                        <tr>
                            <td><label>Price:</label></td>
                            <td><input type="number" name="bookprice"/></td>
                        </tr>
                        <tr>
                            <td><label>Quantity:</label></td>
                            <td><input type="number" name="bookquantity"/></td>
                        </tr>
                        <tr>
                            <td><label>Book Photo:</label></td>
                            <td><input type="file" name="bookphoto"/></td>
                        </tr>
                    </table>
                    <br>
                    <input type="submit" value="Submit" style="background-color: #27ae60; color: white; border: none; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;"/>
                    <br>
                    <br>
                </form>
            </div>


            <!-- VIEW BOOK -->
            <div id="bookreport" class="portion" style="display:none;">
                <h2>Book Record</h2>
                <?php
                $u = new data;
                $u->setconnection();
                $u->getbook();
                $recordset = $u->getbook();

                $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='padding: 8px;'>Book Name</th><th>Price</th><th>Qnt</th><th>Available</th><th>Rent</th><th>View</th</tr>";
                foreach($recordset as $row){
                    $table .= "<tr>";
                    "<td>$row[0]</td>";
                    $table .= "<td>$row[2]</td>";
                    $table .= "<td>$row[7]</td>";
                    $table .= "<td>$row[8]</td>";
                    $table .= "<td>$row[9]</td>";
                    $table .= "<td>$row[10]</td>";
                    $table .= "<td><a href='admin_service_dashboard.php?viewid=$row[0]'><button type='button' class='btn btn-primary'>View BOOK</button></a></td>";
                    $table .= "</tr>";
                }
                $table .= "</table>";

                echo $table;
                ?>
            </div>

            <!--  BOOK RECORDS -->
            <div class="rightinnerdiv">   
            <div id="bookdetail" class="innerright portion" style="<?php  if(!empty($_REQUEST['viewid'])){ $viewid=$_REQUEST['viewid'];} else {echo "display:none"; }?>">
            
            <Button class="greenbtn" >BOOK DETAIL</Button>
</br>
<?php
            $u=new data;
            $u->setconnection();
            $u->getbookdetail($viewid);
            $recordset=$u->getbookdetail($viewid);
            foreach($recordset as $row){

                $bookid= $row[0];
               $bookimg= $row[1];
               $bookname= $row[2];
               $bookdetail= $row[3];
               $bookauthour= $row[4];
               $bookpub= $row[5];
               $branch= $row[6];
               $bookprice= $row[7];
               $bookquantity= $row[8];
               $bookava= $row[9];
               $bookrent= $row[10];

            }            
?>

            <img width='150px' height='150px' style='border:1px solid #333333; float:left;margin-left:20px' src="uploads/<?php echo $bookimg?> "/>
            </br>
            <p style="color:black"><u>Book Name:</u> &nbsp&nbsp<?php echo $bookname ?></p>
            <p style="color:black"><u>Book Detail:</u> &nbsp&nbsp<?php echo $bookdetail ?></p>
            <p style="color:black"><u>Book Authour:</u> &nbsp&nbsp<?php echo $bookauthour ?></p>
            <p style="color:black"><u>Book Publisher:</u> &nbsp&nbsp<?php echo $bookpub ?></p>
            <p style="color:black"><u>Book Branch:</u> &nbsp&nbsp<?php echo $branch ?></p>
            <p style="color:black"><u>Book Price:</u> &nbsp&nbsp<?php echo $bookprice ?></p>
            <p style="color:black"><u>Book Available:</u> &nbsp&nbsp<?php echo $bookava ?></p>
            <p style="color:black"><u>Book Rent:</u> &nbsp&nbsp<?php echo $bookrent ?></p>


            </div>
            </div>

            <!-- RERQUEST BOOK -->
            <div id="bookrequestapprove" class="portion" style="display:none;">
                <h2>Approve Book Requests</h2>
                <?php
                $u = new data;
                $u->setconnection();
                $u->requestbookdata();
                $recordset = $u->requestbookdata();

                $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='padding: 8px;'>Person Name</th><th>Person Type</th><th>Book Name</th><th>Days</th><th>Approve</th></tr>";
                foreach($recordset as $row){
                    $table .= "<tr>";
                    $table .= "<td>$row[3]</td>";
                    $table .= "<td>$row[4]</td>";
                    $table .= "<td>$row[5]</td>";
                    $table .= "<td>$row[6]</td>";
                    $table .= "<td><a href='approvebookrequest.php?reqid=$row[0]&book=$row[5]&userselect=$row[3]&days=$row[6]'><button type='button' class='btn btn-primary'>Approve</button></a></td>";
                    $table .= "</tr>";
                }
                $table .= "</table>";

                echo $table;
                ?>
            </div>


            <!-- ADD STUDENT -->
            <div id="addperson" class="portion" style="display:none;">
                <h2>Add Student</h2>
                <form action="addpersonserver_page.php" method="post" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td><label>Name:</label></td>
                            <td><input type="text" name="addname"/></td>
                        </tr>
                        <tr>
                            <td><label>Password:</label></td>
                            <td><input type="password" name="addpass"/></td>
                        </tr>
                        <tr>
                            <td><label>Email:</label></td>
                            <td><input type="email" name="addemail"/></td>
                        </tr>
                        <tr>
                            <td><label>Type:</label></td>
                            <td>
                                <select name="type">
                                    <option value="student">Student</option>
                                    <option value="teacher">Teacher</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <input type="submit" value="Submit" style="background-color: #27ae60; color: white; border: none; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;"/>
                </form>
            </div>

            <!-- VIEW STUDENT RECORD -->
            <div id="studentrecord" class="portion" style="display:none;">
                <h2>Student Record</h2>
                <?php
                $u = new data;
                $u->setconnection();
                $u->userdata();
                $recordset = $u->userdata();

                $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='padding: 8px;'>Name</th><th>Email</th><th>Type</th><th>Delete</th></tr>";
                foreach($recordset as $row){
                    $table .= "<tr>";
                    $table .= "<td>$row[0]</td>";
                    $table .= "<td>$row[1]</td>";
                    $table .= "<td>$row[2]</td>";
                    $table .= "<td><a href='deleteuser.php?useriddelete=$row[0]'><button type='button' class='btn btn-primary'>Delete</button></a></td>";
                    $table .= "</tr>";
                }
                $table .= "</table>";

                echo $table;
                ?>
            </div>

            <!-- Issue Books -->
            <div id="issuebook" class="portion" style="display:none;">
                <h2>Issue Books</h2>
                <form action="issuebook_server.php" method="post" enctype="multipart/form-data">
                    <label for="book">Choose Book:</label>
                    <select name="book">
                        <?php
                        $u = new data;
                        $u->setconnection();
                        $u->getbookissue();
                        $recordset = $u->getbookissue();
                        foreach($recordset as $row){
                            echo "<option value='". $row[2] ."'>" .$row[2] ."</option>";
                        }
                        ?>
                    </select>
                    <br>
                    <label for="Select Student">Select Student:</label>
                    <select name="userselect">
                        <?php
                        $u = new data;
                        $u->setconnection();
                        $u->userdata();
                        $recordset = $u->userdata();
                        foreach($recordset as $row){
                            echo "<option value='". $row[1] ."'>" .$row[1] ."</option>";
                        }
                        ?>
                    </select>
                    <br>
                    <label>Days</label> <input type="number" name="days"/>
                    <input type="submit" value="Submit"/>
                </form>
            </div>

           
           <!-- View Issued Books -->
            <div id="issuebookreport" class="portion" style="display:none;">
                <h2>Issued Book Record</h2>

                <form method="post" action="issuerecord_server.php">
                    <label for="userId">Filter by User ID:</label>
                    <input type="text" name="userId" />
                    <input type="submit" value="Fetch Results" />
                </form>

                <?php
                $u = new data;
                $u->setconnection();

                // Check if the form is submitted
                 
                // If the form is not submitted, fetch all records
                $u->issuereport();
                $recordset = $u->issuereport();
            

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
                ?>
            </div>


            <!-- Search Book -->
            <div id="searchBook" class="portion" style="display:none;">
                <h2>Search Book</h2>
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
