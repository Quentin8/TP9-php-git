<?php
include "connexpdo.php";
$conn = connexpdo('pgsql:dbname=statistique;host=localhost;port=5432','postgres','new_password');
$queryCountE1 = "SELECT count (*) FROM statistique WHERE action = 'Als'";
$queryCountE2 = "SELECT count (*) FROM statistique WHERE action = 'For'";
$RepE1 = $conn->query($queryCountE1);
$RepE1->execute();
$result1 = $RepE1->fetch();
$RepE2 = $conn->query($queryCountE2);
$RepE2->execute();
$result2 = $RepE2->fetch();
$querryNotesE1 = "SELECT valeur FROM statistique  WHERE action = 'Als' ";
$querryNotesE2 = "SELECT valeur FROM statistique  WHERE action = 'For' ";
$RepE1 = $conn->query($querryNotesE1);
$RepE1->execute();
$resultNotes1 = $RepE1->fetchAll();
$RepE2 = $conn->query($querryNotesE2);
$RepE2->execute();
$resultNotes2 = $RepE2->fetchAll();
$moyenneEtd1 = 0;
foreach ($resultNotes1 as $note){
    $moyenneEtd1 += $note['note'];
}
$moyenneEtd2 = 0;
foreach ($resultNotes2 as $note){
    $moyenneEtd2 += $note['note'];
}
header ("Content-type: image/png");
$image = imagecreate(470,400);

$orange = imagecolorallocate($image, 125, 125, 125);
$bleu = imagecolorallocate($image, 0, 0, 255);
$bleuclair = imagecolorallocate($image, 156, 227, 254);
$noir = imagecolorallocate($image, 0, 0, 0);
$blanc = imagecolorallocate($image, 255, 255, 255);

imagestring($image, 4, 550, 260, "For" , $noir);
imagestring($image, 4, 550, 280, "Als" , $noir);
$precedentX = 0;
$precedentY = 200;
$precedentY = $resultNotes1[0]['valeur'];
if($precedentY > 10 ){
    $precedentY = 200 -($precedentY - 10)*3;
}
if($precedentY<10){
    $precedentY = 200 +  (10 - $precedentY)*3;
}
$multiplicateur1 = 40;
$i = 1;
foreach ($resultNotes1 as $note){
    $y = $note['valeur'];
    if($y == 10){
        $y = 0;
    }
    if($y > 10 ){
        $y = ($y - 10)*3;//fois 10 pour faire en sort que plus lisible
    }
    if($y<10){
        $y = (10 - $y)*3;
    }
    imageline($image,$precedentX,$precedentY,$i*$multiplicateur1,200-$y,$noir);
    $precedentX = $i*$multiplicateur1;
    $precedentY = 200-$y;
    $i++;
}
$i = 1;
$precedentX = 0;
$precedentY = $resultNotes2[0]['valeur'];

if($precedentY > 10 ){
    $precedentY = 200 -($precedentY - 10)*3;//fois 10 pour faire en sort que plus lisible
}
if($precedentY<10){
    $precedentY = 200 +  (10 - $precedentY)*3;
}

foreach ($resultNotes2 as $note){
    $y = $note['valeur'];
    if($y == 10){
        $y = 0;
    }
    if($y > 10 ){
        $y = ($y - 10)*3;//fois 10 pour faire en sort que plus lisible
    }
    if($y<10){
        $y = -(10 - $y)*3;
    }
    imageline($image,$precedentX,$precedentY,$i*$multiplicateur1,200-$y,$bleu);
    $precedentX = $i*$multiplicateur1;
    $precedentY = 200-$y;
    $i++;
}
imagepng($image);

?>
