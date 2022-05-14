<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>zamowienie</title>
    <style>
.przyciskautor{
    text-align:center;
    display: flex;
    justify-content: center; 
    padding-right:5px;
    

}
button{
    width: 110px;
    height: 45px;
    font-size: 17px;
    border-radius: 5px;
    background-color: rgb(184, 184, 184);
    border-color: grey;
    border-radius: 3px;
}

.Tabelka{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    text-align: center;


}
td{
    padding: 10px;
}
.Tekst{
    text-align: center;
}
.Dodawanie{
    display:block;
    text-align:center;

}
input[type="text"],input[type="date"]{
    width:100px;
    height:25px;
    text-align:center;
    font-size:13pt;
}

</style>
</head>

<body>
    <h1 class = "Tekst">Dane o zamowieniu:</h1>
<?php
$pol = new mysqli("localhost", "root", "", "ksiegarnia");
if ($pol->connect_errno) {
    echo "Błąd połączenia z bazą danych: " . $pol->connect_errno;
    exit;
}$sql = mysqli_query($pol, "SELECT * FROM ksiazka");
if(mysqli_num_rows($sql) > 0){
    echo "<table class = 'Tabelka' border='1' rules='all' frame='void'>";
    echo "<tr>";
    echo "<th>idksiazka</th>";
    echo "<th>tytul</th>";
    echo "<th>miejsce_wydania</th>";
    echo "<th>Rok_wydania</th>";
    echo "<th>wydawnictwo</th>";
    echo "<th>cena</th>";
    echo "<th>jezyk_wydania</th>";
    echo "<th>Imie</th>";
    echo "<th>Nazwisko</th>";
    echo "<th>Osiągniecia</th>";

    echo "</tr>";
    while($row = mysqli_fetch_assoc($sql)){
        echo "<tr>";
        echo "<td>" . $row['idksiazka'] . "</td>";
        echo "<td>" . $row['tytul'] . "</td>";
        echo "<td>" . $row['miejsce_wydania'] . "</td>";
        echo "<td>" . $row['Rok_wydania'] . "</td>";
        echo "<td>" . $row['cena'] . "</td>";
        echo "<td>" . $row['jezyk_wydania'] . "</td>";
        echo "<td>" . $row['Imie'] . "</td>";
        echo "<td>" . $row['Nazwisko'] . "</td>";
        echo "<td>" . $row['Osiągniecia'] . "</td>";
        echo "</tr>";
        
}
echo "</table>";
echo "<br><br>";
}else{
    echo "Brak danych";
}

?>
<form method = "POST">
<div class = "przyciskautor">
<button name = "dodawaniezamowienie" >Dodaj rekord</button></br><br>
&nbsp; &nbsp;
<button name = "usuwaniezamowienie" >Usuń rekord</button> </br> <br>
</div>
</form>
<?php
if(isset($_POST['dodawaniezamowienie'])){
    echo "<form method = 'POST'>";
    echo "<div class ='Dodawanie'>";
    echo "<input type = 'text' name = 'tytul' placeholder = 'tytul '>"."</br></br>";
    echo "<input type = 'text' name = 'miejsce_wydania' placeholder = 'miejsce wydania'>"."</br></br>";
    echo  "Rok wydania"."<br>";
    echo "<input type = 'date' name = 'Rok_wydania' placeholder = 'Rok wydania'>"."</br></br>";
    echo "<input type = 'number' name = 'cena' placeholder = 'cena' min = 1>"."</br></br>";
    echo "<input type = 'text' name = 'jezyk_wydania' placeholder = 'jezyk wydania'>"."</br></br>";
    echo "<input type = 'text' name = 'miejsce_wydania' placeholder = ' Imie'>"."</br></br>";
    echo "<input type = 'text' name = 'miejsce_wydania' placeholder = 'Nazwisko'>"."</br></br>";
    echo "<input type = 'text' name = 'Osiągniecia' placeholder = 'Osiągniecia'>"."</br></br>";
    echo "<input type = 'submit' name = 'dodajksiazka' value = 'Dodaj'>";
    echo "</form>";
    echo "</div>";
   

}
if($_POST['dodajksiazka']){
    $tytul = $_POST['tytul'];
    $miejsce_wydania = $_POST['miejsce_wydania'];
    $Rok_wydania = $_POST['Rok_wydania'];
    $cena = $_POST['cena'];
    $jezyk_wydania = $_POST['jezyk_wydania'];
    $Imie = $_POST['Imie'];
    $Nazwisko = $_POST['Nazwisko'];
    $Osiągniecia = $_POST['Osiągniecia'];
    $przycisk = $_POST['dodajksiazka'];
    $sql = mysqli_query($pol, "INSERT INTO ksiazka (tytul, miejsce_wydania, Rok_wydania, cena, jezyk_wydania, Imie, Nazwisko, Osiągniecia) VALUES ('$tytul', '$miejsce_wydania', '$Rok_wydania', '$cena', '$jezyk_wydania', '$Imie', '$Nazwisko', '$Osiągniecia')");
    header("Refresh:0");
    }





if(isset($_POST['usuwaniezamowienie'])){
    echo "<p class='tekst'>Wpisz id autora ktorego chcesz usunac</p>";
    echo "<form method='post'>";
    echo "<input type = 'number' name = 'idksiazka' placeholder = 'ID Zamowienia' min = 1>";
    echo "<input type='submit' name='potwierdz' value='Usuń'>";
    echo "</form>";
    $przycisk = $_POST['potwierdz'];
}
if($_POST['potwierdz']){
    $idksiazka = $_POST['idksiazka'];
    $sql = mysqli_query($pol, "DELETE FROM ksiazka WHERE idksiazka = '$idksiazka'");
    header("Refresh:0");

}
?>

</body>
</html>