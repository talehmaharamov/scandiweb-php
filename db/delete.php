<?php 
require 'database.php';
$database = new Database();
$conn = $database->dbConnection();

foreach($_POST['arr1'] as $id){
$count=$conn->prepare("DELETE FROM products WHERE id=:id");
$count->bindParam(":id",$id,PDO::PARAM_INT);
$count->execute();
}
?>