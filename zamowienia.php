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
}$sql = mysqli_query($pol, "SELECT * FROM zamowienia");
if(mysqli_num_rows($sql) > 0){
    echo "<table class = 'Tabelka' border='1' rules='all' frame='void'>";
    echo "<tr>";
    echo "<th>id_zamowienia</th>";
    echo "<th>Klient_id_klient	</th>";
    echo "<th>Data_Zamowienia</th>";
    echo "<th>Data_Wysylki</th>";
    echo "<th>Koszt_Wysylki	
    </th>";
    echo "</tr>";
    while($row = mysqli_fetch_assoc($sql)){
        echo "<tr>";
        echo "<td>" . $row['id_zamowienia'] . "</td>";
        echo "<td>" . $row['Klient_id_klient'] . "</td>";
        echo "<td>" . $row['Data_Zamowienia'] . "</td>";
        echo "<td>" . $row['Data_Wysylki'] . "</td>";
        echo "<td>" . $row['Koszt_Wysylki'] . "</td>";
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
    echo "<input type = 'text' name = 'Klient_id_klient' placeholder = 'klient ID'>"."</br></br>";
    echo 'Data Zamowienia<br>';
    echo "<input type = 'date' name = 'Data_Zamowienia' placeholder = 'Data_Zamowienia'>"."</br></br>";
    echo  "Data wysyłki"."<br>";
    echo "<input type = 'date' name = 'Data_Wysylki' placeholder = 'Data_Wysylki'>"."</br></br>";
    echo "<input type = 'number' name = 'Koszt_Wysylki' placeholder = 'Koszt_Wysylki' min = 1>"."</br></br>";
    echo "<input type = 'submit' name = 'dodajzamowienia' value = 'Dodaj'>";
    echo "</form>";
    echo "</div>";
   

}
if($_POST['dodajzamowienia']){
    $przycisk = $_POST['dodajautor'];
    $Klient_id_klient = $_POST['Klient_id_klient'];
    $Data_Zamowienia = $_POST['Data_Zamowienia'];
    $Data_Wysylki = $_POST['Data_Wysylki'];
    $Koszt_Wysylki = $_POST['Koszt_Wysylki'];
    $sql = mysqli_query($pol, "INSERT INTO zamowienia (Klient_id_klient, Data_Zamowienia, Data_Wysylki, Koszt_Wysylki) VALUES ('$Klient_id_klient', '$Data_Zamowienia', '$Data_Wysylki', '$Koszt_Wysylki')");
    header("Refresh:0");
    }





if(isset($_POST['usuwaniezamowienie'])){
    echo "<p class='tekst'>Wpisz id autora ktorego chcesz usunac</p>";
    echo "<form method='post'>";
    echo "<input type = 'number' name = 'idzamowienia' placeholder = 'ID Zamowienia' min = 1>";
    echo "<input type='submit' name='potwierdz' value='Usuń'>";
    echo "</form>";
    $przycisk = $_POST['potwierdz'];
}
if($_POST['potwierdz']){
    $idzamowienie = $_POST['idzamowienia'];
    $sql = mysqli_query($pol, "DELETE FROM zamowienia WHERE id_zamowienia = '$idzamowienie'");
    $sql = mysqli_query($pol, "ALTER TABLE autor AUTO_INCREMENT = 1");
}
?>

</body>
</html>