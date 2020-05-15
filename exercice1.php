<?php
include "connexpdo.php";

$conn = connexpdo('pgsql:dbname=graphnotes;host=localhost;port=5432','postgres','new_password');

$queryCountE1 = "SELECT count (*) FROM notes WHERE etudiant = 'E1'";
$queryCountE2 = "SELECT count (*) FROM notes WHERE etudiant = 'E2'";
$RepE1 = $conn->query($queryCountE1);
$RepE1->execute();
$result1 = $RepE1->fetch();
$RepE2 = $conn->query($queryCountE2);
$RepE2->execute();
$result2 = $RepE2->fetch();
$querryNotesE1 = "SELECT note FROM notes  WHERE etudiant = 'E1' ";
$querryNotesE2 = "SELECT note FROM notes  WHERE etudiant = 'E2' ";
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
$image = imagecreate(800,300);

$orange = imagecolorallocate($image, 125, 125, 125);
$bleu = imagecolorallocate($image, 0, 0, 255);
$bleuclair = imagecolorallocate($image, 156, 227, 254);
$noir = imagecolorallocate($image, 0, 0, 0);
$blanc = imagecolorallocate($image, 255, 255, 255);

imagestring($image, 4, 300, 5, "Notes des etudiants E1 et E2", $noir);
imagestring($image, 4, 550, 260, "Moyenne des notes de E1 : ".$moyenneEtd1/$result1['count'] , $noir);
imagestring($image, 4, 550, 280, "Moyenne des notes de E2 : ".$moyenneEtd2/$result2['count'] , $noir);
$precedentX = 0;
$precedentY = 150;
$precedentY = $resultNotes1[0]['note'];
if($precedentY == 10){
    $precedentY = 150;
}
if($precedentY > 10 ){
    $precedentY = 150 -($precedentY - 10)*10;//fois 10 pour faire en sort que plus lisible
}
if($precedentY<10){
    $precedentY = 150 +  (10 - $precedentY)*10;
}
$multiplicateur1 = 800/$result1['count'];
$i = 1;
foreach ($resultNotes1 as $note){
    $y = $note['note'];
    if($y == 10){
        $y = 0;
    }
    if($y > 10 ){
        $y = ($y - 10)*10;//fois 10 pour faire en sort que plus lisible
    }
    if($y<10){
        $y = (10 - $y)*10;
    }
    imageline($image,$precedentX,$precedentY,$i*$multiplicateur1,150-$y,$noir);
    $precedentX = $i*$multiplicateur1;
    $precedentY = 150-$y;
    $i++;
}
$i = 1;
$precedentX = 0;
$precedentY = $resultNotes2[0]['note'];
if($precedentY == 10){
    $precedentY = 150;
}
if($precedentY > 10 ){
    $precedentY = 150 -($precedentY - 10)*10;//fois 10 pour faire en sort que plus lisible
}
if($precedentY<10){
    $precedentY = 150 +  (10 - $precedentY)*10;
}

foreach ($resultNotes2 as $note){
    $y = $note['note'];
    if($y == 10){
        $y = 0;
    }
    if($y > 10 ){
        $y = ($y - 10)*10;//fois 10 pour faire en sort que plus lisible
    }
    if($y<10){
        $y = -(10 - $y)*10;
    }
    imageline($image,$precedentX,$precedentY,$i*$multiplicateur1,150-$y,$bleu);
    $precedentX = $i*$multiplicateur1;
    $precedentY = 150-$y;
    $i++;
}
imagepng($image);




?>
