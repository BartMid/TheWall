<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>The Atletas Muhr</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

  </head>
  <header>
    <div id="Logo"><h1>The Atletas Muhr</h1></div>
  </header>
  <body>


  <ul>
      <li><a id="icons" href="upload.php"><i class="material-icons">file_upload</i></a></li>
      <li><a id="icons" href="search.php"><i class="material-icons">search</i></a></li>
      <li><a id="icons" href="index.php"><i class="material-icons">home</i></a></li>
      <li><a id="icons" href="account.php"><i class="material-icons">person</i></a></li>
      <li><a id="icons" href="admin.php"><i class="material-icons">lock</i></a></li>
  </ul>

<!--<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <select name="sorteermenu">
        <option value="date_asc">datum oplopend</option>
        <option value="date_desc">datum aflopend</option>
        <option value="descr_asc">beschrijving oplopend</option>
        <option value="descr_desc">deschrijving aflopend</option>
    </select>
    <input type="submit" name="submit_sort" value="Sorteren">
</form>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="text" name="searchterm" placeholder="Zoekterm"/>
    <input type="submit" name="submit_search" value="Zoeken"/>
</form>
-->
<?php
$column = 'id';
$order = 'DESC';

if(isset($_POST['submit_sort'])){
    switch ($_POST['sorteermenu']){
        case 'date_asc': $column = 'id';
            $order = 'ASC';
            break;
        case 'date_desc': $column = 'id';
            $order = 'DESC';
            break;
        case 'descr_asc': $column = 'description';
            $order = 'ASC';
            break;
        case 'descr_desc': $column = 'description';
            $order = 'DESC';
            break;
    }
}


$dbc = mysqli_connect('localhost', 'bartuser', 'bartuser', 'insta_clone') or die ('Error!');
if (isset($_POST['submit_search'])) {
    $searchterm = mysqli_real_escape_string($dbc,trim($_POST['searchterm']));
    $searchterm = '%' . $searchterm . '%';
} else {
    $searchterm = '%';
}
$query = "SELECT * FROM images
  WHERE description LIKE '$searchterm'
  ORDER BY $column $order";
$result = mysqli_query($dbc, $query);
while ($row = mysqli_fetch_array($result)) {
    $target = $row['target'];
    $date = $row['date'];
    $username = $row['username'];
    $description = $row['description'];
    echo '<div id="media">';
    echo ' <div id="name">';
    echo '<h1>' . $username . '</h1>';
    echo '</div>';
    echo '<img id="picture" src="' . $target . '" /><br>';
    echo '</div>';
}
mysqli_close($dbc);
?>

</body>
</html>
