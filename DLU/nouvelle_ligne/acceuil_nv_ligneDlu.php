<?php   session_start();  ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="styling.css" />
        <title>Ajout d'une nouvelle entrée dans la base DLU</title>
    </head>
 <body>
  <h1 >Ajout d'une nouvelle entrée dans la base DLU</h1>
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
    // last request was more than 30 minutes ago
    session_unset();    
    session_destroy(); 
header("Location:Login.php");	
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
?>
  
  
  
  <form action="traitement_nv_ligneDlu.php" method ="post"> 

<p>
<label class="no">Numéro de l'abonné</label> <input class="s1" type="text" name="NUM" /> <br /><br /><br />
<label class="no">DLU</label> <input class="s1" type="text" name="dlu" /> <br /><br /><br />
<label class="no">Shelf</label> <input class="s1" type="text" name="shelf" /> <br /><br /><br />
<label class="no">Slot</label> <input class="s1" type="text" name="slot" /> <br /><br /><br />
<label class="no">Port</label> <input class="s1" type="text" name="port" /> <br /><br /><br />
<label class="no">Nature</label> <input class="s1" type="text" name="nature" /> <br /><br /><br />
<label class="no">Data</label> <input class="s1" type="text" name="data" /> <br /><br /><br />
<label class="no">Local</label> <input class="s1" type="text" name="local" /> <br /><br /><br />
<label class="no">Opération</label> <input class="s1" type="text" name="op" /> <br /><br /><br />
<label class="no">Réference</label> <input class="s1" type="text" name="ref" /> <br /><br /><br />
<label class="no">Affaire</label> <input class="s1" type="text" name="aff" /> <br /><br /><br />

<label class="no">Date</label> <input class="s1" type="text" name="date" /> <br /><br /><br />
<label class="no">Type</label> <input class="s1" type="text" name="type" /> <br /><br /><br />
<label class="no">Service_Supl</label> <input class="s1" type="text" name="service_supl" /> <br /><br /><br />
<label class="no">Restrictions</label> <input class="s1" type="text" name="restrictions" /> <br /><br /><br />
<label class="no">Date_Rest</label> <input class="s1" type="text" name="date_rest" /> <br /><br /><br />
<label class="no">Observations</label> <input class="s1" type="text" name="observations" /> <br /><br /><br />

<input class="no" type="submit" name="valider" value="Ajouter entrée" /><br />

</p>

</form>


</body>
</html>