<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="styling.css" />
        <title>Script IPMSAN</title>
    </head>
 <body>
  <h1 >Script pour modifier des abonnés dans la base IPMSAN </h1>


<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'faithinGOD4862', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}





$target_dir = "uploads/";
               $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
               $uploadOk = true;
               $FileType = pathinfo($target_file,PATHINFO_EXTENSION);
       $var=0;        
			 
			 
			 
			 
// Check if file already exists
            if (file_exists($target_file)) 
			   {
               ?> 
			   <p>"Désolé ! Le fichier est déjà existant ."</p> 
			   <?php 
               $uploadOk = false;
               }
			   elseif ($_FILES["fileToUpload"]["size"] > (1024000) ) 
		       {
              ?> 
			  <p>"DESOLE ! Le fichier est volumineux ."</p> 
			  <?php
              $uploadOk = false;
             }
			   // Allow certain file formats
			   
              elseif($FileType != "txt" && $FileType != "docx" && $FileType != "doc") 
			 {
              ?> 
			  <p> "DESOLE ! Seulement les fichiers Texte et Word sont acceptables ."</p> 
			  <?php
              $uploadOk = false;
             }

	// check file empty 		 
			  elseif ($_FILES["fileToUpload"]["size"] == 0 ) 
		       {
				    
              ?> 
			  <p>"DESOLE ! Le fichier est vide ."</p> 
			  <?php
               $uploadOk = false; 
             }
			 // Check file size
             

// Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == false) 
					{
                            ?> 
							<p> "DESOLE ! erreur dans le Upload ."</p>
							<?php
// if everything is ok, try to upload file
                    } 
					else 
	{            ?>
								 <h2 class="s1">Vous avez modifié la liste des abonnés suivante dans la base de donnée IPMSAN :</h2>
                                 <?php
                     if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
		
	  {

                                 
                   $file_handle = fopen($target_file, "rb");
				 
				 
				 
				   
						while (!feof($file_handle) )
							
         { 
	                  
	 
	                    $line_of_text = fgets($file_handle,20);
                        $parts = explode('=', $line_of_text);
	 
	                    
						
						  if (preg_match("#^7[39]([0-9]){6}$#", $parts[0]) AND strpos($parts[1], 'RO') !== false )
		 {
				
                            $check_existance = $bdd->prepare(' SELECT ID FROM ipmsan_tout WHERE NUM = ? ');
                $check_existance->execute(array($parts[0] ));
	            $num_exist =$check_existance->rowCount() ;

	                          
                 if($num_exist != 0 ) 

				 {

                   				
					
				 $local_search = $bdd->prepare('SELECT Adresse_IP FROM ipmsan_tout WHERE NUM = ? ');
                 $local_search->execute(array($parts[0]) );				 
			    
			   mysql_connect("localhost","root","faithinGOD4862") or die(mysql_error());
               mysql_select_db("test") or die(mysql_error());
                   
				    $adr = mysql_query("SELECT Adresse_IP FROM ipmsan_tout WHERE NUM ='$parts[0]' ") or die(mysql_error());
                    $adr_search = mysql_fetch_array($adr) or die(mysql_error());
					$string_adresse=$adr_search['Adresse_IP'] ;
       
				 $loc = mysql_query("SELECT Local FROM ipmsan_tout WHERE Adresse_IP='$string_adresse' ORDER BY Local DESC LIMIT 1") or die(mysql_error());
                 $row_loc = mysql_fetch_array($loc) or die(mysql_error());
				 		
	             $req1 = $bdd->prepare('UPDATE ipmsan_tout SET OP = :op_nv,Local= :local_nv,Ref=\'\' ,Aff=\'\',Type=\'\',Service_Supl=\'Null\',Restrictions=\'Neant\',Observations=\'\',Date = CURDATE(),Date_Rest=0000-00-00,Nature=\'\' WHERE NUM = :num_nv');
				 $req1->execute(array(
	                                 'op_nv' => $parts[1],
									 'local_nv' => $row_loc['Local']+1,
	                                 'num_nv' => $parts[0]));
									 
									 
	                                
				 
						 
						 
						   ?> 
									 <p>Vous avez fait une résiliation d'office pour le <strong class="s1">numéro : </strong><?php echo $parts[0] ; ?></p>
	                      <?php
				
				   $req1->closeCursor();
				   $check_existance->closeCursor();
					mysql_close () ;	
					
					$string_adresse='' ;
									
					
		 }
              else 
			  {
				   ?> 
									 <p>Le Numero<strong class="s1"> n'existe pas</strong> dans la base de donnée .</p>
	                      <?php
			  }				  
		 }
		 
		 elseif  (preg_match("#^7[39]([0-9]){6}$#", $parts[0]) AND strpos($parts[1], 'RO') == false )
			 { 	  
			            
						
				$check_existance = $bdd->prepare(' SELECT ID FROM ipmsan_tout WHERE NUM = ? ');
                $check_existance->execute(array($parts[0] ));
	            $num_exist =$check_existance->rowCount() ;

	                          
                 if($num_exist != 0 ) 

				 
				 {
			 
			 
			 
			 
			        mysql_connect("localhost","root","faithinGOD4862") or die(mysql_error());
                    mysql_select_db("test") or die(mysql_error());
				
				

				      $adr = mysql_query("SELECT Adresse_IP FROM ipmsan_tout WHERE NUM ='$parts[0]' ") or die(mysql_error());
                    $adr_search = mysql_fetch_array($adr) or die(mysql_error());
					$string_adresse=$adr_search['Adresse_IP'] ;
       
				    $loc = mysql_query("SELECT Local FROM ipmsan_tout WHERE Adresse_IP='$string_adresse' ORDER BY Local DESC LIMIT 1") or die(mysql_error());
                    $row_loc = mysql_fetch_array($loc) or die(mysql_error());
				   
				 $req1 = $bdd->prepare('UPDATE ipmsan_tout SET Restrictions = :rest_nv , Local= :local_nv,Date_Rest = CURDATE()  WHERE NUM = :num_nv');
                     
                          
					           
                        
                                     $req1->execute(array(
	                                 'rest_nv' => $parts[1],
									 'local_nv'=>$row_loc['Local']+1,
	
	                                 'num_nv' => $parts[0]));
	                                 $req1->closeCursor();
									 mysql_close () ;
	

                                     $req2 = $bdd->prepare('SELECT NUM, Date_Rest,Restrictions,ID,Local FROM ipmsan_tout WHERE NUM = ? ');
                                     $req2->execute(array($parts[0]) );

                                     while ($donnees = $req2->fetch())
                                     {
                                       ?>

                                            <p>
	                                        <strong class="s1"> ID </strong>: <?php echo $donnees['ID'] ?> 
											<strong class="s1"> - Local </strong>: <?php echo $donnees['Local'] ?>
                                            <strong class="s1"> - numéro </strong>: <?php echo $donnees['NUM'] ?> 
											<strong class="s1"> - Restriction </strong>: <?php echo $donnees['Restrictions'] ?> 

	                                          <strong class="s1"> - date</strong>: <?php echo $donnees['Date_Rest'] ?> 
	 
                                             </p>
	
                                      <?php
                                     } 
                                      $req2->closeCursor(); 
									  
                                
			 }
			 else 
			 {
				?> 
									 <p>Le Numero<strong class="no"> n'existe pas</strong> dans la base de donnée .</p>
	                      <?php 
			 }
								
				 
			 }
			
		 else 
		 {
			                   ?>
							   <p>Le Numero ou l'opération <strong class="no">n'est pas valide .<strong> Recommencez  .</p>
							   <?php
		 }
		 
				
			}

    
			
			
		 }
			fclose($file_handle) ;
			
			
			
			
	  }
				
			        

	
	               

	



	


         ?>

   
	
	
	                    <p>
						Si vous souhaitez visiter <strong class="s1">la page de modification</strong> <a href="acceuil_script_msan.php">Cliquez ici</a><br />
                        </p>
</body>
</html>
	   