<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="styling.css" />
        <title>Modifier IPMSAN</title>
    </head>
 <body>


<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'faithinGOD4862', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
         $numero=htmlspecialchars($_POST['NUM']) ;
	
      	 if ( isset($numero)  AND preg_match("#^7[39]([0-9]){6}$#", $numero))
		 {

	 
    
     $result = $bdd->prepare(' SELECT ID FROM ipmsan_tout WHERE NUM = ? ');
     $result->execute(array($numero ));
	 $count =$result->rowCount() ;
	 
	   
	
	                          
if($count != 0) 

{
     

                  mysql_connect("localhost","root","faithinGOD4862") or die(mysql_error());
                  mysql_select_db("test") or die(mysql_error());
				  
				    $adresse = mysql_query("SELECT Adresse_IP FROM ipmsan_tout WHERE NUM ='$numero' ") or die(mysql_error());
                    $adresse_search = mysql_fetch_array($adresse) or die(mysql_error());
					$string_adresse=$adresse_search['Adresse_IP'] ;
				  
				  $loc = mysql_query("SELECT Local FROM ipmsan_tout WHERE Adresse_IP='$string_adresse' ORDER BY Local DESC LIMIT 1") or die(mysql_error());
                  $row_loc = mysql_fetch_array($loc) or die(mysql_error());

                        $req1 = $bdd->prepare('UPDATE ipmsan_tout SET  Nature= :nature_nv,Local= :local_nv,Data= :data_nv,OP = :op_nv,Aff= :aff_nv,Type= :type_nv,Service_Supl =:services_nv,Restrictions =:restriction_nv,Date = CURDATE() WHERE NUM = :num_nv');
   
				
					if ( isset($_POST['Obs']) AND isset($_POST['choix1']) AND isset($_POST['choix2']) AND isset($_POST['choix3']) AND isset($_POST['choix4']) AND isset($_POST['choix5']) AND isset($_POST['choix6']) AND isset($_POST['choix7']))
                        { 
                          
                                  $req1->execute(array(
                                           'num_nv' =>  $numero,
										    'local_nv' => $row_loc['Local']+1,
	                                       'nature_nv' => $_POST['choix1'],
                                           'data_nv' => $_POST['choix2'],
										   'op_nv' => $_POST['choix3'],
                                           'aff_nv' => $_POST['choix4'],
                                           'type_nv' => $_POST['choix5'],
                                           'services_nv' => $_POST['choix6'],
                                           'restriction_nv' => $_POST['choix7']
                                                       ));
													   if ($_POST['Obs']!="")
													   {  $mod_obs = $bdd->prepare('UPDATE ipmsan_tout SET  Observations= :observations_nv WHERE NUM = :num_nv');
														  $mod_obs->execute(array('num_nv' => $numero,'observations_nv' => $_POST['Obs']));
					                                      $mod_obs->closeCursor();    
													   }
													   					if ($_POST['choix7']!="Neant")
	          {
		           $mod_dateRest=$bdd->prepare('UPDATE ipmsan_tout SET Date_Rest = CURDATE() WHERE NUM = :num_nv');
		           $mod_dateRest->execute(array('num_nv' => $numero));
	               $mod_dateRest->closeCursor();
	           }
	                          
								 $req1->closeCursor();
	

                               $req2 = $bdd->prepare('SELECT NUM, Nature,Data,OP,Aff,Type,Local,Service_Supl,Restrictions,Observations FROM ipmsan_tout WHERE NUM = ? ');
                               $req2->execute(array($numero));
						

                               while ($donnees = $req2->fetch())
                               {
                                   ?>
                                   <h1 >Modification d'un Abonné </h1>
                                   <p> 
								   L'opération s'est effectuée avec succée . <strong>L'abonné a bien été modifié !</strong><br/>
	                               A titre de vérification , vous avez modifié l'abonnée ayant pour<strong class="n1"> Numéro </strong>: <?php echo $donnees['NUM'] ?> Commme suivant : <br/>
                                    <strong class="n1"> Nature</strong>: <?php echo $donnees['Nature'] ?>  <br/>
									 <strong class="n1"> Data</strong>: <?php echo $donnees['Data'] ?>  <br/>
									  <strong class="n1"> OP</strong>: <?php echo $donnees['OP'] ?>  <br/>
									   <strong class="n1"> Aff</strong>: <?php echo$donnees['Aff'] ?>  <br/>
									    <strong class="n1"> Type</strong>: <?php echo $donnees['Type'] ?>  <br/>
										 <strong class="n1"> Services</strong>: <?php echo $donnees['Service_Supl'] ?>  <br/>
										 <strong class="n1">Local</strong>: <?php echo $donnees['Local'] ?>  <br/>
										  <strong class="n1"> Restriction</strong>: <?php echo$donnees['Restrictions'] ?>  <br/>
										  <strong class="n1"> Observations</strong>: <?php echo $donnees['Observations'] ?>  <br/>
										  
    	                          
	                              
	 
                                  </p>
	
                                 <?php
								
                               }
						
                          						
                       $req2->closeCursor(); 
					   
                           
        
	 
	 if ($_POST['choix7']!="Neant")
	 {
		 $mod_dateRest=$bdd->prepare('UPDATE dlu_erriadh2 SET Date_Rest = CURDATE() WHERE NUM = :num_nv');
		  $mod_dateRest->execute(array('num_nv' => $numero));
	                             $mod_dateRest->closeCursor();
	 }
	 
}

}

else { 
	?> 
						<p>
						Une <strong class="s1">erreur</strong> s'est produite ! Le <strong class="n55">numéro</strong> n'existe pas  ! 
						</p>
	<?php
	
}
}
          else 
                {
					     ?>
							   <p>Le Numero <strong class="s1">n'est pas valide .<strong> Recommencez  .</p>
							   <?php
	
                }

	






?>

   
	
	
	<p>Si vous souhaitez visiter <strong class="n55">la page de modification</strong> <a href="acceuil_modifier_abonne_msan.php">Cliquez ici</a><br />
</p>
</body>
</html>
	   