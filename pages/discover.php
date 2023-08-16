<div id="content">
   <nav class="navbar navbar-expand bg-body-tertiary mb-3">
      <div class="container-fluid">
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-lg-0">
               <li class="nav-item mx-3">
                  <h5>Discover Books</h5>
               </li>
            </ul>
            <form action="" class="d-flex mx-3" method="post">
               <input type="text" class="form-control form-control-sm me-2" name="pencarian" autocomplete="off" placeholder="Search...">
               <button class="btn btn-sm btn-outline-success" type="submit" name="search" value="search">Search</button>
            </form>
         </div>
      </div>
   </nav>

   <div class="container">
      <div class="row">

         <!-- logic search books -->
         <?php
         if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $pencarian = trim(mysqli_real_escape_string($db, $_POST['pencarian']));
            if ($pencarian != "") {
               $sql = "SELECT * FROM book WHERE book_title LIKE '%$pencarian%' OR author LIKE '%$pencarian%' OR category LIKE '%$pencarian%'";
               $query = $sql;
               $queryJml = $sql;
            } else {
               $query = "SELECT * FROM book";
               $queryJml = "SELECT * FROM book";
            }
         } else {
            $query = "SELECT * FROM book";
            $queryJml = "SELECT * FROM book";
         }

         // prepare query book
         $stmt = $db->prepare($query);
         mysqli_stmt_execute($stmt);
         $books = mysqli_stmt_get_result($stmt)
         ?>

         <!-- looping row -->
         <?php foreach ($books as $row) : ?>
            <div class="col-md-2 col-sm-4 mb-2">
               <div class="" style="width: 150px;">
                  <img src="images/<?= $row['book_cover']; ?>" class="card-img-top" style="height: 200px;">
                  <div class="card-body p-2">
                     <h5 class="fs-6 fw-bold mb-1"><?= $row["book_title"]; ?></h5>
                     <p class="m-0" style="font-size: small;"><?= $row["author"]; ?></p>
                     <p class="mb-1" style="font-size: small;"><?= $row["publisher_name"]; ?></p>
                     <span href="#" class="text-light" style="font-size: 11px;background-color:#666;padding:3px;border-radius:5px;"><?= $row['category']; ?></span>
                  </div>
               </div>
            </div>
         <?php endforeach; ?>
         <!-- end looping -->
      </div>
   </div>
</div>