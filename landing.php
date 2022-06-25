<?php include ('function/db.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>STORE</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,700|Roboto:400,900" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero">
    <div class="container text-center">
      <div class="row">
        <div class="col-md-12">
          <!-- <a class="hero-brand" href="index.html" title="Home"><img alt="Bell Logo" src="assets/img/logo.png"></a> -->
        </div>
      </div>

      <div class="col-md-12">
               <h3>
               WELCOME !
               <h3>
               <h1>
                  <?php echo $_SESSION['store'];?>
               </h1>
               <p class="tagline">
                  <?php echo $_SESSION['store_address'];?>
               </p>
               <a href='staff_index.php' class="btn btn-full scrollto"  style='margin-bottom:10px;'>Management</a><br>
               <a href='store.php'  class="btn btn-danger "  >Cart Mode</a>
            </div>
    </div>

  </section><!-- End Hero -->


<!-- end modal -->



  <!-- Vendor JS Files -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="assets/js/sweetalert2@11.js"></script>
  
</body>

</html>