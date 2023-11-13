<?php
require ('conf.php');
//andme kusatamine tabelist
global $yhendus;
if (isset($_REQUEST["kustuta"])){
    $paring=$yhendus->prepare("DELETE FROM syndmused where id=?");
    $paring->bind_param("i", $_REQUEST["kustuta"]);
    $paring->execute();
}
//lisamine db
if (isset($_REQUEST["synd"]) && !empty($_REQUEST["synd"]) && !empty($_REQUEST["date"])){
    $paring=$yhendus->prepare("INSERT INTO syndmused(syndimus, kuupaev, kirjeldus, pilt) values(?, ?, ?, ?)");
    $paring->bind_param("ssss", $_REQUEST["synd"], $_REQUEST["date"], $_REQUEST["kirje"], $_REQUEST["pildiaadress"]);
    $paring->execute();
    header("Location: $_SERVER[PHP_SELF]");

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sündmused SQL tabelist</title>
</head>
<body>
<h1>Sündmused DB</h1>
<?php
//kuiuvab andmed sql andme tabelist
global $yhendus;
$paring = $yhendus->prepare("SELECT id, syndimus, kuupaev, kirjeldus, pilt FROM syndmused");
$paring->bind_result($id, $syndimus, $kuupaev, $kirjeldus, $pilt);
$paring->execute();
while($paring->fetch()){
    echo "<ul>";
    echo "<li>";
    echo "<span style='background-color: $kirjeldus'>";
    echo $id.", ".$syndimus.", ".$kuupaev.", ".$kirjeldus.", "."</span>";
    echo "<img src='$pilt' alt='pilt' width='5%'>";
    echo "<a href='?kustuta=$id'>Kustuta</a>";
    echo "</li></ul>";
}
$yhendus->close();
?>
<form action="" method="">
    <label for="synd"></label>
    <input type="text" name="synd" id="synd">
    <label for="date"></label>
    <input type="date" name="date" id="date">
    <label for="kirje"></label>
    <input type="text" name="kirje" id="kirje">
    <br>
    <label for="pilt"></label>
    <textarea name="pildiaadress" id="pilt"></textarea>
    <input type="submit" value="lisa">
</form>
</body>
</html>