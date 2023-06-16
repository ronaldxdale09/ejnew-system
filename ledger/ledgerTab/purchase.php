<style>
th {
    font-size: 12px;

}
</style>

<?php 



?>
<div class="row">
    <div class="col-sm-9">
        <div class="card">
            <div class="card-body">
                <!-- CONTENT -->
                <div class="row">
                    <div class="col-sm">
                        <button type="button" class="btn btn-success text-white" data-toggle="modal"
                            data-target="#purchase-modal">
                            <i class="fa fa-plus" aria-hidden="true"></i> ADD PURCHASE </button>
                    </div>
                    <div class="col-sm">
                        <div class="row">
                            <div class="col">
                                <select class='form-select' name='category' id='category_filter'>
                                    <option disabled="disabled" selected>Select Category </option>
                                    <option value=''>All</option>
                                    <?php echo $purCatList?>
                                    <!--PHP echo-->
                                </select>
                            </div>

                            <div class="col">
                                <b></b>
                                <input type="text" id="min" name="min" class="form-control" placeholder="From Date" />
                            </div>
                            <div class="col">
                                <input type="text" id="max" name="max" class="form-control" placeholder="To Date" />
                            </div>
                        </div>
                    </div>


                </div>
                <hr>
                <div class="table-responsive ">
                    <table class="table table-responsive-lg" id='purchase_table'>
                        <?php
                            $results  = mysqli_query($con, "SELECT * from ledger_purchase ORDER BY id DESC"); ?>
                        <thead class="table-dark">
                            <tr>
                                <th>VOUCHER</th>
                                <th>DATE</th>
                                <th>CATEGORY</th>
                                <th>SUPPLIER NAME</th>
                                <th>NET KILOS</th>
                                <th>PRICE</th>

                                <th>TOTAL AMOUNT</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                                <td> <?php echo $row['voucher']?> </td>
                                <td>
                                    <?php 
                                        $date = new DateTime($row['date']);
                                        echo $date->format('F j, Y'); // Outputs date as "May 14, 2023"
                                    ?>
                                </td>
                                <td> <?php echo $row['category']?> </td>
                                <td> <?php echo $row['customer_name']?> </td>
                                <td> <?php echo empty(floatval($row['net_kilos'])) ? "0" : number_format(floatval($row['net_kilos']));?>
                                    kg</td>
                                <td>₱ <?php echo empty($row['price']) ? "0" : number_format($row['price']);?> </td>
                                <td>₱ <?php echo number_format(floatval($row['total_amount']))?> </td>
                                <td>
                                    <button type="button" class="btn-sm btn-primary text-white" data-bs-toggle="modal"
                                        data-bs-target="#updatePurchase" data-bs-id="<?php echo $row['id']?>"
                                        data-bs-date="<?php echo $row['date']?>"
                                        data-bs-category="<?php echo $row['category']?>"
                                        data-bs-voucher="<?php echo $row['voucher']?>"
                                        data-bs-customer_name="<?php echo $row['customer_name']?>"
                                        data-bs-net_kilos="<?php echo $row['net_kilos']?>"
                                        data-bs-price="<?php echo $row['price']?>"
                                        data-bs-adjustment_price="<?php echo $row['adjustment_price']?>"
                                        data-bs-less="<?php echo $row['less']?>"
                                        data-bs-partial_payment="<?php echo $row['partial_payment']?>"
                                        data-bs-net_total="<?php echo $row['net_total']?>"
                                        data-bs-total_amount="<?php echo $row['total_amount']?>">
                                        <span class="fa fa-edit"></span>
                                    </button>
                                    <button type="button" class="btn-sm btn-danger text-white" data-bs-toggle="modal"
                                        data-bs-target="#removePurchase" data-bs-id="<?php echo $row['id']?>">
                                        <span class="fa fa-trash"></span>
                                    </button>
                                </td>
                            </tr> <?php } ?> </tbody>

                        <tfoot>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>

                            <th></th>
                            <th></th>

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-3">

        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted">PURCHASE TODAY</p>
                <h2><i class="text-danger font-weight-bold mr-1"></i>
                    ₱ <?php  echo number_format($purchase_today['total_amount']) ?>
                </h2>
                <div>
                    <span class="text-muted"><?php echo "Today is " . date("F d, Y") . "<br>"; ?>
                    </span>
                </div>
            </div>
            <div class="stat-card__icon stat-card__icon--success">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-money" aria-hidden="true"></i>
                </div>
            </div>
        </div>


        <div class="stat-card">
            <div class="stat-card__content">
                <p class="text-uppercase mb-1 text-muted">PURCHASE THIS MONTH</p>
                <h2><i class="text-danger font-weight-bold mr-1"></i>
                    ₱ <?php  echo number_format($purchase_month['month_total']) ?>
                </h2>
                <div>
                    <span class="text-muted"> <?php echo  date("F Y") . "<br>"; ?>
                    </span>
                </div>
            </div>
            <div class="stat-card__icon stat-card__icon--danger">
                <div class="stat-card__icon-circle">
                    <i class="fa fa-money" aria-hidden="true"></i>
                </div>
            </div>
        </div>


        <p class="text-uppercase mb-1 text-muted"><?php echo date('F Y'); ?> PURCHASE</p>
        <?php 
                $month = date('m');
                $year = date('Y');
                $side = mysqli_query($con, "SELECT category,year(date) as year,month(date) as month,sum(total_amount) as month_total from ledger_purchase 
                where month(date)='$month' and  year(date)='$year' 
                group by year(date), month(date), category ORDER BY id ASC");
            ?>

        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>CATEGORY</th>
                    <th>TOTAL </th>
                </tr>
            </thead>
            <?php  if(mysqli_num_rows($side) > 0)  
                    {  
                    while ($row = mysqli_fetch_array($side)) {
                ?>
            <tbody>
                <tr>
                    <td><?php echo $row['category']?></td>
                    <td>₱ <?php echo number_format((float)$row['month_total'], 0, '.', ','); ?></td>
                </tr>
                <?php } }      
                    else  
                        {  echo '<tr>  
                        <td colspan="4">No records found </td>  
                        </tr>';  } 
                ?>
            </tbody>
        </table>


    </div>
</div>