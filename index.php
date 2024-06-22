<?php
$conn = mysqli_connect('localhost', 'root', '', 'forumpsy');

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Forum o psach</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header>
        <h1>Forum miłośników psów</h1>
    </header>
    <main>
        <section class="lewy">
            <img src="Avatar.png" alt="Użytkownik forum">
            <?php
                $q1 = mysqli_query($conn, "SELECT nick, postow, pytania.pytanie FROM konta join pytania on konta.id = pytania.konta_id where pytania.id = 1;");
                while($row = mysqli_fetch_array($q1)){
                    echo "<h4>";
                    echo "Użytkownik " . $row["nick"];
                    echo "</h4>";
                    echo "<p>";
                    echo $row["postow"] . " postów na forum";
                    echo "</p>";
                    echo "<p>";
                    echo $row["pytanie"];
                    echo "</p>";
                }
            ?>
            <video controls loop>
                <source src="video.mp4" type="video/mp4">
            </video>
        </section>
        <section class="prawy">
            <form action="index.php" method="post">
                <textarea name="pole" id="pole" cols="40" rows="4"></textarea><br>
                <button id="przycisk" typ="sumbit">Dodaj odpowiedź</button>
                <?php
                    
                    if(!empty($_POST["pole"])) {
                        $odpowiedz = $_POST["pole"];
                        $q2 = mysqli_query($conn, "INSERT into odpowiedzi (id, Pytania_id, konta_id, odpowiedz)values(NULL, 1, 5, '$odpowiedz');");
                    }
                    
                   
                ?>
                <h2>Odpowiedzi na pytanie</h2>
                <ol>
                <?php
                $q3 = mysqli_query($conn, "SELECT odpowiedzi.id, odpowiedzi.odpowiedz, nick FROM odpowiedzi join konta on odpowiedzi.konta_id = konta.id WHERE odpowiedzi.Pytania_id = 1;");
                while($row = mysqli_fetch_array($q3)){
                    echo "<li>";
                    echo $row[1];
                    echo "<em>";
                    echo " " . $row[2];
                    echo "</em>";
                    echo "</li><hr>";
                }
                ?>
                </ol>
            </form>
        </section>
    </main>
    <footer>
        Autor: Milosz
        <a href=""></a>
        <a href="http://mojestrony.pl/" target="_blank">Zobacz nasze realizacje</a>
</body>
</html>
<?php
    mysqli_close($conn);
?>