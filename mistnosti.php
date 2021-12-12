<?php
require_once ('connect_db.php');

$query = 'SELECT * FROM room';
if(!array_key_exists('sort',$_GET))
{
    http_response_code(400);
}
else
{
    if($_GET['sort']=='ASCN')
    {
        $query .= ' ORDER BY `name` ASC';
    }
    elseif($_GET['sort']=='DESCN')
    {
        $query .= ' ORDER BY `name` DESC';
    }
    elseif($_GET['sort']=='ASCC')
    {
        $query .= ' ORDER BY `no` ASC';
    }
    elseif($_GET['sort']=='DESCC')
    {
        $query .= ' ORDER BY `no` DESC';
    }
    elseif($_GET['sort']=='ASCT')
    {
        $query .= ' ORDER BY phone ASC';
    }
    elseif($_GET['sort']=='DESCT')
    {
        $query .= ' ORDER BY phone DESC';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Seznam místností</title>
</head>
<body><div class="container"><?php

$pdo = DB::connect();
$stmt = $pdo->query($query);

if ($stmt->rowCount() == 0)
{
    echo "Databáze neobsahuje žádná data";
}
else
{
    echo "<h1><strong>Seznam místností</strong></h1>";
    echo "<table class='table table-striped'>";
    echo "<thead><tr><th>Název<a href='mistnosti.php?sort=ASCN'><i class='bi bi-caret-down-fill'></i></a><a href='mistnosti.php?sort=DESCN'><i class='bi bi-caret-up-fill'></i></a></th>";
    echo "<th>Číslo<a href='mistnosti.php?sort=ASCC'><i class='bi bi-caret-down-fill'></i></a><a href='mistnosti.php?sort=DESCC'><i class='bi bi-caret-up-fill'></i></a></th>";
    echo "<th>Telefon<a href='mistnosti.php?sort=ASCT'><i class='bi bi-caret-down-fill'></i></a><a href='mistnosti.php?sort=DESCT'><i class='bi bi-caret-up-fill'></i></a></th></tr></thead>";   
    echo "<tbody>";
    while ($row = $stmt->fetch()) 
    {
        echo "<tr>";
        echo "<td><a href='mistnost.php?room_id={$row->room_id}'>{$row->name}</a></td>";
        echo "<td>{$row->no}</td>";
        echo "<td>" . ($row->phone ?: "&mdash;") . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
}
    ?></div></body>
</html>