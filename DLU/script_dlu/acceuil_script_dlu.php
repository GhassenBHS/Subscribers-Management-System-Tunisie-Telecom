<?php   session_start();  ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="styling.css" />
        <title>Script DLU Erriadh</title>
    </head>
 <body>
  <h1 >Script pour la modification des abonnés dans DLU Erriadh</h1>
  
      <?php
      if(!isset($_SESSION['use'])) // If session is not set redirect to Login Page                            {
          { header("Location:Login.php");  
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
  
    session_unset();     
    session_destroy();   
	header("Location:Login.php");
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
?>
  

<form action="traitement_script_dlu.php" method="post" enctype="multipart/form-data">

    <label class="no">Veuillez choisir un fichier . Notez bien que la <strong class="s1">forme</strong> devrait etre<strong class="s1"> "NUMERO"="OPERATION" </strong> . </label> <br /><br /><br /> 
	
    <input type="file" name="fileToUpload" class="s1"><br /><br /><br /> 
    <input type="submit" value="Executer" name="submit" class="s1"> 
	
</form> <br /><br /><br /> 
<form action="supprime_script_dlu.php" method="post">
 <input type="submit" value="Supprimer" name="submit" class="s1"> <label class="no">Cliquez pour <strong class="s1">supprimer</strong> le contenu du dossier d'importation</label> <br /><br /><br /> 
 </form>


</body>
</html>