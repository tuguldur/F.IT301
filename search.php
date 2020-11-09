<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Search</title>
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
                  <a class="nav-link active" href="search.php">Хайх</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="list.php">Жагсаалт</a>
               </li>
             
            </ul>
            <ul class="navbar-nav">
               <li class="nav-item">
                  <a class="nav-link" href="login.php">Нэвтрэх</a>
               </li>
            </ul>
         </div>
      </nav>
      <div class="container mt-5">
      <form method="GET" class="row">
   <div class="form-group col-md-8">
      
         <label for="search-input">Оюутан хайх</label>
         <input type="search" class="form-control" id="search-input" aria-describedby="search-tip" placeholder="Хайх утга аа оруулна уу." autofocus="true" name="q">
   </div>
   <div class="form-group col-md-3">
   <label for="search-input">Насаар эрэмблэх</label>
      <select class="form-control" name="age">
         <option value="false">--Сонгох--</option>
         <option value="asc">Өсөхөөр</option>
         <option value="desc">Буурхаар</option>
      </select>
   </div>
</form>
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

if (isset($_GET['q']) || isset($_GET['age']))
{
    $q = mysqli_real_escape_string($connect, $_GET['q']);
    $raw_age = mysqli_real_escape_string($connect, $_GET['age']);
    if (isset($_GET['age']) && $_GET['age'] !== 'false')
    {
        $age = strtoupper($raw_age);
        $query = "SELECT * FROM students WHERE st_code LIKE '$q%' OR st_name LIKE '$q%' OR st_phone_number LIKE '$q%' OR st_address LIKE '%$q%' ORDER BY st_nas $age";
    }
    else
    {
        $query = "SELECT * FROM students WHERE st_code LIKE '$q%' OR st_name LIKE '$q%' OR st_phone_number LIKE '$q%' OR st_address LIKE '%$q%'";
    }
    $result = mysqli_query($connect, $query);
}
echo ($connect->error);
if (!empty($result))
{
    while ($row = mysqli_fetch_array($result))
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
<a class='mr-2' style='color:blue' href=edit.php?id=" . $row['id'] . ">Edit</a>
<a style='color:red' href=delete.php?id=" . $row['id'] . ">Delete</a>
</td>";
        echo "</tr>";
    }
}
?>
  </tbody>
</table>
<?php
$num_rows = 0;
if (!empty($result))
{
    $num_rows = mysqli_num_rows($result);
    echo "<code>$query</code></br>";
}
$connect->close();
echo "Нийт <b>$num_rows</b> Оюутан\n";
?>
</div>
      <script src="assets/js/jquery-3.5.1.min.js"></script>
      <script src="assets/js/popper.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
   </body>
</html>
