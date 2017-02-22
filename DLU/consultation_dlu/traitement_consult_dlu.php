<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="styling.css" />
        <title>Consultation DLU</title>
    </head>
 <body>
  <h1 >Consultation d'un abonné dans DLU ERRIADH</h1>
  


  
  
  <?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'faithinGOD4862', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}


 $result = $bdd->prepare(' SELECT ID FROM dlu_erriadh2 WHERE NUM = ? ');
     $result->execute(array($_POST['NUM'] ));
	 $num_exist =$result->rowCount() ;
	 



	
	                          
if($num_exist != 0 AND isset($_POST['NUM']) ) 

{
	  $numero=htmlspecialchars($_POST['NUM']) ;
	   if (preg_match("#^7[39]([0-9]){6}$#", $_POST['NUM']))
		 {
			 	 //affichage
				   $affiche = $bdd->prepare('SELECT ID,Dlu,Shelf,Slot,Port,NUM,Nature,Data,Local,OP,Ref,Aff,Date, Type,Service_Supl,Restrictions,Date_Rest,Observations FROM dlu_erriadh2 WHERE NUM = ? ');
                               $affiche->execute(array($numero));
						

                               while ($donnees = $affiche->fetch())
                               {
                                   ?>
                                 
                                   <p> 
								 
								    <strong class="s1"> ID</strong>: <?php echo $donnees['ID'] ?>  <br/>
									  <strong class="s1">Dlu</strong>: <?php echo $donnees['Dlu'] ?>  <br/>
									  <strong class="s1">Shelf</strong>: <?php echo $donnees['Shelf'] ?>  <br/>
									  <strong class="s1">Slot</strong>: <?php echo $donnees['Slot'] ?>  <br/>
									  <strong class="s1">Port</strong>: <?php echo $donnees['Port'] ?>  <br/>
									  <strong class="s1">Numéro</strong>: <?php echo $donnees['NUM'] ?>  <br/>
									  <strong class="s1">Nature</strong>: <?php echo $donnees['Nature'] ?>  <br/>
									  <strong class="s1"> Data</strong>: <?php echo $donnees['Data'] ?>  <br/>
								     <strong class="s1">Local</strong>: <?php echo $donnees['Local'] ?><br/>
                                   
									 <strong class="s1"> Opération</strong>: <?php echo $donnees['OP'] ?>  <br/>
									  <strong class="s1"> Ref</strong>: <?php echo $donnees['Ref'] ?>  <br/>
									   <strong class="s1">Affaire</strong>: <?php echo$donnees['Aff'] ?>  <br/>
									    <strong class="s1"> Date</strong>: <?php echo $donnees['Date'] ?>  <br/>
										 <strong class="s1"> Type</strong>: <?php echo $donnees['Type'] ?>  <br/>
										 
										  <strong class="s1">Service_supl</strong>: <?php echo $donnees['Service_Supl'] ?>  <br/>
										  <strong class="s1">Restrictions</strong>: <?php echo $donnees['Restrictions'] ?>  <br/>
										  <strong class="s1"> Date_Rest</strong>: <?php echo $donnees['Date_Rest'] ?>  <br/>
										   <strong class="s1">Observations</strong>: <?php echo $donnees['Observations'] ?>  <br/>
						
                                  </p>
	
                                 <?php
								
                               }
						
                          						
                       $affiche->closeCursor();
		
			 
			 
			 
		 
		 }
		 else {
			                  ?>
							   <p>Le Numero <strong class="s1">n'est pas valide .<strong> Recommencez  .</p>
							   <?php
		      }
	  
	  
	  
}
else 
{
	                      ?> 
									 <p>Le Numero<strong class="s1"> n'existe pas</strong> dans la base de donnée .</p>
	                      <?php
}
  
  
  
  
  
 ?> 
                       <p>
						Si vous souhaitez visiter <strong class="s1">la page de modification</strong> <a href="acceuil_consult_dlu.php">Cliquez ici</a><br />
                        </p>
  

</form>


</body>
</html>