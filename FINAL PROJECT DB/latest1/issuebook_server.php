<?php

include("data_class.php");

$book=$_POST['book'];
$userselect= $_POST['userselect'];
$getdate= Date('y/m/d');
$days= $_POST['days'];

//$issueDate=Date('y/m/d', strtotime('+'.$days.'days'));
$returnDate=Date('y/m/d', strtotime('+'.$days.'days'));
//$returnDate = date('d/m/Y', strtotime('+21 days'));

$obj=new data();
$obj->setconnection();
$obj->issuebook($book,$userselect,$days,$getdate,$returnDate);
