<?php
include 'config.php';
$tgl = date('Y-m-d');
session_start();
if (isset($_SESSION['auth'])) {
?>
   <!doctype html>
   <html>

   <head>
      <title>Sistem Informasi Perpustakaan</title>
      <link rel="stylesheet" href="css/style.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
   </head>

   <style>

   </style>

   <body style="font-family: 'Times New Roman', Times, serif; ">

      <nav class="navbar navbar-expand">
         <div class="container">
            <div class="d-flex">
               <a class="navbar-brand text-light" href="#"><i class="bi bi-book"></i> Library</a>
            </div>

            <div class="navbar-collapse justify-content-end">
               <ul class="navbar-nav">
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle text-light" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-circle"></i>
                     </a>
                     <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-end">
                        <li><a class="dropdown-item btn btn-tertiary" href="#"><i class="bi bi-person-fill"> <?php echo $_SESSION['auth']; ?></i>
                           </a>
                        </li>
                        <li>
                           <a href="logout.php" onclick="return confirm('apakah yakin ingin logout?')" class="dropdown-item btn btn-tertiary"><i class="bi bi-box-arrow-in-right"> Logout</i></a>

                        </li>
                     </ul>
                  </li>
               </ul>
            </div>
         </div>
      </nav>

      <div id="container">
         <div id="sidebar">
            <ul class="my-2">
               <li>
                  <a href="index.php?p=beranda"><i class="bi bi-house"></i> Home</a>
               </li>
            </ul>
            <p class="label-navigasi"><i class="bi bi-search"></i> Discover</p>
            <ul>
               <li>
                  <a href="index.php?p=discover"><i class="bi bi-book"></i> Books</a>
               </li>
            </ul>
            <p class="label-navigasi">
               <i class="bi bi-people-fill"></i> Data Master
            </p>
            <ul>
               <li><a href="index.php?p=anggota"><i class="bi bi-people-fill"></i> Member</a></li>
               <li><a href="index.php?p=buku"><i class="bi bi-book"></i> Book</a></li>
            </ul>
            <p class="label-navigasi">
               <i class="bi bi-bookshelf"></i> Data Transaksi
            </p>
            <ul>
               <li><a href="index.php?p=listborrow"><i class="bi bi-clipboard-data"></i> Borrow</a></li>
               <li><a href="index.php?p=listreturn"><i class="bi bi-layer-backward"></i> Return</a></li>
            </ul>
            <p class="label-navigasi" style="color: white;">Laporan Transaksi</p>
         </div>
         <div id="content-container">
            <div class="container py-3 px-0">
               <?php
               $pages_dir = 'pages';
               if (!empty($_GET['p'])) {
                  $pages = scandir($pages_dir, 0);
                  unset($pages[0], $pages[1]);
                  $p = $_GET['p'];
                  if (in_array($p . '.php', $pages)) {
                     include($pages_dir . '/' . $p . '.php');
                  } else {
                     echo 'Halaman Tidak Ditemukan';
                  }
               } else {
                  include($pages_dir . '/beranda.php');
               }
               ?>
            </div>
         </div>
      </div>

      <div id="footer">
         <h3>Library Management System</h3>
      </div>

      <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
      </script>

   </body>

   </html>
<?php
} else {
   echo "<script>
		alert('Anda Harus Login Dahulu!');
	</script>";
   header('location:login.php');
}
?>