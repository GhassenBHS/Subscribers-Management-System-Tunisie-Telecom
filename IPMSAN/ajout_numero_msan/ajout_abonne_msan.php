<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="styling.css" />
        <title>Ajout d'un abonné IPMSAN</title>
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

     $result = $bdd->prepare(' SELECT ID FROM ipmsan_tout WHERE NUM = ? ');
     $result->execute(array($_POST['NUM'] ));
	 $num_exist =$result->rowCount() ;
	 



	
	                          
if($num_exist == 0 AND isset($_POST['NUM']) ) 

{
	  $numero=htmlspecialchars($_POST['NUM']) ;
      $nature=htmlspecialchars($_POST['choix_nature']) ;
      $string_adresse=htmlspecialchars($_POST['choix_msan']) ;
	 if (preg_match("#^7[39]([0-9]){6}$#", $_POST['NUM']))
		 {
			 
			 
			 

   switch ($string_adresse) 
{ 
    case "172.24.3.156": 
        $borne_adr_inf=1;

		$borne_adr_sup=144;
    break;
	 case "172.24.3.157": 
        $borne_adr_inf=145;
	
		$borne_adr_sup=288;
    break;
	 case "172.24.3.158": 
       $borne_adr_inf=289;
		$borne_adr_sup=360;
    break;
	case "172.24.3.159": 
       $borne_adr_inf=361;
		$borne_adr_sup=696;
    break;
	case "172.24.3.163": 
       $borne_adr_inf=697;
		$borne_adr_sup=768;
    break;
	case "172.24.240.4": 
       $borne_adr_inf=769;
		$borne_adr_sup=1248;
    break;
	case "172.24.240.8": 
       $borne_adr_inf=1249;
		$borne_adr_sup=1312;
    break;

    default:
        echo "Pas de message à afficher pour cette MSAN";
}
  
  $req_de_base = $bdd->prepare('SELECT ID,NUM,Adresse_IP FROM ipmsan_tout WHERE NUM BETWEEN :borne_inf AND :borne_sup  ORDER BY NUM  LIMIT 1');
  $req_de_base->execute(array('borne_inf'=>$numero+1,'borne_sup'=>$numero+100000));
  $found =$req_de_base->rowCount() ; 

	  $req_de_base2 = $bdd->prepare('SELECT ID,NUM,Adresse_IP FROM ipmsan_tout WHERE NUM BETWEEN :borne_inf AND :borne_sup ORDER BY NUM DESC LIMIT 1');
      $req_de_base2->execute(array('borne_inf'=>$numero-100000,'borne_sup'=>$numero-1));
      $found_arriere =$req_de_base2->rowCount() ; 
$continue_search=false ;
if ($found!=0)
{
	
	$trouve1=false ;
	$trouve2=false  ;
	echo $trouve1 ;
	
while ($donnees = $req_de_base->fetch())
{
	
	
	$rang1=$donnees['ID'] ;
	$rang2=$donnees['ID'] ;
	

	
	
		 while ( $trouve1==false AND ( ($rang1>$borne_adr_inf AND $rang1<$borne_adr_sup) OR ($rang1>=1312 AND $rang1<=20000)        )  )

	{   
        $rang1 -- ; 
		$num_vide=$bdd->prepare('SELECT ID,NUM FROM ipmsan_tout WHERE NUM=0 AND ID = :id AND Nature= :nature AND Adresse_IP= :adresse_nbr_found LIMIT 1');
		$num_vide->execute(array('id'=>$rang1,'nature'=>$nature,'adresse_nbr_found'=>$string_adresse     ));
		$found_num=$num_vide->rowCount() ;
		
		if ($found_num != 0)
		{
			$trouve1=true ;
			
			
		}
		$num_vide->closeCursor();
		$found_num=0 ;
		
	} 
	
	
	
	

                 if ($trouve1==true)
                  {
                  mysql_connect("localhost","root","faithinGOD4862") or die(mysql_error());
                  mysql_select_db("test") or die(mysql_error());
				  
				  $loc = mysql_query("SELECT Local FROM ipmsan_tout WHERE Adresse_IP='$string_adresse' ORDER BY Local DESC LIMIT 1") or die(mysql_error());
                  $row_loc = mysql_fetch_array($loc) or die(mysql_error());
				
                   $put=$bdd->prepare('UPDATE ipmsan_tout SET  NUM= :nv_num,OP= :nv_operation,Type= :nv_type,Aff= :nv_aff ,Local =:nv_local,Service_Supl= :nv_service_supl,Ref= :nv_ref,Date=CURDATE(),Restrictions= :nv_rest WHERE ID= :nv_tid ');
		           $put->execute(array(
	                                 'nv_num' => $numero,
									 'nv_tid' => $rang1,
									 'nv_operation' =>$_POST['choix_op'] ,
									 'nv_local' => $row_loc['Local']+1,
									 'nv_service_supl' => $_POST['choix_service'],
	                                 'nv_type' => $_POST['choix_type'] ,
									 'nv_aff' => $_POST['choix_aff'] ,
									 'nv_rest' => $_POST['choix_rest'],
     							     'nv_ref' => $_POST['Ref']  ));
								
								if ($_POST['choix_rest']!="Neant")
	          {
		           $mod_dateRest=$bdd->prepare('UPDATE ipmsan_tout SET Date_Rest = CURDATE() WHERE NUM = :num_nv');
		           $mod_dateRest->execute(array('num_nv' => $numero));
	               $mod_dateRest->closeCursor();
	           }
	                                
		
		           $put->closeCursor() ;
		           mysql_close();
				   //affichage
				   $affiche = $bdd->prepare('SELECT NUM,ID,Adresse_IP,Shelf,Slot,Port,Type,Service_Supl,Restrictions FROM ipmsan_tout WHERE NUM = ? ');
                               $affiche->execute(array($numero));
						

                               while ($donnees = $affiche->fetch())
                               {
                                   ?>
                                 
                                   <p> 
								   L'opération s'est effectuée avec succée . <strong class="n1">L'abonné a bien été placé !</strong><br/>
	                               A titre de vérification , vous avez ajouté l'abonné suivant : <br/>
								    <strong class="n1"> ID</strong>: <?php echo $donnees['ID'] ?>  <br/>
								     <strong class="n1"> Numero </strong>: <?php echo $donnees['NUM'] ?><br/>
                                   
									 <strong class="n1"> Adresse_IP</strong>: <?php echo $donnees['Adresse_IP'] ?>  <br/>
									  <strong class="n1"> Shelf</strong>: <?php echo $donnees['Shelf'] ?>  <br/>
									   <strong class="n1"> Slot</strong>: <?php echo$donnees['Slot'] ?>  <br/>
									    <strong class="n1"> Port</strong>: <?php echo $donnees['Port'] ?>  <br/>
										 <strong class="n1"> Type</strong>: <?php echo $donnees['Type'] ?>  <br/>
									     <strong class="n1">Service_supl</strong>: <?php echo $donnees['Service_Supl'] ?>  <br/>
										  <strong class="n1">Restrictions</strong>: <?php echo $donnees['Restrictions'] ?>  <br/>
						
                                  </p>
	
                                 <?php
								
                               }
						
                          						
                       $affiche->closeCursor(); 
				   
		
                }
               else 
			   {
	              
	         	            while ( $trouve2==false AND ( ($rang2>$borne_adr_inf AND $rang2<$borne_adr_sup) OR ($rang2>=1312 AND $rang2<=20000)        )  )

	                     {   
                             $rang2 ++ ; 
		                       $num_vide2=$bdd->prepare('SELECT ID,NUM FROM ipmsan_tout WHERE NUM=0 AND ID = :id AND Nature= :nature AND Adresse_IP= :adresse_nbr_found LIMIT 1');
		                       $num_vide2->execute(array('id'=>$rang2,'nature'=>$nature,'adresse_nbr_found'=>$string_adresse   ));
		                        $found_num2=$num_vide2->rowCount() ;
		                        if ($found_num2 != 0)
		                              {
			                           $trouve2=true ;
			                          
		                               }
		                        $num_vide2->closeCursor();
		                        $found_num2=0 ;
	                    } 
						
		        if ($trouve2==true)
                       {
                         mysql_connect("localhost","root","faithinGOD4862") or die(mysql_error());
                         mysql_select_db("test") or die(mysql_error());
						
						 
						 
				         $loc = mysql_query("SELECT Local FROM ipmsan_tout WHERE Adresse_IP='$string_adresse' ORDER BY Local DESC LIMIT 1") or die(mysql_error());
                         $row_loc = mysql_fetch_array($loc) or die(mysql_error());
				
                             $put=$bdd->prepare('UPDATE ipmsan_tout SET  NUM= :nv_num,OP= :nv_operation,Type= :nv_type,Aff= :nv_aff ,Local =:nv_local,Service_Supl= :nv_service_supl,Ref= :nv_ref,Date=CURDATE(),Restrictions= :nv_rest WHERE ID= :nv_tid ');
		           $put->execute(array(
	                                 'nv_num' => $numero,
									 'nv_tid' => $rang2,
									 'nv_operation' =>$_POST['choix_op'] ,
									 'nv_local' => $row_loc['Local']+1,
									 'nv_service_supl' => $_POST['choix_service'],
	                                 'nv_type' => $_POST['choix_type'] ,
									 'nv_aff' => $_POST['choix_aff'] ,
									 'nv_rest' => $_POST['choix_rest'], 
									 'nv_ref' => $_POST['Ref']  ));
									 
									 				if ($_POST['choix_rest']!="Neant")
	          {
		           $mod_dateRest=$bdd->prepare('UPDATE dlu_erriadh2 SET Date_Rest = CURDATE() WHERE NUM = :num_nv');
		           $mod_dateRest->execute(array('num_nv' => $numero));
	               $mod_dateRest->closeCursor();
	           }
	              
	                                
		
		                $put->closeCursor() ;
		                mysql_close();
						
						 //affichage
				   $affiche = $bdd->prepare('SELECT NUM,ID,Adresse_IP,Shelf,Slot,Port,Type,Service_Supl,Restrictions FROM ipmsan_tout WHERE NUM = ? ');
                               $affiche->execute(array($numero));
						

                               while ($donnees = $affiche->fetch())
                               {
                                   ?>
                                 
                                   <p> 
								   L'opération s'est effectuée avec succée . <strong class="n1">L'abonné a bien été placé !</strong><br/>
	                               A titre de vérification , vous avez ajouté l'abonné suivant : <br/>
								  <strong class="n1"> ID</strong>: <?php echo $donnees['ID'] ?>  <br/>
								     <strong class="n1"> Numero </strong>: <?php echo $donnees['NUM'] ?><br/>
                                   
									 <strong class="n1"> Adresse_IP</strong>: <?php echo $donnees['Adresse_IP'] ?>  <br/>
									  <strong class="n1"> Shelf</strong>: <?php echo $donnees['Shelf'] ?>  <br/>
									   <strong class="n1"> Slot</strong>: <?php echo$donnees['Slot'] ?>  <br/>
									    <strong class="n1"> Port</strong>: <?php echo $donnees['Port'] ?>  <br/>
										 <strong class="n1"> Type</strong>: <?php echo $donnees['Type'] ?>  <br/>
											  <strong class="n1">Service_supl</strong>: <?php echo $donnees['Service_Supl'] ?>  <br/>
										  <strong class="n1">Restrictions</strong>: <?php echo $donnees['Restrictions'] ?>  <br/>
						
                                  </p>
	
                                 <?php
								
                               }
						
                          						
                       $affiche->closeCursor();
		
	                    }
						
	                       else 
		                            { 
								
							
								
								$continue_search=true ;
		                  
						  
	                                 }
	
	
	
	
	
	
	
	
	
                }
	 
	 

}

}    

   if ($found_arriere!=0 AND  ($continue_search==true OR $found==0 ) )
	 
{
	$trouve1=false ;
	$trouve2=false  ;
while ($donnees = $req_de_base2->fetch())
{
	
	
	$rang1=$donnees['ID'] ;
	$rang2=$donnees['ID'] ;
	
	
	while ( $trouve1==false AND ( ($rang1>$borne_adr_inf AND $rang1<$borne_adr_sup) OR ($rang1>=1312 AND $rang1<=20000)        )  )
	{   
        $rang1 ++ ;  
		$num_vide=$bdd->prepare('SELECT ID,NUM FROM ipmsan_tout WHERE NUM=0 AND ID = :tid AND Nature= :nature AND Adresse_IP= :adresse_nbr_found  LIMIT 1');
		$num_vide->execute(array('tid'=>$rang1,'nature'=>$nature,'adresse_nbr_found'=>$string_adresse));
		$found_num=$num_vide->rowCount() ;
		if ($found_num != 0)
		{
			$trouve1=true ;
			
		}
		$num_vide->closeCursor();
		$found_num=0 ;
		
	} 
	
	
	

                 if ($trouve1==true)
                  {
                  mysql_connect("localhost","root","faithinGOD4862") or die(mysql_error());
                  mysql_select_db("test") or die(mysql_error());
				        
				  
				  $loc = mysql_query("SELECT Local FROM ipmsan_tout WHERE Adresse_IP='$string_adresse' ORDER BY Local DESC LIMIT 1") or die(mysql_error());
                  $row_loc = mysql_fetch_array($loc) or die(mysql_error());
				
                     $put=$bdd->prepare('UPDATE ipmsan_tout SET  NUM= :nv_num,OP= :nv_operation,Type= :nv_type,Aff= :nv_aff ,Local =:nv_local,Service_Supl= :nv_service_supl,Ref= :nv_ref,Date=CURDATE(),Restrictions= :nv_rest WHERE ID= :nv_tid ');
		           $put->execute(array(
	                                 'nv_num' => $numero,
									 'nv_tid' => $rang1,
									 'nv_operation' =>$_POST['choix_op'] ,
									 'nv_local' => $row_loc['Local']+1,
									 'nv_service_supl' => $_POST['choix_service'],
	                                 'nv_type' => $_POST['choix_type'] ,
									 'nv_aff' => $_POST['choix_aff'] ,
									 'nv_rest' => $_POST['choix_rest'], 
									 'nv_ref' => $_POST['Ref']  ));
	                                
													if ($_POST['choix_rest']!="Neant")
	          {
		           $mod_dateRest=$bdd->prepare('UPDATE ipmsan_tout SET Date_Rest = CURDATE() WHERE NUM = :num_nv');
		           $mod_dateRest->execute(array('num_nv' => $numero));
	               $mod_dateRest->closeCursor();
	           }
	              
		
		           $put->closeCursor() ;
		           mysql_close();
				   
				    //affichage
				   $affiche = $bdd->prepare('SELECT NUM,ID,Adresse_IP,Shelf,Slot,Port,Type,Service_Supl,Restrictions FROM ipmsan_tout WHERE NUM = ? ');
                               $affiche->execute(array($numero));
						

                               while ($donnees = $affiche->fetch())
                               {
                                   ?>
                                 
                                   <p> 
								   L'opération s'est effectuée avec succée . <strong>L'abonné a bien été placé !</strong><br/>
	                               A titre de vérification , vous avez ajouté l'abonné suivant : <br/>
								    <strong class="n1"> ID</strong>: <?php echo $donnees['ID'] ?>  <br/>
								     <strong class="n1"> Numero </strong>: <?php echo $donnees['NUM'] ?><br/>
                                   
									 <strong class="n1"> Adresse_IP</strong>: <?php echo $donnees['Adresse_IP'] ?>  <br/>
									  <strong class="n1"> Shelf</strong>: <?php echo $donnees['Shelf'] ?>  <br/>
									   <strong class="n1"> Slot</strong>: <?php echo$donnees['Slot'] ?>  <br/>
									    <strong class="n1"> Port</strong>: <?php echo $donnees['Port'] ?>  <br/>
										 <strong class="n1"> Type</strong>: <?php echo $donnees['Type'] ?>  <br/>
											  <strong class="n1">Service_supl</strong>: <?php echo $donnees['Service_Supl'] ?>  <br/>
										  <strong class="n1">Restrictions</strong>: <?php echo $donnees['Restrictions'] ?>  <br/>
						
                                  </p>
	
                                 <?php
								
                               }
						
                          						
                       $affiche->closeCursor();
				   
		
                }
               else 
			   {
	            
	               while ( $trouve2==false AND ( ($rang2>$borne_adr_inf AND $rang2<$borne_adr_sup) OR ($rang2>=1312 AND $rang2<=20000)        )  )
	                     {   
                             $rang2 -- ;
		                       $num_vide2=$bdd->prepare('SELECT ID,NUM FROM ipmsan_tout WHERE NUM=0 AND ID = :tid AND Nature= :nature AND Adresse_IP= :adresse_nbr_found  LIMIT 1');
		                       $num_vide2->execute(array('tid'=>$rang2,'nature'=>$nature, 'adresse_nbr_found'=>$string_adresse));
		                        $found_num2=$num_vide2->rowCount() ;
		                        if ($found_num2 != 0)
		                              {
			                           $trouve2=true ;
			                           
		                               }
		                        $num_vide2->closeCursor();
		                        $found_num2=0 ;
	                    } 
						
		        if ($trouve2==true)
                       {
                         mysql_connect("localhost","root","faithinGOD4862") or die(mysql_error());
                         mysql_select_db("test") or die(mysql_error());
						 
						 
						 
				        $loc = mysql_query("SELECT Local FROM ipmsan_tout WHERE Adresse_IP='$string_adresse' ORDER BY Local DESC LIMIT 1") or die(mysql_error());
                         $row_loc = mysql_fetch_array($loc) or die(mysql_error());
				
                        $put=$bdd->prepare('UPDATE ipmsan_tout SET  NUM= :nv_num,OP= :nv_operation,Type= :nv_type,Aff= :nv_aff ,Local =:nv_local,Service_Supl= :nv_service_supl,Ref= :nv_ref,Date=CURDATE(),Restrictions= :nv_rest WHERE ID= :nv_tid ');
		           $put->execute(array(
	                                 'nv_num' => $numero,
									 'nv_tid' => $rang2,
									 'nv_operation' =>$_POST['choix_op'] ,
									 'nv_local' => $row_loc['Local']+1,
									 'nv_service_supl' => $_POST['choix_service'],
	                                 'nv_type' => $_POST['choix_type'] ,
									 'nv_aff' => $_POST['choix_aff'] ,
									 'nv_rest' => $_POST['choix_rest'], 
									 'nv_ref' => $_POST['Ref']  ));
	                                
													if ($_POST['choix_rest']!="Neant")
	          {
		           $mod_dateRest=$bdd->prepare('UPDATE ipmsan_tout SET Date_Rest = CURDATE() WHERE NUM = :num_nv');
		           $mod_dateRest->execute(array('num_nv' => $numero));
	               $mod_dateRest->closeCursor();
	           }
	              
		
		                $put->closeCursor() ;
		                mysql_close();
						
						 //affichage
				   $affiche = $bdd->prepare('SELECT NUM,ID,Adresse_IP,Shelf,Slot,Port,Type,Service_Supl,Restrictions FROM ipmsan_tout WHERE NUM = ? ');
                               $affiche->execute(array($numero));
						

                               while ($donnees = $affiche->fetch())
                               {
                                   ?>
                                 
                                   <p> 
								   L'opération s'est effectuée avec succée . <strong>L'abonné a bien été placé !</strong><br/>
	                               A titre de vérification , vous avez ajouté l'abonné suivant : <br/>
								    <strong class="n1"> ID</strong>: <?php echo $donnees['ID'] ?>  <br/>
								     <strong class="n1"> Numero </strong>: <?php echo $donnees['NUM'] ?><br/>
                                   
									 <strong class="n1"> Adresse_IP</strong>: <?php echo $donnees['Adresse_IP'] ?>  <br/>
									  <strong class="n1"> Shelf</strong>: <?php echo $donnees['Shelf'] ?>  <br/>
									   <strong class="n1"> Slot</strong>: <?php echo$donnees['Slot'] ?>  <br/>
									    <strong class="n1"> Port</strong>: <?php echo $donnees['Port'] ?>  <br/>
										 <strong class="n1"> Type</strong>: <?php echo $donnees['Type'] ?>  <br/>
										 
										  <strong class="n1">Service_supl</strong>: <?php echo $donnees['Service_Supl'] ?>  <br/>
										  <strong class="n1">Restrictions</strong>: <?php echo $donnees['Restrictions'] ?>  <br/>
						
                                  </p>
	
                                 <?php
								
                               }
						
                          						
                       $affiche->closeCursor();
		
	                    }
						 else 
		                            {
		                  ?> 
									 <p>Le programme n'a pas trouvé d'emplacement approprié . Vous pouvez essayer de le faire <strong class="n1">manuellement .</strong></p>
	                      <?php
	                                 }
						
	                   
		               
	                                 
	
	
	
	
	
	
	
	
	
                }
	 
	 

}
	
	
}
elseif ($found_arriere==0 AND  $found==0)

{
	                      ?> 
									 <p>Le programme n'a pas trouvé d'emplacement approprié . Vous pouvez essayer de le faire <strong class="n1">manuellement .</strong></p>
	                      <?php
     } 




$req_de_base2->closeCursor();

$req_de_base->closeCursor();



                         }
                          else
						  {    ?>
							   <p>Le Numero <strong class="n1">n'est pas valide .<strong> Recommencez  .</p>
							   <?php
						  }
}
else {
	                      ?> 
									 <p>Le Numero <strong class="n1">existe déja.</strong> dans la base de donnée </p>
	                      <?php
}	




















?>
                       <p>
						Si vous souhaitez visiter <strong class="n1">la page de modification</strong> <a href="acceuil_ajout_msan.php">Cliquez ici</a><br />
                        </p>


</body>
</html>



