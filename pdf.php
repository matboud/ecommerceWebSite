<?php
error_reporting(0);
session_start();

if (!isset($_SESSION['user_in'])) {
    header("location: index.php");
}



// Connexion à la BDD
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mycady";

// Create connection
$db = mysqli_connect($servername, $username, $password, $dbname);






// Appel de la librairie FPDF
require("fpdf/fpdf.php");

// Création de la class PDF
class PDF extends FPDF {
    // Header
    function Header() {
        // Logo
        $this->Image('images/char_1.png',10,5,20);  //!!!!!!!!! logo in pdf fileNEED TO BE CHANGED
        // Saut de ligne
        $this->Ln(20);
    }
    // Footer
    function Footer() {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Adresse
        $this->Cell(196,5,'copyright MyCady - +212600000000',0,0,'C');
    }
}

// Activation de la classe
$pdf = new PDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Helvetica','',11);
$pdf->SetTextColor(0);

$req = "SELECT * FROM command, cart_shadow WHERE done = 0 AND cart_shadow.id_shadow = command.id_shadow AND id_user = $_SESSION[user_in]";
$rep = mysqli_query($db, $req);
$row = mysqli_fetch_array($rep);

// Infos de la commande calées à gauche
$pdf->Text(8,38,utf8_decode('N° de facture : ').$row['id_command']);
$pdf->Text(8,43,'Date : '.$row['date']);

$req1 = "SELECT * FROM user WHERE id_user = $row[id_user]";
$rep1 = mysqli_query($db, $req1);
$row1 = mysqli_fetch_array($rep1);

// Infos du client calées à droite
$pdf->Text(120,38,utf8_decode($row1['last_name']).' '.utf8_decode($row1['name_u']));
$pdf->Text(120,43,utf8_decode($row1['mail']));
$pdf->Text(120,48,$row1['phone']);







// Position de l'entête à 10mm des infos (48 + 10)
$position_entete = 58;

function entete_table($position_entete){
    global $pdf;
    $pdf->SetDrawColor(183); // Couleur du fond
    $pdf->SetFillColor(221); // Couleur des filets
    $pdf->SetTextColor(0); // Couleur du texte
    $pdf->SetY($position_entete);
    $pdf->SetX(8);
    $pdf->Cell(158,8,utf8_decode('Désignation'),1,0,'L',1);
    $pdf->SetX(166); // 8 + 96
    $pdf->Cell(10,8,utf8_decode('Qté'),1,0,'C',1);
    $pdf->SetX(176); // 104 + 10
    $pdf->Cell(24,8,'Net HT',1,0,'C',1);
    $pdf->Ln(); // Retour à la ligne
}
entete_table($position_entete);

// Liste des détails
$position_detail = 66; // Position à 8mm de l'entête

$req2 = "SELECT * FROM product, cart_shadow, command WHERE product.id_product = cart_shadow.id_product AND command.id_shadow = cart_shadow.id_shadow AND done = 0";
$rep2 = mysqli_query($db, $req2);
$total_price = 0;
while ($row2 = mysqli_fetch_array($rep2)) {
    $pdf->SetY($position_detail);
    $pdf->SetX(8);
    $pdf->MultiCell(158,8,utf8_decode($row2['nom_product']),1,'L');
    $pdf->SetY($position_detail);
    $pdf->SetX(166);
    $pdf->MultiCell(10,8,$row2['quantity'],1,'C');
    $pdf->SetY($position_detail);
    $pdf->SetX(176);
        if ($row2['prix_promo']!=0) {
            $price = $row2['prix_promo']*$row2['quantity'];
            $total_price += $price;
        }else{
            $price = $row2['prix_fix']*$row2['quantity'];   
            $total_price += $price;     
        }
    $pdf->MultiCell(24,8,'$'.$price,1,'R');
    $position_detail += 8;

    $done_sql = "UPDATE command SET done = 1 WHERE id_command = $row2[id_command]";
    mysqli_query($db, $done_sql);

    $pro_left = $row['product_left'];
    $pro_left2 = $pro_left-1;
    $pro_sell = $row['product_sell'];
    $pro_sell2 = $pro_sell+1;
    $done_pro = "UPDATE product SET product_left = $pro_left2, product_sell = $pro_sell2 WHERE id_product = $row2[id_product]";
    mysqli_query($db, $done_pro);
    
}

$position_detail += 10;
// Infos du client calées à droite
$pdf->Text(140,$position_detail,utf8_decode('Prix total:                        $'.$total_price));
$position_detail += 7;
// calculating fee: 
$fee = ($total_price*10)/100;
$final_price = $total_price+$fee;
$pdf->Text(140,$position_detail,utf8_decode('TOTAL +10%:                   $'.$final_price));


// Nom du fichier
$nom = 'Facture-'.$row['id_command'].'.pdf';

// Création du PDF
$pdf->Output($nom,'I');



?>