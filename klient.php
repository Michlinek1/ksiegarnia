<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>klient</title>
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
input[type="text"],input[type="date"],input[type="number"],input[type="email"]{
    width:100px;
    height:25px;
    text-align:center;
    font-size:13pt;
}

</style>
</head>

<body>
    <h1 class = "Tekst">Dane o kliencie:</h1>
<?php
$pol = new mysqli("localhost", "root", "", "ksiegarnia");
if ($pol->connect_errno) {
    echo "Błąd połączenia z bazą danych: " . $pol->connect_errno;
    exit;
}$sql = mysqli_query($pol, "SELECT * FROM klient");
if(mysqli_num_rows($sql) > 0){
    echo "<table class = 'Tabelka' border='1' rules='all' frame='void'>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Nazwisko</th>";
    echo "<th>Imie</th>";
    echo "<th>Adres</th>";
    echo "<th>Telefon</th>";
    echo "<th>Email</th>";
    echo "</tr>";
    while($row = mysqli_fetch_assoc($sql)){
        echo "<tr>";
        echo "<td>" . $row['id_klient'] . "</td>";
        echo "<td>" . $row['Nazwisko'] . "</td>";
        echo "<td>" . $row['Imie'] . "</td>";
        echo "<td>" . $row['Adres'] . "</td>";
        echo "<td>" . $row['Telefon'] . "</td>";
        echo "<td>" . $row['Email'] . "</td>";
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
<button name = "dodawanieautor" >Dodaj rekord</button></br><br>
&nbsp; &nbsp;
<button name = "usuwanieautor" >Usuń rekord</button> </br> <br>
</div>
</form>
<?php
if(isset($_POST['dodawanieautor'])){
    echo "<form method = 'POST'>";
    echo "<div class ='Dodawanie'>";
    echo "<input type = 'text' name = 'nazwisko' placeholder = 'Nazwisko'>"."</br></br>";
    echo "<input type = 'text' name = 'imie' placeholder = 'Imie'>"."</br></br>";
    echo "<input type = 'text' name = 'adres' placeholder = 'Adres'>"."</br></br>";
    echo "<input type = 'number' name = 'telefon' placeholder = 'Nr. Telefonu'>"."</br></br>";
    echo "<input type = 'email' name = 'email' placeholder = 'Email'>"."</br></br>";
    echo "<br>";
    echo "<input type = 'submit' name = 'dodajautor' value = 'Dodaj'>";
    echo "</form>";
    echo "</div>";
  
   

}
$przycisk = $_POST['dodajautor'];
if($przycisk){
    $nazwisko = $_POST['nazwisko'];
    $imie = $_POST['imie'];
    $Adres = $_POST['adres'];
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];
    $sql = mysqli_query($pol, "INSERT INTO klient (Nazwisko, Imie, Adres, Telefon,Email) VALUES ('$nazwisko', '$imie', '$Adres', '$telefon','$email')");
}

if(isset($_POST['usuwanieautor'])){
    echo "<p class='tekst'>Wpisz id klienta ktorego chcesz usunac</p>";
    echo "<form method='post'>";
    echo "<input type = 'number' name = 'idklient' placeholder = 'ID klienta'>";
    echo "<input type='submit' name='usun' value='Usuń'>";
    echo "</form>";

}
if(isset($_POST['usun'])){ 
    $kwerenda=mysqli_query($sql,"SELECT id_klienta FROM klient WHERE id_klient=$_POST[idklient]");
    $res=mysqli_num_rows($kwerenda);
    if ($res>0){
        $sql = mysqli_query($pol, "DELETE FROM klient WHERE id_klient = '$_POST[idklient]'");
        mysqli_query($pol, "ALTER TABLE klient AUTO_INCREMENT = 1");
        }
    else{
        echo "Nie ma takiego ID!";
    }
}
?>

</body>
</html>