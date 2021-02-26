<?php 
  session_start();
  include('includes/config.php');
  error_reporting(0);

  if(strlen($_SESSION['login'])==0) { 
    header('location:index.php');
  }

  if(isset($_GET["status"])) {
    $status = ($_GET["status"] == 'deactive') ? 2 : 1;

    $updateVehicle = "UPDATE `tblvehicles` SET `DisplayStatus` = :status WHERE `tblvehicles`.`id` = :id";
    $updateVehicle = $dbh -> prepare($updateVehicle);
    $updateVehicle-> bindParam(':status', $status, PDO::PARAM_STR);
    $updateVehicle-> bindParam(':id', $_GET["vid"], PDO::PARAM_STR);
    $updateVehicle->execute();

    echo "<script>alert('Status updated successfully.');</script>";
  }

  if(isset($_GET["delete"])) {
    $deleteVehicle = "UPDATE `tblvehicles` SET `IsDeleted` = 1 WHERE `tblvehicles`.`id` = :id";
    $deleteVehicle = $dbh -> prepare($deleteVehicle);
    $deleteVehicle-> bindParam(':id', $_GET["delete"], PDO::PARAM_STR);
    $deleteVehicle->execute();

    echo "<script>alert('Vehicle deleted successfully.');</script>";
  }

  $vehicleList = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid
                from tblvehicles
                join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand
                where tblvehicles.IsDeleted = 0
                and tblvehicles.PostedBy=:postedby";
  $vehicleList = $dbh -> prepare($vehicleList);
  $vehicleList->bindParam(':postedby', $_SESSION["userID"], PDO::PARAM_STR);
  $vehicleList->execute();
  $vehicleList = $vehicleList->fetchAll();
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="Rental, Car rental, rent your car, peer to peer">
<meta name="description" content="Rental drive is peer to peer car rental model.">
<title>Rental Drive</title>

<!--stylesheets-->
<?php include('includes/stylesheets.php');?>
<!-- /stylesheets -->

</head>
<body>
        
<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header -->

<!--Page Header-->
<section class="page-header profile_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Posted Vehicles</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="/">Home</a></li>
        <li>Posted Vehicles</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 

<!--my-vehicles-->
<section class="user_profile inner_pages">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-3">
       <?php include('includes/sidebar.php');?>
      </div>
      <div class="col-md-6 col-sm-8">
        <div class="profile_wrap">
          <h5 class="uppercase underline">Posted Vehicles <span>(<?php count($vehicleList) ?> Cars)</span></h5>
          <div class="my_vehicles_list">
            <ul class="vehicle_listing">
              <?php 
                foreach($vehicleList as $result) {
                  if($result["DisplayStatus"] == 1) {
                    $statusButton = '<a href="my-vehicles.php?status=deactive&vid='. $result["id"] .'" class="btn outline btn-xs active-btn">Deactive</a>';
                  } else {
                    $statusButton = '<a href="my-vehicles.php?status=active&vid='. $result["id"] .'" class="btn outline btn-xs active-btn">Active</a>';
                  }
              ?>
              <li>
                <div class="vehicle_img">
                  <a href="#"><img src="assets/images/vehicles/<?php echo $result["Vimage1"] ?>" alt="image"></a> </div>
                <div class="vehicle_title">
                  <h6><a href="#"><?php echo $result["BrandName"] ?>, <?php echo $result["VehiclesTitle"] ?>, <?php echo $result["ModelYear"] ?> </a></h6>
                </div>
                <div class="vehicle_status">
                  <?php echo $statusButton ?>
                  <div class="clearfix"></div>
                  <a href="edit-vehicle.php?vid=<?php echo $result["id"] ?>" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <a href="my-vehicles.php?delete=<?php echo $result["id"] ?>"><i class="fa fa-trash" aria-hidden="true"></i></a> </div>
              </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/my-vehicles--> 

<!--Footer -->
<?php include('includes/footer.php');?>
<!-- /Footer-->

<!--Login-Form -->
<?php include('includes/login.php');?>
<!--/Login-Form --> 

<!--Register-Form -->
<?php include('includes/registration.php');?>

<!--/Register-Form --> 

<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php');?>
<!--/Forgot-password-Form --> 

<!-- Scripts --> 
<?php include('includes/javascripts.php');?>

</body>

<!-- Mirrored from themes.webmasterdriver.net/carforyou/demo/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 27 Sep 2020 03:12:24 GMT -->
</html>