<?php

session_start();

if ($_SESSION['role'] !== 'farmer') {
  header('Location: ../index');
}

require 'includes/header.php';
require 'includes/navconnected.php'; //require $nav;?>

 <div class="container-fluid product-page">
   <div class="container current-page">
      <nav>
        <div class="nav-wrapper">
          <div class="col s12">
            <a href="index" class="breadcrumb">Dashboard</a>
            <a href="infoproduct" class="breadcrumb">Products</a>
            <a href="stats" class="breadcrumb">stats</a>
          </div>
        </div>
      </nav>
    </div>
   </div>

        <div class="container center-align staaats">
          <div class="row">
          <?php


          include '../db.php';

         $queryfirst = "SELECT

        product.id as 'id',
        product.id_category,

         SUM(sales.quantity) as 'total',
         sales.statut,
         sales.id_produit,

         category.name as 'name',
         category.id

         FROM product, sales, category
         WHERE product.id = sales.id_produit
         AND category.id = product.id_category
         GROUP BY category.id";
         $resultfirst = $connection->query($queryfirst);
         if ($resultfirst->num_rows > 0) {
           // output data of each row
           while($rowfirst = $resultfirst->fetch_assoc()) {

                 $idp = $rowfirst['id'];
                 $name_best = $rowfirst['name'];
                 $totalsold = $rowfirst['total'];
                 $percent = ($totalsold / 50 )*100;

                 ?>

                  <div class="col s2">
                    <p class="black-text"><?= $name_best; ?></p>
                    <div class="card red<?= $idp; ?>" style="padding-top:<?=number_format((float)$percent, 2, '.', ''); ?>%">
                       <h5 class="white-text"><?=number_format((float)$percent, 2, '.', '');  ?>%</h5>
                    </div>
                  </div>


                 <?php }} ?>

          </div>
        </div>
 <?php require 'includes/footer.php'; ?>
