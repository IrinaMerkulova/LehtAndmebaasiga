<?php
require_once ('conf.php');
global $yhendus;

//lisamine tabelisse
if(isSet($_REQUEST["lisamisvorm"])) {
    $kask = $yhendus->prepare("
INSERT INTO inimene(nimi, synnipaev, pilt) VALUES (?, ?, ?)");
    $kask->bind_param("sss", $_REQUEST["eesnimi"], $_REQUEST["synnipaev"], $_REQUEST["pilt"]);
// $_REQUEST["eesnimi"] - обращение к текстовому ящику в форме
    ///sdi, s-string, d-double, i -integer
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");
}
// kustutamine tabelist

if(isset($_REQUEST["kustuta"])){
    $kask=$yhendus->prepare("DELETE FROM inimene WHERE id=?");
    $kask->bind_param("i", $_REQUEST["kustuta"]);
    $kask->execute();
}

// tabeli sisu näitamine
$kask=$yhendus->prepare("SELECT id, nimi, synnipaev, pilt FROM inimene");
$kask->bind_result($id, $nimi, $synnipaev, $pilt);
$kask->execute();


?>
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Inimeste andmed tabelist</title>
</head>
<body>
<h1>Inimeste andmed AB tabelist</h1>
<table>
    <tr>
        <th>id</th>
        <th>Nimi</th>
        <th>Sünnipäev</th>
        <th>Pilt</th>
        <th>Tegevus</th>
    </tr>

    <?php
    while($kask->fetch()){

        echo "<tr>";
        echo "<td>". htmlspecialchars($id)."</td>";
        echo "<td>". htmlspecialchars($nimi)."</td>";
        echo "<td>". htmlspecialchars($synnipaev)."</td>";
        echo "<td><img src='$pilt' alt='ilus pilt' width='50%'></td>";
        echo "<td><a href='?kustuta=$id'>Kustuta</a></td>";
        echo "</tr>";

    }
    ?>
 </table>
<h2>Uue inimeste lisamine</h2>
<form action="?">
    <input type="hidden" name="lisamisvorm">
   Nimi: <input type="text" name="eesnimi">
    <br>
    Sünnipäev:<input type="date" name="synnipaev">
    <br>
    Pildi link: <textarea name="pilt">
        Kopeeri siia pildilink
    </textarea>
    <input type="submit" value="Lisa">

</form>
</body>
<?php
$yhendus->close();

//lisa tabelisse veerg silmadeVarv ja täida värvidega inglise keeles
//veebilehel kõik Nimed(tekst) värvida silmadeVärviga

?>
</html>




