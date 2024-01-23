<?php
$serverinimi = "d125319.mysql.zonevs.eu";
$kasutajanimi = "d125319_kaka";
$parool = "killikene260899";
$andmebaas = "d125319_kaka";
$yhendus = new mysqli($serverinimi, $kasutajanimi, $parool, $andmebaas);
$yhendus->set_charset("UTF8");

$kask = $yhendus->prepare("SELECT `TantsijaID`, `Tantsija_eesnimi`, `Tantsija_perekonnanimi`, `Hinne1`, `Hinne2`, `Hinne3` FROM `Tantsupaarid`");
$kask->bind_result($id, $eesnimi, $perekonnanimi, $hinne1, $hinne2, $hinne3);
$kask->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Teooriaeksam</title>
</head>
<body>

<header>
    <h1>Tants</h1>
</header>

<?php include("navigation.php") ?>

<h2>Tantsijad ja nende hinded</h2>
<table>
    <?php
    while ($kask->fetch()) {
        echo "
        <tr>
            <td>$eesnimi</td>
            <td>$perekonnanimi</td>
            <td>$hinne1</td>
            <td>$hinne2</td>
            <td>$hinne3</td>
        </tr>
        ";
    }
    ?>
</table>

</body>
</html>
