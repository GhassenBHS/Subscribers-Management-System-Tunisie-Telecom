<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="styling.css" />
        <title>Ajout d'une nouvelle entrée dans la base DLU</title>
    </head>
 <body>
  <h1 >Ajout d'une nouvelle entrée dans la base DLU</h1>
  <form action="ajout_abonne.php" method ="post"> 


  
  
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
	 

$numero=htmlspecialchars($_POST['NUM']) ;
            
	                          
if($num_exist == 0 OR $numero==0 ) 

{   



	
	
	
	
	   
	   if (preg_match("#^7[39]([0-9]){6}$#", $numero) OR $numero==0)
		 {



$sql = $bdd->prepare('INSERT INTO dlu_erriadh2(Dlu,Shelf,Slot,Port,NUM,Nature,Data,Local,OP,Ref,Aff,Date, Type,Service_Supl,Restrictions,Date_Rest,Observations)
 VALUES(:nv_Dlu,:nv_Shelf,:nv_Slot,:nv_Port,:nv_NUM,:nv_Nature,:nv_Data,:nv_Local,:nv_OP,:nv_Ref,:nv_Aff,:nv_Date, :nv_Type,:nv_Service_Supl,:nv_Restrictions,:nv_Date_Rest,:nv_Observations)');
 $sql->execute(array(
    'nv_Dlu' =>htmlspecialchars($_POST['dlu']),
	'nv_Shelf' =>htmlspecialchars($_POST['shelf']),
	'nv_Slot' =>htmlspecialchars($_POST['slot']),
	'nv_Port' => htmlspecialchars($_POST['port']),
	'nv_NUM' =>$numero,
	'nv_Nature' =>htmlspecialchars($_POST['nature']),
	'nv_Data' => htmlspecialchars($_POST['data']),
	'nv_Local' =>htmlspecialchars($_POST['local']),
	'nv_OP' => htmlspecialchars($_POST['op']),
	'nv_Ref' =>htmlspecialchars($_POST['ref']),
	'nv_Aff' =>htmlspecialchars($_POST['aff']),
	'nv_Date' =>htmlspecialchars($_POST['date']),
	'nv_Type' => htmlspecialchars($_POST['type']),
	'nv_Service_Supl' => htmlspecialchars($_POST['service_supl']),
	'nv_Restrictions' => htmlspecialchars($_POST['restrictions']),
	'nv_Date_Rest' => htmlspecialchars($_POST['date_rest']),
	'nv_Observations' => htmlspecialchars($_POST['observations'])
	

	));
	
	 $sql->closeCursor();
	                           ?>
							   <p>Une nouvelle<strong class="s1"> entrée<strong> s'est ajoutée avec succée !</p>
							   <?php
	
		 }
		  else {
			                  ?>
							   <p>Le Numero <strong class="s1">n'est pas valide .<strong> Recommencez  !</p>
							   <?php
		      }
}
	
	else 
{
	                      ?> 
									 <p>Le Numero<strong class="s1"> existe</strong> dans la base de donnée .</p>
	                      <?php
}
							   
							   
							   
							   
							   
							   
							   
							   
 							   
							   
							   
							   
							   

?>

	<p>Si vous souhaitez visiter <strong class="s1">la page de modification</strong> <a href="acceuil_nv_ligneDlu.php">Cliquez ici</a><br />
</p>

</body>
</html>