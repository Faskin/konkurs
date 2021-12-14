<?php
$servernimi="d82493.mysql.zonevs.eu";
$kasutajanimi="d82493sa311982";
$parool="Alexzx200231";
$andmebaas="d82493sd350581";
$yhendus=new mysqli($servernimi, $kasutajanimi, $parool, $andmebaas);
$yhendus->set_charset("utf8");

/*CREATE TABLE konkurss(
id int PRIMARY KEY AUTO_INCREMENT,
nimi varchar(50),
pilt text,
lisamisaeg datetime,
punktid int DEFAULT 0,
kommentar text,
avalik int DEFAULT 1) */




