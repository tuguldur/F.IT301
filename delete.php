<?php
require './lib/config.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $result = $connect->query("DELETE FROM students WHERE id=$id");
    if($result){
        header("location: list.php");
    }
    else{
        echo 'Error';
    }
}
else{ 
    header("location: list.php");
}