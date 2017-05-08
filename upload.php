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

<form enctype="multipart/form-data" method="post" action="upload.php">
<div id="login">
<div id="loginl"><h1>Upload</h1></div>
  <input type="file" name="image" accept="image/*">
<div id="text"> <input type="text" id="invoer" name="username" required placeholder="  Gebruikersnaam"/></br>
    <input type="text" id="invoer" name="description" required placeholder="  Beschrijving"/></br> </div>
<input type="submit" id="button" name="submit" value="Plaatsen"/>
</div>
  </form>

  <?php
  if(isset($_POST['submit'])){
      $dbc = mysqli_connect('localhost', 'bartuser', 'bartuser', 'insta_clone') or die ('Error!');
      $description = mysqli_real_escape_string($dbc,trim($_POST['description']));
      $username = mysqli_real_escape_string($dbc,trim($_POST['username']));
      $target = 'images/' . time() . $_FILES['image']['name'];
      $temp = $_FILES['image']['tmp_name'];
      if (!empty($description)){
          if(move_uploaded_file($temp,$target)){
              $query = "INSERT INTO images VALUES (0,NOW(),'$description','$target','$username')";
              $result = mysqli_query($dbc,$query) or die ('Error querying.');
              echo '<br>Bestand geüpload';
          }
      }
  }



  ?>

</html>
