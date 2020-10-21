<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Add</title>
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
                  <a class="nav-link" href="login.php">Login</a>
               </li>
            </ul>
         </div>
      </nav>
      <!-- login form -->
      <div className="row">
         <div class="form-wrapper">
            <form id="add-form" method="POST">
               <h5 class="text-center">Шинэ оюутан нэмэгх</h5>
               <div class="form-group">
                  <label>Нэр</label>
                  <input type="text" class="form-control" placeholder="Оюутны нэр" required name="name" />
               </div>
               <div class="form-group">
                  <label>Оюутны код</label>
                  <input type="text" class="form-control" placeholder="Оюутны код" required name="code" />
               </div>
               <div class="form-group">
                  <label>Хүйс</label>
                  <select class="custom-select" required name="gender">
                     <option value="1">Эр</option>
                     <option value="0">Эм</option>
                  </select>
               </div>
               <div class="form-group">
                  <label>Нас</label>
                  <input type="number" class="form-control" placeholder="Оюутны нас" required name="age" />
               </div>
               <div class="form-group">
                  <label>Утасны дугаар</label>
                  <input type="number" class="form-control" placeholder="Оюунты утасны дугаар" required name="phone" />
               </div>
               <div class="form-group">
                  <label>Хаяг</label>
                  <textarea class="form-control" rows="3" required name="address"></textarea>
               </div>
               <div class="form-group">
                  <label>Нууц үг</label>
                  <input type="password" class="form-control" placeholder="Нууц үг" required name="password" id="password" />
               </div>
               <div class="form-group">
                  <label>Нууц үг давтах</label>
                  <input type="password" class="form-control" placeholder="Нууц үг давтах" required name="password_confirm" id="password_confirm" />
               </div>
<?php
include ('./lib/config.php');
if (isset($_POST['name']) && isset($_POST['code']) && isset($_POST['gender']) && isset($_POST['age']) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['password']) && isset($_POST['password_confirm']))
{
    //   hope this will prevent SQL injections
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $code = mysqli_real_escape_string($connect, $_POST['code']);
    $gender = mysqli_real_escape_string($connect, $_POST['gender']);
    $age = mysqli_real_escape_string($connect, $_POST['age']);
    $phone = mysqli_real_escape_string($connect, $_POST['phone']);
    $address = mysqli_real_escape_string($connect, $_POST['address']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $password_confirm = mysqli_real_escape_string($connect, $_POST['password_confirm']);
    $code_uppercase = strtoupper($code);
    if ($password !== $password_confirm)
    {
        echo "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
              Нууц үг зөрж байна.
               <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
               </button>
            </div>
            ";
    }
    else
    {
      $result = $connect->query("SELECT * FROM students WHERE st_code='$code_uppercase'");
      if($result->num_rows > 0)
      {
          echo "
              <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Оюутны код давхцаж байна.
                 <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                 </button>
              </div>
              ";
      }
      else{
         $password_hash = md5($password);
         $query = "INSERT INTO students(st_code, st_name, st_huis, st_nas,st_phone_number, st_address, password) 
         VALUES ('$code_uppercase','$name', '$gender', '$age', '$phone', '$address', '$password_hash')";
        if ($connect->query($query) === true)
        {
            echo "
         <div class='alert alert-success alert-dismissible fade show' role='alert'>
           Амжилттай бүртгэлээ.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
               <span aria-hidden='true'>&times;</span>
            </button>
         </div>
         ";
        }
        else
        {
            echo "
         <div class='alert alert-danger alert-dismissible fade show' role='alert'>
           Алдаатай хүсэлт. $connect->error 
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
               <span aria-hidden='true'>&times;</span>
            </button>
         </div>
         ";
        }
      }
    }
    $connect->close();
}
?>

               <button type="submit" class="btn btn-primary btn-block text-uppercase" style="font-weight: 500;">Үргэлжлүүлэх</button>
            </form>
         </div>
      </div>
      <script src="assets/js/jquery-3.5.1.min.js"></script>
      <script src="assets/js/popper.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
      <!-- custom javascript -->
      <script>
       $("#add-form").on("submit", () => {
            var password = $("#password").val();
            var password_confirm = $("#password_confirm").val();
            if (password !== password_confirm) {
               alert("Нууц үг зөрж байна");
               return false;
            }
         });
      </script>
   </body>
</html>