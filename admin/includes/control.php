<?php
session_start();
include 'connect.php';
if(empty($_SESSION['username'])){
	header("location:login.php");
}
?>