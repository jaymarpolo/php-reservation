<?php 
session_start(); 
require 'connect.php';
if(empty($_SESSION['email'])){
	header("location:signin.php");
}
?>