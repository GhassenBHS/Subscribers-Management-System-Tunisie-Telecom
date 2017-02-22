<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="styling.css" />
        <title>Script DLU</title>
    </head>
 <body>
  <h1 >Page de Suppression du contenu du dossier d'importation . </h1>

<?php
$dir = "C:\wamp\www\DLU\script_dlu\uploads";

// Open a directory, and read its contents
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
      
	  if($file!=in_array($file, array(".",".."))){
unlink("$dir/$file");
}
    }
    closedir($dh);
  }
}
?>
    <p>
           La <strong class="s1">suppression</strong> a été effectué avec sucée ! <br /></p> 
		   
		    <p>
						Si vous souhaitez visiter <strong class="s1">la page de modification</strong> <a href="acceuil_script_dlu.php">Cliquez ici</a><br />
                        </p>

</body>
</html>