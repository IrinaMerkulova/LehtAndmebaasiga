<?php
require_once ('conf.php');
global $yhendus;
//lisamine tabelisse
if(isSet($_REQUEST["lisamisvorm"])) {
    $kask = $yhendus->prepare("
INSERT INTO oppeained(aineNimetus, kirjeldus, loomisePaev) VALUES (?, ?, NOW())");
    $kask->bind_param("ss", $_REQUEST["nimetus"], $_REQUEST["kirjeldus"]);
// $_REQUEST["eesnimi"] - обращение к текстовому ящику в форме
    ///sdi, s-string, d-double, i -integer
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");
}



?>
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Õppeained tabelist</title>
    <style>
        #meny{
            float:left;
            padding-right: 30px;
            background-color: chartreuse;
        }
        #sisu{
            float:left;
            margin-left: 5%;
        }
    </style>
</head>
<body>
<h1>Õppeained tabelist</h1>
<div id="meny">
<ul>
    <?php
    $kask=$yhendus->prepare("SELECT id, aineNimetus FROM oppeained");
    $kask->bind_result($id, $nimetus);
    $kask->execute();

    while($kask->fetch()){
    echo "<li>";
    echo "<a href='?id=$id'>".$nimetus."</a>";
    //echo ", ".$kirjeldus.", ".$paev;
    echo "</li>";
    }

 ?>
</ul>
    <a href="?lisamine=jah">Lisas uus õppeaine</a>


</div>
<div id="sisu">
    <?php
    // andmebaasi tabeli sisu

    $kask=$yhendus->prepare("SELECT id, aineNimetus, kirjeldus, loomisePaev FROM oppeained WHERE id=?");
    $kask->bind_param("i", $_REQUEST["id"]);
    //?- küsimärgi asemel aadressiribalt tuleb id
    $kask->bind_result($id, $nimetus, $kirjeldus, $paev);
    $kask->execute();
    if($kask->fetch()){
        echo "<div>".htmlspecialchars($kirjeldus);
        echo "<br><strong>".htmlspecialchars($paev)."</strong></div>";
    }

if(isset($_REQUEST["lisamine"])){
    ?>
    <form action="?">
        <input type="hidden" name="lisamisvorm" value="jah">
        Ainenimetus: <input type="text" name="nimetus">
        <br>
        <br>
        Kirjelus: <textarea name="kirjeldus" cols="10"></textarea>
        <input type="submit" value="Lisa">

    </form>
    <?php
}
    ?>

</div>
</body>
</html>
