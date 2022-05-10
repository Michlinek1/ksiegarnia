<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>autor</title>
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
    <h1 class = "Tekst">Dane o autorze:</h1>
<?php
$pol = new mysqli("localhost", "root", "", "ksiegarnia");
if ($pol->connect_errno) {
    echo "Błąd połączenia z bazą danych: " . $pol->connect_errno;
    exit;
}$sql = mysqli_query($pol, "SELECT * FROM autor");
if(mysqli_num_rows($sql) > 0){
    echo "<table class = 'Tabelka' border='1' rules='all' frame='void'>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Imię</th>";
    echo "<th>Nazwisko</th>";
    echo "<th>Narodowosc</th>";
    echo "<th>Okres Wydania</th>";
    echo "</tr>";
    while($row = mysqli_fetch_assoc($sql)){
        echo "<tr>";
        echo "<td>" . $row['id_autora'] . "</td>";
        echo "<td>" . $row['Imie'] . "</td>";
        echo "<td>" . $row['Nazwisko'] . "</td>";
        echo "<td>" . $row['Narodowosc'] . "</td>";
        echo "<td>" . $row['Okres_Wydania'] . "</td>";
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
    echo "<input type = 'text' name = 'imie' placeholder = 'Imię'>"."</br></br>";
    echo "<input type = 'text' name = 'nazwisko' placeholder = 'Nazwisko'>"."</br></br>";
    echo "<input type = 'text' name = 'narodowosc' placeholder = 'Narodowosc'>"."</br></br>";
    echo "Okres wydania:<br>";
    echo "<input type = 'date' name = 'data' >";
    echo "<input type = 'submit' name = 'dodajautor' value = 'Dodaj'>";
    echo "</form>";
    echo "</div>";
    $przycisk = $_POST['dodajautor'];
    echo gettype($przycisk);
   

}
$przycisk = $_POST['dodajautor'];
if($przycisk){
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $narodowosc = $_POST['narodowosc'];
    $data = $_POST['data'];
    $sql = mysqli_query($pol, "INSERT INTO autor (Imie, Nazwisko, Narodowosc, Okres_Wydania) VALUES ('$imie', '$nazwisko', '$narodowosc', '$data')");
    header("Location: index.php");
}

if(isset($_POST['usuwanieautor'])){
    echo "<p class='tekst'>Wpisz id autora ktorego chcesz usunac</p>";
    echo "<form method='post'>";
    echo "<input type='number' name='wyborid'>"."<br>";
    echo "<input type='submit' name='potwierdz' value='Usuń'>";
    echo "</form>";
    if(isset($_POST['']))
#jesli jest ustaweione $post wyborid. jesli jest to z lewej i id jest w bazie to usuwa a jak id nie ma w bazie to pisze ci ze nie ma autora z takim id 
}
?>

</body>
</html>