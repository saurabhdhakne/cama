<?php 

include 'check_con.php';

$sql = 'SELECT markerfile FROM organization WHERE id ="'.$_GET["id"].'"';

$result = mysqli_query($conn, $sql);
 
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $markerfile = $row['markerfile'];
?>


<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>AR LAB</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <script src="https://use.fontawesome.com/db006bf474.js"></script>

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
    
  <!-- Page Wrapper -->
  <div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center bg-white" href="/">
          <div class="sidebar-brand-icon rotate-n-15">
            <!-- <i class="fas fa-laugh-wink"></i> -->
          </div>
          <div class="sidebar-brand-text mx-3"> <img src="./img/user.png" height="50px" alt=""> </div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
          <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>
      
          
        <hr class="sidebar-divider">

        <div class="sidebar-heading">
          Interface
        </div>
          
        <li class="nav-item">
            <a class="nav-link collapsed" href="/" aria-expanded="true" aria-controls="collapseTwo">
              <i class="fas fa-fw fa-home"></i>
              <span>Home</span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link collapsed" href="modal-add" aria-expanded="true" aria-controls="collapseTwo">
              <i class="fab fa-blogger-b"></i>
              <span>Add Modal</span>
            </a>
          </li>

</ul>
<div id="content-wrapper" class="d-flex flex-column">

  <div id="content">

    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars">
         </i>
      </button>

      <ul class="navbar-nav ml-auto col-12">

        <li class="nav-item dropdown no-arrow text-primary mx-1 d-flex align-items-center pointer col-md-10">
            <i class="fas fa-fw fa-user mr-2 "></i>
            <b>
                Download The Marker <span class="text-secondary">  </span>
            </b>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <li class="nav-item dropdown no-arrow align-self-md-center">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
            <img class="img-profile rounded-circle" src="./img/user.png">
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="logout" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
          </div>
        </li>

      </ul>

    </nav>    
    

        <div class="container">
            <div class="col-md-6 offset-md-3 pt-2 text-center">
                <img src="../admin/<?php echo $markerfile; ?>" alt="patt file" width="100%" class="rounded">
                <a href="../admin/<?php echo $markerfile; ?>" class="btn btn-danger pl-4 pr-4 mt-4" download> Download</a>
            </div>
        </div>


      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; codeappmedia 2022</span>
          </div>
        </div>
      </footer>

    </div>

  </div>

  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout">Logout</a>
        </div>
      </div>
    </div>
  </div>


<!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <script>
        function updateTotal(){
          document.getElementById("total").innerHTML = "<?php echo $lengths; ?> " ; 
        }updateTotal();
  </script>
</body>

</html>
<?php
    }

}

?>