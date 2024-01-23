<?php
$serverinimi = "d125319.mysql.zonevs.eu";
$kasutajanimi = "d125319_kaka";
$parool = "killikene260899";
$andmebaas = "d125319_kaka";
$yhendus = new mysqli($serverinimi, $kasutajanimi, $parool, $andmebaas);
$yhendus->set_charset("UTF8");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"]) && isset($_POST["tantsija_hinne1"]) && isset($_POST["tantsija_hinne2"]) && isset($_POST["tantsija_hinne3"])) {
    $kask = $yhendus->prepare("UPDATE `Tantsupaarid` SET `Hinne1`=?, `Hinne2`=?, `Hinne3`=? WHERE `TantsijaID`=?");
    $kask->bind_param("iiii", $_POST["tantsija_hinne1"], $_POST["tantsija_hinne2"], $_POST["tantsija_hinne3"], $_POST["id"]);
    $kask->execute();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["eesnimi"]) && isset($_POST["perekonnanimi"])) {
    $kask = $yhendus->prepare("INSERT INTO `Tantsupaarid` (`Tantsija_eesnimi`, `Tantsija_perekonnanimi`, `Hinne1`, `Hinne2`, `Hinne3`) VALUES (?, ?, 0, 0, 0)");
    $kask->bind_param("ss", $_POST["eesnimi"], $_POST["perekonnanimi"]);
    $kask->execute();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_id"])) {
    $delete_kask = $yhendus->prepare("DELETE FROM `Tantsupaarid` WHERE `TantsijaID`=?");
    $delete_kask->bind_param("i", $_POST["delete_id"]);
    $delete_kask->execute();
}

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

<h2>Tantsijad</h2>
<table>
    <?php
    while ($kask->fetch()) {
        echo "
        <tr>
            <td>$eesnimi</td>
            <td>$perekonnanimi</td>
            <td>
                <form action='' method='post'>
                    <input type='hidden' name='id' value='$id' />
                    <label for='tantsija_hinne1'>Rating 1:</label>
                    <select name='tantsija_hinne1'>
                        <option value='1' " . ($hinne1 == 1 ? 'selected' : '') . ">1</option>
                        <option value='2' " . ($hinne1 == 2 ? 'selected' : '') . ">2</option>
                        <option value='3' " . ($hinne1 == 3 ? 'selected' : '') . ">3</option>
                        <option value='4' " . ($hinne1 == 4 ? 'selected' : '') . ">4</option>
                        <option value='5' " . ($hinne1 == 5 ? 'selected' : '') . ">5</option>
                    </select>
                    <label for='tantsija_hinne2'>Rating 2:</label>
                    <select name='tantsija_hinne2'>
                        <option value='1' " . ($hinne2 == 1 ? 'selected' : '') . ">1</option>
                        <option value='2' " . ($hinne2 == 2 ? 'selected' : '') . ">2</option>
                        <option value='3' " . ($hinne2 == 3 ? 'selected' : '') . ">3</option>
                        <option value='4' " . ($hinne2 == 4 ? 'selected' : '') . ">4</option>
                        <option value='5' " . ($hinne2 == 5 ? 'selected' : '') . ">5</option>
                    </select>
                    <label for='tantsija_hinne3'>Rating 3:</label>
                    <select name='tantsija_hinne3'>
                        <option value='1' " . ($hinne3 == 1 ? 'selected' : '') . ">1</option>
                        <option value='2' " . ($hinne3 == 2 ? 'selected' : '') . ">2</option>
                        <option value='3' " . ($hinne3 == 3 ? 'selected' : '') . ">3</option>
                        <option value='4' " . ($hinne3 == 4 ? 'selected' : '') . ">4</option>
                        <option value='5' " . ($hinne3 == 5 ? 'selected' : '') . ">5</option>
                    </select>
                    <input type='submit' value='Save Rating' />
                </form>
            </td>
            <td>
                <form action='' method='post'>
                    <input type='hidden' name='delete_id' value='$id' />
                    <input type='submit' value='Delete' onclick='return confirm(\"Oled kindel et tahad kustutada selle tantsija?\")' />
                </form>
            </td>
        </tr>
        ";
    }
    ?>
</table>

<h2>Lisa uus tantsupaar</h2>
<form action='' method='post'>
    <label for='eesnimi'>Eesnimi:</label>
    <input type='text' name='eesnimi' required />

    <label for='perekonnanimi'>Perekonnanimi:</label>
    <input type='text' name='perekonnanimi' required />

    <input type='submit' value='Lisa Tantsupaare' />
</form>

</body>
</html>
