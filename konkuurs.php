<?php
require_once ('conf.php');
global $yhendus;

if(isset($_REQUEST['punkt'])){
    $kask=$yhendus->prepare("UPDATE konkurss SET punktid=punktid+1 WHERE id=?");
    $kask->bind_param("i",  $_REQUEST['punkt']);

    header("Location: $_SERVER[PHP_SELF]");
}

if(isset($_REQUEST['uus_komment'])){
    $kask=$yhendus->prepare("UPDATE konkurss SET kommentar=CONCAT(kommentar, ?) WHERE id=?");
    $kommentlisa=$_REQUEST['komment'] ;
    $kask->bind_param("si", $kommentlisa, $_REQUEST['uus_komment']);
    $kask->execute();
   header("Location: $_SERVER[PHP_SELF]");
}
?>

<!Doctype html>
<html lang="et">
<head>
    <title>Foto konkurss</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
<br>
<nav>
    <a href="haldus.php">Administreerimise leht</a>
    <a href="konkuurs.php">klient leht</a>
</nav>
<br>
<h1>Fotokonkurrs "Loomad"</h1>
<?php
// tabeli konkurss sisu näitamine
$kask=$yhendus->prepare("SELECT id, nimi, pilt, kommentar, lisamisaeg, punktid FROM konkurss WHERE avalik=1");
$kask->bind_result($id, $nimi, $pilt, $kommentar, $aeg, $punktid);
$kask->execute();
echo "<table><tr><td>Nimi<th>Pilt</th><th>Lisamiseaeg</th><th>Punktid</th><th>Kommentaar</th></td></tr>";

while($kask->fetch()){
    echo "<tr><td>$nimi</td>";
    echo "<td><img src='$pilt' alt='pilt' </td>";
    echo "<td>$aeg</td>";
    echo "<td>$punktid</td>";
    echo "<td><a href='?punkt=$id'>+1punkt</a></td>";
    echo "<td> $kommentar </td>";
    echo "<td>
    <form action='?'>
    <input type='hidden' name='uus_komment' value='$id'>
    <input type='text' name='koment'>
    <input type='submit' value='OK'>
</form></td>";

    echo "</tr>";
}
echo "<table>";
?>

</body>
</html>
