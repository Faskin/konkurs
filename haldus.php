<?php
require_once ('conf.php');
global $yhendus;

if(isset($_REQUEST['punkt'])){
    $kask=$yhendus->prepare("UPDATE konkurss SET punktid=0 WHERE id=?");
    $kask->bind_param("i", $_REQUEST['punkt']);
    $kask->execute();

    // header("Location: $_SERVER[PHP_SELF]");
}

//lisamine nimi konkurssi
if(!empty($_REQUEST['nimi'])){
$kask=$yhendus->prepare("INSERT INTO konkurss(nimi, pilt, lisamisaeg)
VALUES (?,?, NOW()");
$kask->bind_param("ss", $_REQUEST['nimi'], $_REQUEST['pilt']);
$kask->execute();
// header("Location: $_SERVER[PHP_SELF]");
}

// nimi näitamine avalik=1 UPDATE
if(isset($_REQUEST['avamine'])){
    $kask=$yhendus->prepare("UPDATE konkurss SET avalik=1 WHERE id=?");
    $kask->bind_param("i", $_REQUEST['avamine']);
    $kask->execute();

}

// nimi peitmine avalik=0 UPDATE
if(isset($_REQUEST['peitmine'])){
    $kask=$yhendus->prepare("UPDATE konkurss SET avalik=0 WHERE id=?");
    $kask->bind_param("i", $_REQUEST['peitmine']);
    $kask->execute();

}

// kustutamine
if(isset($_REQUEST['kustuta'])){
    $kask=$yhendus->prepare("DELETE FROM konkurss WHERE id=?");
    $kask->bind_param("i", $_REQUEST['kustuta']);
    $kask->execute();



}

?>

<!Doctype html>
<html lang="et">
<head>
    <title>Fotokonkurssi halduseleht</title>
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
$kask=$yhendus->prepare("SELECT id, nimi, pilt, lisamisaeg, punktid, avalik FROM konkurss");
$kask->bind_result($id, $nimi, $pilt,  $aeg, $punktid, $avalik);
$kask->execute();
echo "<table><tr><th>Nimi</th><th>Pilt</th><th>Lisamiseaeg</th><th>Punktid</th></tr>";

while($kask->fetch()){
    echo "<tr><td>$nimi</td>";
    echo "<td><img src='$pilt' alt='pilt' </td>";
    echo "<td>$aeg</td>";
    echo "<td><a href='?punkt=$id'>punktid nulliks</a></td>";
    echo "<td>$punktid</td>";
    echo "<td>$seisund</td>";
    echo "<td><a href='?kustuta'>Kustuta</a>";
    echo "</tr>";
    // Peida-näita
    $avatekst="Ava";
    $param="avamine";
    $seisund="Peidetud";
    if($avalik==1){
        $avatekst="Peida";
        $param="peitmine";
        $seisund="Avatud";

    }
    echo "<td><a href='?$param=$id'>$avatekst</a>";
}
echo "</table>";
?>
<h2>Uue pilti lisamine konkurssi</h2>

<form action="?">
    <input type="text" name="nimi" placeholder="uus nimi">
    <br>
    <textarea name="pilt">pildi linki aadress</textarea>
    <br>
    <input type="button" value="Lisa">
</form>
</body>
</html>
