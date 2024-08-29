<?php
//make user logout from system, in fact destroy all sessions and cookies of the user
function logout(){
        $_SESSION = array();
        session_unset();
        session_destroy();
        header("Location:index.php");
        die();
	}
?>