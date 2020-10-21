<?php
   include './lib/config.php';
   session_start();
   if(isset($_SESSION['user'])){
       $id = $_SESSION['user']['id'];
       $result = $connect->query("SELECT * FROM students WHERE id=$id");
       if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
       }
       else{
           header('Location:login.php');
       }
   }
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Status</title>
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
               <li class="nav-item">
                  <a class="nav-link" href="logout.php">Logout</a>
               </li>
            </ul>
         </div>
      </nav>
      <div class="form-wrapper text-center">
        <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Тавтай морил <?php echo $user['st_name']; ?></h4>
      </div>
      <div class="card-body">
        <ul class="list-unstyled mt-3 mb-4">
        <li>Оюутны код: <?php echo $user['st_code']; ?></li>
        <li>Оюутны хүйс: <?php echo $user['st_huis'] === '1' ? 'Эр' :'Эм' ; ?></li>
        <li>Оюутны утасны дугаар: <?php echo $user['st_phone_number']; ?></li>
        <li>Оюутны хаяг: <?php echo $user['st_address']; ?></li> 
        </ul>
        <a href="logout.php" class="btn btn-block btn-primary">Гарах</a>
      </div>
    </div>
      </div>
      <script src="assets/js/jquery-3.5.1.min.js"></script>
      <script src="assets/js/popper.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
   </body>
</html>