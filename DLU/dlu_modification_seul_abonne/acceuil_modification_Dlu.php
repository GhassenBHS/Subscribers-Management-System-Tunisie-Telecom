<?php   session_start();

		   ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="styling.css" />
        <title>Modification DLU</title>
    </head>

    <body>
	 <h1>Modification d'un Abonné dans DLU ERRIADH </h1>
	   <?php
      if(!isset($_SESSION['use'])) // If session is not set redirect to Login Page                            {
           header("Location:Login.php");  
		   {?>

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
	 
	 
	 
     <p>Bonjour et bienvenue !
            Cette page vous permet de modifier l'état d'un abonné dans la base de donnée . <br />
			Pour cela il faut spécifier chacune des <strong><em>critères</strong> ci dessous  :
    </p>
	


<form action="traitement_modification_Dlu.php" method ="post"> 

<p>
<label class="no">Numéro de l'abonné</label><input class="s1" type="text" name="NUM" />  <br /><br /><br /> 
<label class="no">Observations</label><input class="s1" type="text" name="Obs" />  <br /><br /><br />



<label class="no">Nature</label>
<select class="s1" name="choix1">
 <option value="Mauv">Mauv</option>
  <option value="Port Tenue">Tenue</option>
   <option value="Norm">Norm</option>
    <option value="Pbx Norm">Pbx Norm</option>
	  <option value="Taxiph">Taxiph</option>
	   <option value="Rnis">Rnis</option>
		<option value="Pbx Rnis">Pbx Rnis</option>
			<option value="Pra">Pra</option>
				<option value="Bra">Bra</option>
                                  <option value="Pots">Pots</option>
                                     <option value="Combo">Combo</option>
                                        <option value="Mixte">Mixte</option>
					  <option value="Reserve">Reserve</option>
                       </select>  <br /><br /> <br /> <br />
					   
		<label class="no">Data</label>			   
       <select class="s1" name="choix2">
     <option value="Non">Non</option>
      <option value="Adsl">Adsl</option>
       <option value="Sdsl">Sdsl</option>
         <option value="Vdsl">Vdsl</option>
          <option value="Backup">Backup</option>
            <option value="Ls">Ls</option>
             <option value="Hotline">Hotline</option>
                          </select>  <br /><br /> <br /> <br />
						  
<label class="no">OP</label>						  
<select class="s1" name="choix3">
    
      <option value="CR">CR</option>
	  <option value="AB">AB</option>
       <option value="RA">RA</option>
         <option value="DN">DN</option>
	       <option value="IProv">IProv</option>
		     <option value="DME">DME</option>
		      <option value="Perm">Perm</option>
			    <option value="Basc">Basc</option>
				  <option value="TRL">TRL</option>
				   <option value="TRE">TRE</option>
				     <option value="TRS">TRS</option>
					   <option value="RO">RO</option>
					     <option value="Rd">Rd</option>
					      <option value="Rt">Rt</option>
					       <option value="Ren">Ren</option>
					        <option value="R.DN">R.DN</option>
							  <option value="R.lProv">R.lProv</option>
							    <option value="R.Perm">R.Perm</option>
								  <option value="R.Basc">R.Basc</option>
								    <option value="Mig">Mig</option>
									  <option value="SSup">SSup</option>
									    <option value="R.SSup">R.SSup</option>
										  <option value="Forfait">Forfait</option>
										    <option value="R.forfait">R.forfait</option>
											  <option value="Cession">Cession</option>
                                                <option value="CH.Int">CH.Int</option>
											    <option value="Groupage">Groupage</option>
											      <option value="Degroupage">Degroupage</option>
											       <option value="Susp.Prov">Susp.Prov</option>
											         <option value="R.Susp.Prov">R.Susp.Prov</option>
													   
													    </select>  <br /><br /> <br /> <br />
  
  
  
 <label class="no">Aff</label>                                      
  
<select class="s1" name="choix4">
    <option value="A0">A0</option>
      <option value="A60">A60</option>
        <option value="RO">RO</option>
         <option value="R60">R60</option>
           <option value="D">D</option>
             <option value="B">B</option>
               <option value="L">L</option>
</select>  <br /><br /> <br /> <br />

<label class="no">Type</label>
<select class="s1" name="choix5">
    <option value="Pp">Pp</option>
    <option value="N.vert">N.vert</option>
    <option value="iLL.Free">iLL.Free</option>
    <option value="M.Lib">M.Lib</option>
	<option value="M.Pp">M.Pp</option>
	<option value="Ff.Pp">Ff.Pp</option>
	<option value="C.Lib">C.Lib</option>
	<option value="F.Pp">F.Pp</option>
	<option value="Fixi">Fixi</option>
	<option value="Pp.C">Pp.C</option>
	<option value="C.Pp">C.Pp</option>
	<option value="Forf">Forf</option>
	<option value="iLLimifix">iLLimifix</option>
	<option value="Pub.Pp">Pub.Pp</option>
	<option value="Prp">Prp</option>
	<option value="iLL.Fix">iLL.Fix</option>
	<option value="M.Prp">M.Prp</option>
	<option value="C.sec">C.sec</option>
	<option value="C.sec+">C.sec+</option>
	<option value="Ff.Prp">Ff.Prp</option>
	<option value="S.Pro">S.Pro</option>
	<option value="F.Prp">F.Prp</option>
		<option value="Forf.PL">Forf.PL</option>
			<option value="Pub.Pp">Lib.Pro</option>
				<option value="Pub.Prp">Pub.Prp</option>
					
	
	
</select>  <br /><br /> <br /> <br />

<label class="no">Services</label>
<select class="s1" name="choix6">
    <option value="Null">Null</option>
    <option value="Clip">Clip</option>
	    <option value="Cw">Cw</option>
		    <option value="Clip+Cw">Clip+Cw</option>
			    <option value="Clip+Cw+Cfu">Clip+Cw+Cfu</option>
				    <option value="Cfu">Cfu</option>
					    <option value="Cfu/Occup">Cfu/Occup</option>
						    <option value="Cfu/Non Rep">Cfu/Non Rep</option>
							<option value="Cfu/Autres">Cfu/Autres</option>
							
							
   
</select>  <br /><br /> <br /> <br />

<label class="no">Restriction</label>
<select class="s1" name="choix7">
    <option value="Neant">Neant</option>
	    <option value="Ras">Ras</option>
		    <option value="Rae">Rae</option>
			    <option value="Prov">Prov</option>
				    <option value="Actel">Actel</option>
					    <option value="Zone">Zone</option>
						    <option value="Admin">Admin</option>
							    <option value="Admin1">Admin1</option>
								    <option value="Admin2">Admin2</option>
									    <option value="Admin2">Admin3</option>
				                           <option value="Ret">Ret</option>
										  	 <option value="Divers">Divers</option>
										
    
</select>  <br /><br /> <br /> <br />


 <input class="s1" type="submit" name="valider" /><br />

 



</p>

</form>


</body>
</html>

