<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="styling.css" />
        <title>Nouvelle entrée IPMSAN</title>
    </head>
 <body>
  <h1 >Ajout d'une nouvelle entrée dans la base IPMSAN</h1>
  


  
  
  <?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'faithinGOD4862', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}


     $result = $bdd->prepare(' SELECT ID FROM ipmsan_tout WHERE NUM = ? ');
     $result->execute(array($_POST['NUM'] ));
	 $num_exist =$result->rowCount() ;
	 

$numero=htmlspecialchars($_POST['NUM']) ;
            
	                          
if($num_exist == 0 OR $numero==0 ) 

{   



	
	
	
	
	   
	   if (preg_match("#^7[39]([0-9]){6}$#", $numero) OR $numero==0)
		 {



$sql = $bdd->prepare('INSERT INTO ipmsan_tout(Adresse_IP,Shelf,Slot,Port,TID,NUM,Nature,Reg,Eqt,Data,Slot_D,Port_D,Local,OP,Ref,Aff,Date, Type,Service_Supl,Restrictions,Date_Rest,Observations)
 VALUES(:nv_adr,:nv_Shelf,:nv_Slot,:nv_Port,:nv_tid,:nv_NUM,:nv_Nature,:nv_Reg,:nv_Eqt,:nv_Data,:nv_Slot_D,:nv_Port_D,:nv_Local,:nv_OP,:nv_Ref,:nv_Aff,:nv_Date, :nv_Type,:nv_Service_Supl,:nv_Restrictions,:nv_Date_Rest,:nv_Observations)');
 $sql->execute(array(
    'nv_adr' =>htmlspecialchars($_POST['choix_ip']),
	'nv_Shelf' =>htmlspecialchars($_POST['shelf']),
	'nv_Slot' =>htmlspecialchars($_POST['slot']),
	'nv_Port' => htmlspecialchars($_POST['port']),
	'nv_tid' => htmlspecialchars($_POST['tid']),
	'nv_NUM' =>$numero,
	'nv_Nature' =>htmlspecialchars($_POST['nature']),
	'nv_Reg' =>htmlspecialchars($_POST['reg']),
	
	'nv_Eqt' =>htmlspecialchars($_POST['eqt']),
	'nv_Data' => htmlspecialchars($_POST['data']),
	'nv_Slot_D' => htmlspecialchars($_POST['slot_D']),
	'nv_Port_D' => htmlspecialchars($_POST['port_D']),
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
 <p>
						Si vous souhaitez visiter <strong class="s1">la page de modification</strong> <a href="acceuil_nv_ligne_msan.php">Cliquez ici</a><br />
                        </p>
						
						
						
						

</body>
</html>
