<?php
require ('conf.php');
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
global $yhendus;
$paring = $yhendus->prepare("SELECT id, syndimus, kuupaev, kirjeldus FROM syndmused");
$paring->bind_result($id, $syndimus, $kuupaev, $kirjeldus);
$paring->execute();
while($paring->fetch()){
    echo "<ul>";
    echo "<li>";
    echo "<span style='background-color: $kirjeldus'>";
    echo $id.", ".$syndimus.", ".$kuupaev.", ".$kirjeldus.", "."</span>";
    echo "</li></ul>";
}
$yhendus->close();
?>
</body>
</html>