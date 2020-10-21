<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>List</title>
      <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
   </head>
   <body>
      <!-- header -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
         <a class="navbar-brand" href="/">F.IT301</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav mr-auto">
               <li class="nav-item">
                  <a class="nav-link" href="search.php">Хайх</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link active" href="list.php">Жагсаалт</a>
               </li>
             
            </ul>
            <ul class="navbar-nav">
               <li class="nav-item">
                  <a class="nav-link" href="login.php">Login</a>
               </li>
            </ul>
         </div>
      </nav>
      <div class="container mt-2">
<a class="btn btn-primary mb-2 mt-2 float-right" href='add.php'>
Оюутан нэмэх
</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Оюутны код</th>
      <th scope="col">Оюутны нэр</th>
      <th scope="col">Хүйс</th>
      <th scope="col">Нас</th>
      <th scope="col">Утасны дугаар</th>
      <th scope="col">Хаяг</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
   <?php
include './lib/config.php';
   
$result = mysqli_query($connect,"SELECT * FROM students");

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['id'] . "</td>";
echo "<td>" . $row['st_code'] . "</td>";
echo "<td>" . $row['st_name'] . "</td>";
echo "<td>" . $row['st_huis'] . "</td>";
echo "<td>" . $row['st_nas'] . "</td>";
echo "<td>" . $row['st_phone_number'] . "</td>";
echo "<td>" . $row['st_address'] . "</td>";
echo "<td>
<a class='mr-2' style='color:blue' href=edit.php?id=" .$row['id']. ">Edit</a>
<a style='color:red' href=delete.php?id=" .$row['id']. ">Delete</a>
</td>";
echo "</tr>";
}
$connect->close();
?>
  </tbody>
</table>
<?php
$num_rows = mysqli_num_rows($result);

echo "Нийт <b>$num_rows</b> Оюутан\n";
?>
</div>
      <script src="assets/js/jquery-3.5.1.min.js"></script>
      <script src="assets/js/popper.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
   </body>
</html>