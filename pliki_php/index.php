<?php
$katalog = "dokumenty";
$sciezka = __DIR__ . "/" . $katalog;

if (isset($_POST["utworz"])) {
    $nazwa = basename($_POST["nazwa"]);
    $tresc = $_POST["tresc"];

    if ($nazwa != "" && !file_exists($sciezka . "/" . $nazwa)) {
        file_put_contents($sciezka . "/" . $nazwa, $tresc);
    }
}

$pliki = scandir($sciezka);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Moje pliki</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>MOJE PLIKI</h1>

        <p>Aktualny katalog:</p>
        <p><?php echo getcwd(); ?></p>

        <h2>ZAWARTOŚĆ KATALOGU</h2>

        <table>
            <tr>
                <th>Nazwa</th>
                <th>Typ</th>
                <th>Rozmiar</th>
            </tr>

            <?php
            foreach ($pliki as $plik) {
                if ($plik != "." && $plik != "..") {
                    $pelnaSciezka = $sciezka . "/" . $plik;

                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($plik) . "</td>";

                    if (is_file($pelnaSciezka)) {
                        echo "<td>PLIK</td>";
                        echo "<td>" . filesize($pelnaSciezka) . " B</td>";
                    } elseif (is_dir($pelnaSciezka)) {
                        echo "<td>KATALOG</td>";
                        echo "<td>-</td>";
                    }

                    echo "</tr>";
                }
            }
            ?>
        </table>

        <h2>UTWÓRZ NOWY PLIK</h2>

        <form method="post">
            <label>Nazwa pliku:</label>
            <input type="text" name="nazwa" required>

            <label>Treść pliku:</label>
            <textarea name="tresc"></textarea>

            <button type="submit" name="utworz">Utwórz</button>
        </form>
    </div>
</body>
</html>
