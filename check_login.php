<?php
//check for login autorization and its roll type
   function login(){
	    if(isset($_SESSION['user_name'])){
	         $user_name = $_SESSION['user_name'];
	    }else{
	        header("location:index.php");
			die();
	    }
	}
?>