 <?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['vpmsaid']==0)) {
  header('location:logout.php');
  } else{


?>          
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">           
<?php
 $cid=$_GET['IDENVOI'];
$ret=mysqli_query($con,"SELECT * from envoicolis WHERE IDENVOI='$cid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
  ?>

<div  id="exampl">

      <table border="1" class="table table-bordered mg-b-0">
        <tr>
          <th colspan="4" style="text-align: center; font-size:22px;"> Fiche Informations - Borderau Envoi</th>

        </tr>
   
   <tr>
                                <th>Numéro ID Envoi</th>
                                   <td><?php  echo $row['IDENVOI'];?></td>
                                              

                                <th>Agence de Départ</th>
                                   <td><?php  echo $row['CODEAGENCE'];?></td>
                                   </tr>
                                   <tr>
                                <th>Situation du Colis</th>
                                   <td><?php  echo $packprice= $row['CODEETATCOLIS'];?></td>
                             
                                <th>Agence Arrivée</th>
                                   <td><?php  echo $row['AGE_CODEAGENCE'];?></td>
                                   </tr>
                                   <tr>
                                    <th>ID du Client</th>
                                      <td><?php  echo $row['IDCLIENT'];?></td>
                                  
                                       <th>Date de L'Envoi</th>
                                        <td><?php  echo $row['DATEENVOI'];?></td>
										
											
                                    </tr>
                                    <tr>
											<th>Heure de L'Envoi</th>
											<td><?php  echo $row['HEUREENVOI'];?></td>
								
											<th>Forme du Colis</th>
											<td><?php  echo $row['FORMECOLISENVOI'];?></td>	

									</tr>
									<tr>
										<th>Prix Envoi du Colis</th>
											<td><?php  echo $row['PRIXENVOICOLIS'];?></td>
									</tr>
									
									<tr>
											<th>Nom du Destinataire</th>
											<td><?php  echo $row['NOMDESTINAIREENVOICOLIS'];?></td>
											
											<th>Contact Destinataire</th>
											<td><?php  echo $row['TELDESTINAIREENVOICOLIS'];?></td>

									</tr>
  <tr>
    <td colspan="4" style="text-align:center; cursor:pointer">Lancer Impression || <i class="fa fa-print fa-2x" aria-hidden="true" OnClick="CallPrint(this.value)"></i></td>
  </tr><hr>
	
</table><hr><a class="btn btn-warning" href="ListeEnvois.php">FERMER FENETRE - RETOUR</a>	
            <?php }}  ?>
          </div>
            <script>
function CallPrint(strid) {
var prtContent = document.getElementById("exampl");
var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
WinPrint.document.write(prtContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
</script> 