<?php 
//session_start();
include("db.php");

class data extends db {

    private $bookpic;
    private $bookname;
    private $bookdetail;
    private $bookaudor;
    private $bookpub;
    private $branch;
    private $bookprice;
    private $bookquantity;
    private $type;
    private $email;
    private $name;

    private $book;
    private $userselect;
    private $days;
    private $getdate;
    private $returnDate;

    function __construct() {
        //echo " working ";
        //echo "</br></br>";
    }

//------------------------------------------------
 //admin login func
 
 function adminLogin($t1, $t2) {

    $q="SELECT * FROM admin where email='$t1' and pass='$t2'";
    $recordSet=$this->connection->query($q);
    $result=$recordSet->rowCount();

    if ($result > 0) {

        foreach($recordSet->fetchAll() as $row) {
            $logid=$row['id'];
        //    $_SESSION["adminid"] = $logid;
            header("location: admin_service_dashboard.php?logid=$logid");
        }
    }

    else {
        header("location: index.php?msg=Invalid Credentials");
    }
 }

 //------------------------------------------------
 //user/student login func




 function userdetail($id){
    $q="SELECT * FROM userdata where id ='$id'";
    $data=$this->connection->query($q);
    
    return $data;
}


 function userLogin($t1, $t2) {

    $q="SELECT * FROM userdata where email='$t1' and pass='$t2'";
    $recordSet=$this->connection->query($q);
    $result=$recordSet->rowCount();

    if ($result > 0) {

        foreach($recordSet->fetchAll() as $row) {
            $logid=$row['id'];
          //  $_SESSION["adminid"] = $logid;
            header("location: otheruser_dashboard.php?userlogid=$logid");
        }
    }

    else {
        header("location: index.php?msg=Invalid Credentials");
    }
 }

 //---------------------------------------------------------------
 //add person or user function

 function addnewuser($name,$pasword,$email,$type){
    $this->name=$name;
    $this->pasword=$pasword;
    $this->email=$email;
    $this->type=$type;


     $q="INSERT INTO userdata(id, name, email, pass,type)VALUES('','$name','$email','$pasword','$type')";

    if($this->connection->exec($q)) {
        header("Location:admin_service_dashboard.php?msg=New Add done");
    }

    else {
        header("Location:admin_service_dashboard.php?msg=Register Fail");
    }

 //---------------------------------------------------------------
 //add book function

    
}
function addbook($bookpic, $bookname, $bookdetail, $bookaudor, $bookpub, $branch, $bookprice, $bookquantity) {
    $this->$bookpic=$bookpic;
    $this->bookname=$bookname;
    $this->bookdetail=$bookdetail;
    $this->bookaudor=$bookaudor;
    $this->bookpub=$bookpub;
    $this->branch=$branch;
    $this->bookprice=$bookprice;
    $this->bookquantity=$bookquantity;

   $q="INSERT INTO book (id,bookpic,bookname, bookdetail, bookaudor, bookpub, branch, bookprice,bookquantity,bookava,bookrent)VALUES('','$bookpic', '$bookname', '$bookdetail', '$bookaudor', '$bookpub', '$branch', '$bookprice', '$bookquantity','$bookquantity',0)";

    if($this->connection->exec($q)) {
        header("Location:admin_service_dashboard.php?msg=done");
    }

    else {
        header("Location:admin_service_dashboard.php?msg=fail");
    }

}

// issue issuebookapprove
function issuebookapprove($book,$userselect,$days,$getdate,$returnDate,$redid){
    $this->$book= $book;
    $this->$userselect=$userselect;
    $this->$days=$days;
    $this->$getdate=$getdate;
    $this->$returnDate=$returnDate;
    ;


    $q="SELECT * FROM book where bookname='$book'";
    $recordSetss=$this->connection->query($q);

    $q="SELECT * FROM userdata where name='$userselect'";
    $recordSet=$this->connection->query($q);
    $result=$recordSet->rowCount();

    if ($result > 0) {

        foreach($recordSet->fetchAll() as $row) {
            $issueid=$row['id'];
            $issuetype=$row['type'];

            // header("location: admin_service_dashboard.php?logid=$logid");
        }
        foreach($recordSetss->fetchAll() as $row) {
            $bookid=$row['id'];
            $bookname=$row['bookname'];

                $newbookava=$row['bookava']-1;
                 $newbookrent=$row['bookrent']+1;
        }

    
        $q="UPDATE book SET bookava='$newbookava', bookrent='$newbookrent' where id='$bookid'";
        if($this->connection->exec($q)){

        $q="INSERT INTO issuebook (userid,issuename,issuebook,issuetype,issuedays,issuedate,issuereturn,fine)VALUES('$issueid','$userselect','$book','$issuetype','$days','$getdate','$returnDate','0')";

        if($this->connection->exec($q)) {

            $q="DELETE from requestbook where id='$redid'";
            $this->connection->exec($q);
            header("Location:admin_service_dashboard.php?msg=done");
        }

        else {
            header("Location:admin_service_dashboard.php?msg=fail");
        }
        }
        else{
           header("Location:admin_service_dashboard.php?msg=fail");
        }

        // function returnbook($id){
        //     $fine="";
        //     $bookava="";
        //     $issuebook="";
        //     $bookrentel="";
    
        //     $q="SELECT * FROM issuebook where id='$id'";
        //     $recordSet=$this->connection->query($q);
    
        //     foreach($recordSet->fetchAll() as $row) {
        //         $userid=$row['userid'];
        //         $issuebook=$row['issuebook'];
        //         $fine=$row['fine'];
    
        //     }
        //     if($fine==0){
    
        //     $q="SELECT * FROM book where bookname='$issuebook'";
        //     $recordSet=$this->connection->query($q);   
    
        //     foreach($recordSet->fetchAll() as $row) {
        //         $bookava=$row['bookava']+1;
        //         $bookrentel=$row['bookrent']-1;
        //     }
        //     $q="UPDATE book SET bookava='$bookava', bookrent='$bookrentel' where bookname='$issuebook'";
        //     $this->connection->exec($q);
    
        //     $q="DELETE from issuebook where id=$id and issuebook='$issuebook' and fine='0' ";
        //     if($this->connection->exec($q)){
        
        //         header("Location:otheruser_dashboard.php?userlogid=$userid");
        //      }
        //     //  else{
        //     //     header("Location:otheruser_dashboard.php?msg=fail");
        //     //  }
        //     }
        //     // if($fine!=0){
        //     //     header("Location:otheruser_dashboard.php?userlogid=$userid&msg=fine");
        //     // }
           
    
        // }

        
        function deletebook($id){
            $q="DELETE from book where id='$id'";
            if($this->connection->exec($q)){
        
                
               header("Location:admin_service_dashboard.php?msg=done");
            }
            else{
               header("Location:admin_service_dashboard.php?msg=fail");
            }
        }

    }

    else {
        header("location: index.php?msg=Invalid Credentials");
    }


}

function issuereport(){
    $q="SELECT issuename, issuebook, issuedate, issuereturn, fine, issuetype FROM issuebook ";
    $data=$this->connection->query($q);
    return $data;
    
}

function userdata() {
    $q="SELECT * FROM userdata ";
    $data=$this->connection->query($q);
    return $data;
}

function delteuserdata($id){
    $q="DELETE from userdata where id='$id'";
    if($this->connection->exec($q)){

        
       header("Location:admin_service_dashboard.php?msg=done");
    }
    else{
       header("Location:admin_service_dashboard.php?msg=fail");
    }
}

function getbook() {
    $q="SELECT * FROM book ";
    $data=$this->connection->query($q);
    return $data;
}

function getbookdetail($id){
    $q="SELECT * FROM book where id ='$id'";
    $data=$this->connection->query($q);
    return $data;
}



function getbookissue(){
    $q="SELECT * FROM book where bookava !=0 ";
    $data=$this->connection->query($q);
    return $data;
}

function requestbookdata(){
    $q="SELECT * FROM requestbook ";
    $data=$this->connection->query($q);
    return $data;
}


function requestbook($userid,$bookid){

    $q="SELECT * FROM book where id='$bookid'";
    $recordSetss=$this->connection->query($q);

    $q="SELECT * FROM userdata where id='$userid'";
    $recordSet=$this->connection->query($q);

    foreach($recordSet->fetchAll() as $row) {
        $username=$row['name'];
        $usertype=$row['type'];
    }

    foreach($recordSetss->fetchAll() as $row) {
        $bookname=$row['bookname'];
    }

    if($usertype=="student"){
        $days=7;
    }
    if($usertype=="teacher"){
        $days=21;
    }


    $q="INSERT INTO requestbook (id,userid,bookid,username,usertype,bookname,issuedays)VALUES('','$userid', '$bookid', '$username', '$usertype', '$bookname', '$days')";

    if($this->connection->exec($q)) {
        header("Location:otheruser_dashboard.php?userlogid=$userid");
    }

    else {
        header("Location:otheruser_dashboard.php?msg=fail");
    }

}

function issuebook($book,$userselect,$days,$getdate,$returnDate){
    $this->$book= $book;
    $this->$userselect=$userselect;
    $this->$days=$days;
    $this->$getdate=$getdate;
    $this->$returnDate=$returnDate;


    $q="SELECT * FROM book where bookname='$book'";
    $recordSetss=$this->connection->query($q);

    $q="SELECT * FROM userdata where name='$userselect'";
    $recordSet=$this->connection->query($q);
    $result=$recordSet->rowCount();

    if ($result > 0) {

        foreach($recordSet->fetchAll() as $row) {
            $issueid=$row['id'];
            $issuetype=$row['type'];

            // header("location: admin_service_dashboard.php?logid=$logid");
        }
        foreach($recordSetss->fetchAll() as $row) {
            $bookid=$row['id'];
            $bookname=$row['bookname'];

                $newbookava=$row['bookava']-1;
                 $newbookrent=$row['bookrent']+1;
        }

    
        $q="UPDATE book SET bookava='$newbookava', bookrent='$newbookrent' where id='$bookid'";
        if($this->connection->exec($q)){

        $q="INSERT INTO issuebook (userid,issuename,issuebook,issuetype,issuedays,issuedate,issuereturn,fine)VALUES('$issueid','$userselect','$book','$issuetype','$days','$getdate','$returnDate','$returnDate-$getdate')";

        if($this->connection->exec($q)) {
            header("Location:admin_service_dashboard.php?msg=done");
        }

        else {
            header("Location:admin_service_dashboard.php?msg=fail");
        }
        }
        else{
           header("Location:admin_service_dashboard.php?msg=fail");
        }


    }

    else {
        header("location: index.php?msg=Invalid Credentials");
    }
}

function getissuebook($userloginid) {

    $newfine="";
    $issuereturn="";

    $q="SELECT * FROM issuebook where userid='$userloginid'";
    $recordSetss=$this->connection->query($q);


    foreach($recordSetss->fetchAll() as $row) {
        $issuereturn=$row['issuereturn'];
        $fine=$row['fine'];
        $newfine= $fine;

        
            //  $newbookrent=$row['bookrent']+1;
    }


    $getdate= date("d/m/Y");
    if($issuereturn<$getdate){
        $q="UPDATE issuebook SET fine='$newfine' where userid='$userloginid'";

        if($this->connection->exec($q)) {
            $q="SELECT * FROM issuebook where userid='$userloginid' ";
            $data=$this->connection->query($q);
            return $data;
        }
        else{
            $q="SELECT * FROM issuebook where userid='$userloginid' ";
            $data=$this->connection->query($q);
            return $data;  
            
        }

    }
    else{
        $q="SELECT * FROM issuebook where userid='$userloginid'";
        $data=$this->connection->query($q);
        return $data;

    }
}

  /*function searchBookByName($bookName) {
    $q = "SELECT * FROM book WHERE bookname LIKE '%$bookName%'";
    $data = $this->connection->query($q);
    return $data;
} */

// In your data_class.php file
function searchBooks($bookName, $category) {
    $query = "SELECT bookpic,bookname,bookaudor,bookpub,bookdetail FROM book WHERE bookname LIKE '%$bookName%'";

    if (!empty($category)) {
        $query .= " AND bookdetail = '$category'";
    }

    $data = $this->connection->query($query);
    return $data;
}

function display_allbooks(){
    $query="SELECT bookpic,bookname,bookaudor,bookpub,bookdetail FROM book ";
    $data = $this->connection->query($query);
    return $data;
}



// Isssued Book Record by Userid
function fetchIssuedBooksByUserId($userId)
{
    $q = "SELECT issuename, issuebook, issuedate, issuereturn, fine, issuetype FROM `issuebook` WHERE userid = '$userId'";
    $data = $this->connection->query($q);
    return $data;

}

// GROUP BY Function
function fetchFineDatabyUserID($userId)
{
    $q = "SELECT SUM(fine), COUNT(*) FROM `issuebook` WHERE userid = '$userId' GROUP BY userid";
    $data = $this->connection->query($q);
    return $data;
}


function getUserIssuedBooksSummary($userId) {
    $query = "SELECT SUM(fine) AS totalFine, COUNT(*) AS totalBooks FROM issuebook WHERE userid = :userId";
    $stmt = $this->connection->prepare($query);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

}



