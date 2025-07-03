


<?php
$server="localhost";
$user="root";
$password="";
$dbName="emailverify";

$databaseconfig= new mysqli($server,$user,$password,$dbName);
if($databaseconfig->connect_error){
    http_response_code(500);//internal server error
  
}
?>