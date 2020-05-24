<?php
include "connexpdo.php";
$conn = connexpdo('pgsql:dbname=statistique;host=localhost;port=5432','postgres','new_password');
$querryNotesE1 = "SELECT valeur FROM statistique  WHERE action = 'Als' ";
$querryNotesE2 = "SELECT valeur FROM statistique  WHERE action = 'For' ";
$RepE1 = $conn->query($querryNotesE1);
$RepE1->execute();
$resultAls = $RepE1->fetchAll();
$RepE2 = $conn->query($querryNotesE2);
$RepE2->execute();
$resultFor = $RepE2->fetchAll();

header ("Content-type: image/png");
$image = imagecreate(470,400);

$orange = imagecolorallocate($image, 125, 125, 125);
$bleu = imagecolorallocate($image, 0, 0, 255);
$bleuclair = imagecolorallocate($image, 156, 227, 254);
$noir = imagecolorallocate($image, 0, 0, 0);
$blanc = imagecolorallocate($image, 255, 255, 255);
$rouge = imagecolorallocate($image,255,0,0);
$vert = imagecolorallocate($image,0,255,0);

imagestring($image, 4, 30, 380, "For" , $rouge);
imagestring($image, 4, 90, 380, "Als" , $blanc);
imagestring($image, 4, 30, 20, "Cours des actions als et for en 2010" , $vert);
$precedentX = 0;
$precedentY = 400-($resultAls[0]['valeur']*4.5);
$multiplicateur1 = 40;
$i = 1;

foreach ($resultAls as $action){
    $y = $action['valeur'];
    if($y > 10 ){
        $y = 400-(4.5*$y);//fois 10 pour faire en sort que plus lisible
    }
    if($i != 1){
        imageline($image,$precedentX,$precedentY,$i*$multiplicateur1,$y,$blanc);
        $precedentX = $i*$multiplicateur1;
        $precedentY = $y;
    }else{
        $precedentY = $y;
    }

    $i++;
}
$i = 1;
$precedentX = 0;
$precedentY = 400 - ($resultFor[0]['valeur']*4.5);

foreach ($resultFor as $action){
    $y = $action['valeur'];
    if($y > 10 ){
        $y = 400-(4.5*$y);//fois 10 pour faire en sort que plus lisible
    }
    if($i != 1){
        imageline($image,$precedentX,$precedentY,$i*$multiplicateur1,$y,$rouge);
        $precedentX = $i*$multiplicateur1;
        $precedentY = $y;
    }else{
        $precedentY = $y;
    }


    $i++;
}
imagepng($image);

?>
