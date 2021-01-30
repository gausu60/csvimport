<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password,"dummy");

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
else{
  echo " success!!!";
}
if (isset($_POST['submit'])) {
  if ($_FILES['file']['name'] ) 
  {
    $filename = explode(".", $_FILES['file']['name']);
    if ($filename[1] == 'csv') {
      $handle = fopen($_FILES['file']['tmp_name'], "r");
      while ($data = fgetcsv($handle)) {
        $item1 = mysqli_real_escape_string($conn, $data[0]);
        $item2 = mysqli_real_escape_string($conn, $data[1]);
        $item3 = mysqli_real_escape_string($conn, $data[2]);
        $sql = "INSERT INTO demo (name,email,password) VALUES ('$item1','$item2','$item3')";
        mysqli_query($conn,$sql);
      }
      fclose($handle);
      print("Import Done...");
      # code...
    }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
  <form method="POST" enctype="multipart/form-data">
  <div align="center">
  <p>UPLOAD CSV:</p> <input type="file" name="file"> 
  <p><input type="submit" name="submit" value="Import"> </p>
    
  </div> 
    
  </form>

</body>
</html>