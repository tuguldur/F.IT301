<?php
include ('./lib/config.php');
if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $edit = $connect->query("SELECT * FROM students WHERE id = $id");
    $student = $edit->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Edit</title>
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
                  <input type="text" class="form-control" placeholder="Оюутны нэр" required name="name" value="<?= $student['st_name'] ?>" />
               </div>
               <div class="form-group">
                  <label>Оюутны код</label>
                  <input type="text" class="form-control" placeholder="Оюутны код" required name="code" value="<?= $student['st_code'] ?>" />
               </div>
               <div class="form-group">
                  <label>Хүйс</label>
                  <select class="form-control" required name="gender">
                     <option value="1" <?= $student['st_huis'] == 1 ? 'selected' :'' ?>>Эр</option>
                     <option value="0" <?= $student['st_huis'] == 0 ? 'selected' :'' ?>>Эм</option>
                  </select>
               </div>
               <div class="form-group">
                  <label>Нас</label>
                  <input type="number" class="form-control" placeholder="Оюутны нас" required name="age" value="<?= $student['st_nas'] ?>" />
               </div>
               <div class="form-group">
                  <label>Утасны дугаар</label>
                  <input type="number" class="form-control" placeholder="Оюунты утасны дугаар" required name="phone" value="<?= $student['st_phone_number'] ?>" />
               </div>
               <div class="form-group">
                  <label>Хаяг</label>
                  <textarea class="form-control" rows="3" required name="address"><?= htmlspecialchars($student['st_address']) ?></textarea>
               </div>
<?php
if (isset($_POST['name']) && isset($_POST['code']) && isset($_POST['gender']) && isset($_POST['age']) && isset($_POST['phone']) && isset($_POST['address']))
{
    //   hope this will prevent SQL injections
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $code = mysqli_real_escape_string($connect, $_POST['code']);
    $gender = mysqli_real_escape_string($connect, $_POST['gender']);
    $age = mysqli_real_escape_string($connect, $_POST['age']);
    $phone = mysqli_real_escape_string($connect, $_POST['phone']);
    $address = mysqli_real_escape_string($connect, $_POST['address']);
    $code_uppercase = strtoupper($code);
    $result = $connect->query("SELECT * FROM students WHERE st_code='$code_uppercase' AND id<>$id");
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
        $query = "UPDATE students SET st_code='$code', st_name='$name', st_huis='$gender', st_nas='$age',st_phone_number='$phone', st_address='$address' WHERE id='$id'";
        if ($connect->query($query) === true)
        {
            echo "
         <div class='alert alert-success alert-dismissible fade show' role='alert'>
           Амжилттай хадгаллаа.
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
    $connect->close();
}
?>

               <button type="submit" class="btn btn-primary btn-block text-uppercase" style="font-weight: 500;">хадгалах</button>
            </form>
         </div>
      </div>
      <script src="assets/js/jquery-3.5.1.min.js"></script>
      <script src="assets/js/popper.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
   </body>
</html>