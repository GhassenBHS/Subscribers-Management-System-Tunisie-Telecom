<?php
 session_start();

  echo "Logout Successfully ";
  session_destroy();
session_cache_expire() ;
session_unset();   // function that Destroys Session 
  header("Location: Login.php");
?>