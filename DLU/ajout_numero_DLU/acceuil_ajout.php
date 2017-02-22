<?php   session_start();  ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="styling.css" />
        <title>Ajout DLU</title>
    </head>
 <body>
  <h1 >Page d'ajout d'un abonné dans DLU ERRIADH</h1>
  
    <?php
      if(!isset($_SESSION['use']))
{		  // If session is not set redirect to Login Page                            {
           header("Location:Login.php");  
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
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy(); 
     header("Location:Login.php");	
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
		   
		   
?>
  
  
  
  
  <form action="ajout_abonne.php" method ="post"> 

<p>
<label class="no">Numéro de l'abonné</label> <input class="s1" type="text" name="NUM" /> <br /><br /><br />

<label class="no">Nature</label>
<select class="s1" name="choix_nature">
 <option value="Norm">Norm</option>

    <option value="Pbx Norm">Pbx Norm</option>
	  <option value="Taxiph">Taxiph</option>
	 
	   <option value="Rnis">Rnis</option>
		<option value="Pbx Rnis">Pbx Rnis</option>
			<option value="Pra">Pra</option>
				<option value="Bra">Bra</option>
                                  
					  
                       </select>  <br /><br /> <br /> <br />
					   
<label class="no">DLU</label>
<select class="s1" name="choix_dlu">
 <option value="10">10</option>
  <option value="20">20</option>

   <option value="30">30</option>

    <option value="40">40</option>

	 <option value="50">50</option>

	  <option value="60">60</option>

  <option value="70">70</option>
   <option value="80">80</option>
   
       </select>  <br /><br /> <br /> <br />
 
<label class="no">OP</label>						  
<select class="s1" name="choix_op">
    
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
														
  <label class="no">Type</label>
<select class="s1" name="choix_type">
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
<select class="s1" name="choix_service">
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
					
					
 <label class="no">Aff</label>                                      
  
<select class="s1" name="choix_aff">
    <option value="A0">A0</option>
      <option value="A60">A60</option>
        <option value="RO">RO</option>
         <option value="R60">R60</option>
           <option value="D">D</option>
             <option value="B">B</option>
               <option value="L">L</option>
</select>  <br /><br /> <br /> <br />

<label class="no">Restriction</label>
<select class="s1" name="choix_rest">
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

<label class="no">Reference</label> <input class="s1" type="text" name="Ref" /> <br /><br /><br />
<input class="no" type="submit" name="valider" value="Ajouter" /><br />
</p>

</form>


</body>
</html>