<?php 
   include('include/header.php');
   include "include/navbar.php";

  



    $tab= '';
    if (isset($_GET['tab'])) {
        $tab = filter_var($_GET['tab']) ;
      }

   ?>


<?php include('modal/modal_receiving.php'); ?>
<?php include('modal/modal_milling.php'); ?>
<?php include('modal/modal_drying.php'); ?>
<?php include('modal/modal_pressing.php'); ?>
<?php include('modal/modal_produced.php'); ?>
<body>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <link rel='stylesheet' href='css/tab-style.css'>


    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <!-- ============================================================== -->
                <div class="container-fluid">
                    <div class="row">


                        <div class="col-sm-3 offset-sm-0">
                            <div class="stat-card">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted"><b>CUPLUMP</b> INVENTORY</p>
                                    <h3><i class="text-danger font-weight-bold mr-1"></i>
                                        kg
                                    </h3>
                                    <div>
                                        <span class="text-muted">
                                        </span>
                                    </div>
                                </div>
                                <div class="stat-card__icon stat-card__icon--danger">
                                    <div class="stat-card__icon-circle">
                                        <i class="fa fa-weight" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="stat-card">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted"><b>DRYING</b> INVENTORY</p>
                                    <h3><i class="text-danger font-weight-bold mr-1"></i>
                                        kg
                                    </h3>
                                    <div>
                                        <span class="text-muted">
                                        </span>
                                    </div>
                                </div>
                                <div class="stat-card__icon stat-card__icon--secondary">
                                    <div class="stat-card__icon-circle">
                                        <i class="fas fa-tint"></i><i class="fas fa-wind"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3 offset-sm-0">
                            <div class="stat-card">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted"><b>CRUMBS</b> INVENTORY</p>
                                    <h3><i class="text-danger font-weight-bold mr-1"></i>
                                        kg
                                    </h3>
                                    <div>
                                        <span class="text-muted">
                                        </span>
                                    </div>
                                </div>
                                <div class="stat-card__icon stat-card__icon--warning">
                                    <div class="stat-card__icon-circle">
                                        <i class="fa fa-weight" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="stat-card">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted"><b>BALES</b> INVENTORY</p>
                                    <h3><i class="text-danger font-weight-bold mr-1"></i>
                                        bales/kg
                                    </h3>
                                    <div>
                                        <span class="text-muted">
                                        </span>
                                    </div>
                                </div>
                                <div class="stat-card__icon stat-card__icon--success">
                                    <div class="stat-card__icon-circle">
                                        <i class="fa fa-money"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="inventory-table">
                        <div class="container-fluid">
                            <div class="wrapper" id="myTab">
                                <input type="radio" name="slider" id="home"
                                    <?php if ($tab == '') { echo 'checked'; } else { echo ''; } ?>>
                                <input type="radio" name="slider" id="blog"
                                    <?php if ($tab == '2') { echo 'checked'; } else { echo ''; } ?>>
                                <input type="radio" name="slider" id="drying"
                                    <?php if ($tab == '3') { echo 'checked'; } else { echo ''; } ?>>
                                <input type="radio" name="slider" id="code"
                                    <?php if ($tab == '4') { echo 'checked'; } else { echo ''; } ?>>
                                <input type="radio" name="slider" id="help"
                                    <?php if ($tab == '5') { echo 'checked'; } else { echo ''; } ?>>

                                <nav>
                                    <label for="home" class="home"><i class="fa fa-add"></i>Receiving</label>
                                    <label for="blog" class="blog"><i class="fas fa-spinner"></i>Milling</label>
                                    <label for="drying" class="drying"><i class="fas fa-spinner"></i>Drying</label>
                                    <label for="code" class="code"><i class="fas fa-check"></i>Pressing</label>
                                    <label for="help" class="help"><i class="fas fa-book"></i>Produced</label>

                                    <div class="slider"></div>
                                </nav>
                                <section>
                                    <div class="content content-1">
                                        <div class="title">FIELD INVENTORY </div>
                                        <button type="button" class="btn btn-primary text-white" data-toggle="modal"
                                            data-target="#newReceiving">
                                            <i class="fa fa-add" aria-hidden="true"></i> NEW RECEIVING </button>

                                        <hr>
                                        <?php include('tab/receiving.php') ?>
                                    </div>
                                    <div class="content content-2">
                                        <div class="title">BLANKET INVENTORY</div>
                                        <?php include('tab/milling.php') ?>
                                    </div>
                                    <div class="content content-3">
                                        <div class="title">Drying INVENTORY</div>
                                        <?php include('tab/drying.php') ?>
                                    </div>
                                    <div class="content content-4">
                                        <div class="title">PRESSING INVENTORY</div>
                                        <?php include('tab/pressing.php') ?>
                                    </div>
                                    <div class="content content-5">
                                        <div class="title">FINISHED GOODS INVENTORY</div>
                                        <?php include('tab/finished_goods.php') ?>
                                </section>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
<script src="js/recording.js"></script>

</html>