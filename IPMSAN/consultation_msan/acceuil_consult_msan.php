<?php  session_start(); ?> 
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="styling.css" />
        <title>Consultation IPMSAN</title>
    </head>
 <body>
  <h1 >Consultation d'un abonné dans la base IPMSAN</h1>
  
       <?php
      if(!isset($_SESSION['use']))
{		  // If session is not set redirect to Login Page                            {
           header("Location:Login.php");  
}	   
else
{
	      ?>

         <h2 class="s2">  <?php echo $_SESSION['use'] ?>

          Login avec Succée !</h2> 

          <label class="s1">Pour se <strong>deconnecter</strong> de la session </label> <a href='logout.php' class="s1">Cliquez ici .</a> 
		  <?php
		   }
		   		   if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] >1800 )) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();
header("Location:Login.php");	
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
?>
  
  
  <form action="traitement_consult_msan.php" method ="post"> 

<p>
<label class="no">Numéro de l'abonné</label> <input class="s1" type="text" name="NUM" /> <br /><br /><br />
<input class="s1" type="submit" name="valider" value="Consulter" /><br />

</p>

</form>


</body>
</html>