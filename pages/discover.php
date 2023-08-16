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
         <!-- looping row -->
         <?php
         $stmt = $db->prepare("SELECT * FROM book");
         mysqli_stmt_execute($stmt);
         $books = mysqli_stmt_get_result($stmt)
         ?>

         <?php foreach ($books as $row) : ?>
            <div class="col-md-2 col-sm-4 mb-2">
               <div class="card" style="width: 150px;">
                  <img src="images/1.jpg" class="card-img-top" style="height: 200px;">
                  <div class="card-body">
                     <h5 class="fs-5 fw-bold mb-1"><?= $row["book_title"]; ?></h5>
                     <p class="m-0" style="font-size: small;"><?= $row["author"]; ?></p>
                     <p class="mb-1" style="font-size: small;"><?= $row["publisher_name"]; ?></p>
                     <span href="#" class="" style="font-size: 11px;background-color:aqua;padding:3px;border-radius:5px;"><?= $row['category']; ?></span>
                  </div>
               </div>
            </div>
         <?php endforeach; ?>
         <!-- end looping -->
      </div>
   </div>
</div>