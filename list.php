<?php 

   include './lib/config.php';
   $limit = 5;
   $page = isset($_GET['page']) ? $_GET['page'] : 1;
   $start = ($page - 1) * $limit;
   $result = $connect->query("SELECT * FROM students LIMIT $start, $limit");

   $count = $connect->query("SELECT count(id) AS id FROM students");
   $pages = ceil( $count->fetch_assoc()['id'] / $limit );
   $previous = $page - 1;
   $next = $page + 1;
?>
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
                  <a class="nav-link" href="login.php">Нэвтрэх</a>
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
  <?php foreach($result as $student) : ?>
<tr>
    <td><?= $student['id']; ?></td>
    <td><?= $student['st_code']; ?></td>
    <td><?= $student['st_name']; ?></td>
    <td><?= $student['st_huis'] == 1 ? 'Эр' : 'Эм'?></td>
    <td><?= $student['st_nas']; ?></td>
    <td><?= $student['st_phone_number']; ?></td>
    <td><?= $student['st_address']; ?></td>
    <td><a class='mr-2'
           style='color:blue' 
           href="edit.php?id=<?= $student['id']; ?>">Засах</a>
           <a class='mr-2'
           style='color:red' 
           href="delete.php?id=<?= $student['id']; ?>" onclick="if(!confirm('<?= $student['st_name'] ?> <?= $student['st_code']; ?>-г устгах гэж байна нээрээ юм уу?')) event.preventDefault()">Устгах</a>
    </td>
</tr>
<?php endforeach; ?>
  </tbody>
</table>
<?php
$result = $connect->query("SELECT * FROM students");
$num_rows = mysqli_num_rows($result);
$connect->close();
echo "Нийт <b>$num_rows</b> Оюутан\n";
?>
<div class="mt-2">
	   <nav aria-label="Page navigation">
			<ul class="pagination justify-content-end">
				<li class="<?= $previous == 0 ? 'disabled': '' ?> page-item">
			      <a class="page-link" href="list.php?page=<?= $previous ?>" aria-label="Previous">
				     <span aria-hidden="true">&laquo;</span>
				   </a>
				</li>
				<?php for($i = 1; $i<= $pages; $i++) : ?>
				<li  class="page-item <?= $page == $i ?'active' :'' ?>"><a class="page-link" href="list.php?page=<?= $i; ?>"><?= $i; ?></a></li>
				<?php endfor; ?>
				<li class="<?= $result->num_rows < $limit ? 'disabled': '' ?> page-item">
				   <a class="page-link" href="list.php?page=<?= $next; ?>" aria-label="Next">
				      <span aria-hidden="true">&raquo;</span>
				   </a>
				</li>
			</ul>
		</nav>
	</div>
</div>
      <script src="assets/js/jquery-3.5.1.min.js"></script>
      <script src="assets/js/popper.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
   </body>
</html>