<?php  session_start(); ?>  

<?php

if(isset($_SESSION['use']))   // Checking whether the session is already there or not if 
                              // true that header redirect it to the home page directly 
 {
    header("Location:acceuil_script_dlu.php"); 
 }

if(isset($_POST['login']))   // it checks whether the user clicked login button or not 
{
     $user = $_POST['user'];
     $pass = $_POST['pass'];

      if($user == "Ank" && $pass == "1234")  // username is  set to "Ank"  and Password   
         {                                   // is 1234 by default     

          $_SESSION['use']=$user;


         ?> <script type="text/javascript"> window.open("acceuil_script_dlu.php","_self");</script> <?php           //  On Successfull Login redirects to home.php

        }

        else
        {
            ?> <p> invalid UserName or Password   </p>   <?php  
        }
}
 ?>
 <!DOCTYPE html>
<html>
<head>

        <meta charset="utf-8" />
		<link rel="stylesheet" href="styling.css" />
        <title>Consultation DLU</title>

</head>

<body>
<h1>Tunisie Telecom Home Page </h1>

<form action="" method="post">

    <table width="200" border="0">
  <tr>
    <td class="s1">  UserName</td>
    <td> <input type="text" name="user" class="s1" > </td>
  </tr></br>
  <tr>
    <td class="s1"> PassWord  </td>
    <td><input type="password" name="pass" class="s1"></td>
  </tr>
  <tr>
    <td class="s1"> <input type="submit" name="login" value="LOGIN" class="s1"></td>
    <td></td>
  </tr>
</table>
</form>

</body>
</html>