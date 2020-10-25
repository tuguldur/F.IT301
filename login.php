<?php
   session_start();
   if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
      // Хэрэглэгчийг нэвтэрсэн эсэхийн шалгана.
      header('location:status.php');
   }
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Login</title>
      <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
      <link rel="stylesheet" href="assets/css/style.css"/>
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
                  <a class="nav-link" href="list.php">Жагсаалт</a>
               </li>
            </ul>
            <ul class="navbar-nav">
               <li class="nav-item active">
                  <a class="nav-link" href="login.php">Login</a>
               </li>
            </ul>
         </div>
      </nav>
      <!-- login form -->
      <div className="row">
         <div class="form-wrapper">
            <form method="POST">
               <h5 class="text-center">Нэвтрэх хэсэг</h5>
               <div class="form-group">
                  <label>Оюутны код</label>
                  <input type="text" class="form-control" placeholder="Оюутны код" required name="code" />
               </div>
               <div class="form-group">
                  <label>Оюутны нууц үг</label>
                  <input type="password" class="form-control" placeholder="Оюутны нууц үг" required name="password" />
               </div>
               <?php
                   if(isset($_POST['code']) && isset($_POST['password'])){
                     include('./lib/config.php');
                     $raw_code = mysqli_real_escape_string($connect, $_POST['code']);
                     $raw_password = mysqli_real_escape_string($connect, $_POST['password']);
                     $code = strtoupper($raw_code);
                     $password = md5($raw_password);
                     $result = $connect->query("SELECT id FROM students WHERE st_code = '$code' AND password = '$password' LIMIT 1");
                     if ($result->num_rows > 0) {
                         $_SESSION['user'] = $result->fetch_assoc();
                         header("location: status.php");
                     }else {
                     echo "
                     <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Оюутны код эсвэл нууц үг буруу байна.
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                           <span aria-hidden='true'>&times;</span>
                        </button>
                     </div>
                     ";
                     }
                  }
               ?>
               <button type="submit" class="btn btn-primary btn-block text-uppercase" style="font-weight: 500;">Үргэлжлүүлэх</button>
            </form>
         </div>
      </div>
      <script src="assets/js/jquery-3.5.1.min.js"></script>
      <script src="assets/js/popper.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
   </body>
</html>