<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="styl.css">
    <title>Hurtownia papiernicza</title>
</head>
<body>
    <header>
        <h1>W naszej hurtowni kupisz najtaniej</h1>
    </header>

    <section id="left-block">
        <h3>Ceny wybranych artykułów w hurtowni:</h3>
        <table>
            <?php
                $conn = mysqli_connect('localhost', 'root', '', 'sklep2');

                $query = "SELECT nazwa, cena FROM towary LIMIT 4";
                $result = mysqli_query($conn, $query);

                while($row = mysqli_fetch_assoc($result))
                {
                    $code =<<<CODE
                        <tr>
                            <td>$row[nazwa]</td>
                            <td>$row[cena]</td>
                        </tr>
                    CODE;

                    echo $code;
                }

                mysqli_close($conn);
            ?>
        </table>
    </section>

    <section id="middle-block">
        <h3>Ile będą kosztować Twoje zakupy?</h3>
        
        <form action="index.php" method="POST">
            wybierz artykuł
            <select name="itemName">
                <option value="Zeszyt 60 kartek">Zeszyt 60 kartek</option>
                <option value="Zeszyt 32 kartki">Zeszyt 32 kartki</option>
                <option value="Cyrkiel">Cyrkiel</option>
                <option value="Linijka 30 cm">Linijka 30 cm</option>
                <option value="Ekierka">Ekierka</option>
                <option value="Linijka 50 cm">Linijka 50 cm</option>
            </select> <br>

            liczba sztuk:
            <input type="number" value="1" name="amount"> <br>

            <input type="submit" value="OBLICZ" name="submit"> <br>

            <?php
                if(empty($_POST['submit']) ==false)
                {
                    $itemName = $_POST['itemName'];
                    $amount = $_POST['amount'];
    
                    $conn = mysqli_connect('localhost', 'root', '', 'sklep2');
                    $query = "SELECT cena FROM towary WHERE nazwa='$itemName'";
    
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
    
                    $price = round($row['cena'] * $amount);
    
                    echo "$price zł";
    
                    mysqli_close($conn);
                }


            ?>
        </form>
    </section>

    <section id="right-block">
        <img src="zakupy2.png" alt="hurtownia">
        <h3>Kontakt</h3>
        <p>telefon: <br> 111222333 <br> e-mail: <br> <a href="mailto:hurt@wp.pl">hurt@wp.pl</a></p>
    </section>

    <footer>
        <h4>Witrynę wykonał Franciszek Pawłowski</h4>
    </footer>
</body>
</html>