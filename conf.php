<?php
$serverinimi="localhost"; // d70420.mysql.zonevs.eu
$kasutaja="imerkulova21"; // d70420_merk21
$parool="123456"; // ''
$andmebaas="imerkulova21"; //d70420_merk21

$yhendus=new mysqli($serverinimi, $kasutaja, $parool, $andmebaas);

$yhendus->set_charset('UTF8');
/*
 CREATE TABLE inimene(
    id int AUTO_INCREMENT PRIMARY key,
    nimi varchar(20) not null,
    synnipaev date);

Insert into inimene(nimi, synnipaev)
Values ('Test', '2000-12-10');

select * from inimene
ALTER TABLE inimene ADD pilt TEXT
*/

?>
