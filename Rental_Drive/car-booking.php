<?php
session_start();
error_reporting(1);
include('includes/config.php');

if(strlen($_SESSION['login'])==0) { 
  header('location:index.php');
}

if(isset($_GET["status"])) {
  $status = $_GET["status"] == 'confirm' ? 1 : 2;

  $updateBooking = "UPDATE `tblbooking` SET `Status` = :status WHERE `tblbooking`.`BookingNumber` = :booking";
  $updateBooking = $dbh -> prepare($updateBooking);
  $updateBooking-> bindParam(':status', $status, PDO::PARAM_STR);
  $updateBooking-> bindParam(':booking', $_GET["booking"], PDO::PARAM_STR);
  $updateBooking->execute();

  echo "<script>alert('Status updated successfully.');</script>";
  echo "<script type='text/javascript'> document.location = 'car-booking.php'; </script>";
}

$bookingList = "SELECT tblvehicles.Vimage1 as Vimage1,tblvehicles.VehiclesTitle,tblvehicles.id as vid,tblbrands.BrandName,tblbooking.FromDate,tblbooking.ToDate,tblbooking.message,tblbooking.Status,tblvehicles.PricePerDay,DATEDIFF(tblbooking.ToDate,tblbooking.FromDate) as totaldays,tblbooking.BookingNumber
  from tblbooking
  join tblvehicles on tblbooking.VehicleId=tblvehicles.id
  join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand
  where tblvehicles.PostedBy=:userid";
$bookingList = $dbh -> prepare($bookingList);
$bookingList-> bindParam(':userid', $_SESSION['userID'], PDO::PARAM_STR);
$bookingList->execute();
$bookingList = $bookingList->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE HTML>
<html lang="en">
<head>

<title>Rental Drive - Posted Vehicles Booking</title>

<!--stylesheets-->
<?php include('includes/stylesheets.php');?>
<!-- /stylesheets -->

</head>
<body>

<!--Header-->
<?php include('includes/header.php');?>
<!--Page Header-->
<!-- /Header --> 

<!--Page Header-->
<section class="page-header profile_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Posted Vehicles Booking</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="#">Home</a></li>
        <li>Posted Vehicles Booking</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 

<section class="user_profile inner_pages">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-3">
       <?php include('includes/sidebar.php');?>
      </div>
      
      <div class="col-md-8 col-sm-8">
        <div class="profile_wrap">
          <h5 class="uppercase underline">Posted Vehicles Booikngs </h5>
          <div class="my_vehicles_list">
            <ul class="vehicle_listing">
              <?php
                if(count($bookingList) > 0) {
                  foreach($bookingList as $result) {
              ?>
              <li>
                <h4 style="color:red">Booking No #<?php echo htmlentities($result->BookingNumber);?></h4>
                  <div class="vehicle_img">
                    <a href="vehical-details.php?vhid=<?php echo htmlentities($result->vid);?>">
                      <img src="assets/images/vehicles/<?php echo htmlentities($result->Vimage1);?>" alt="image">
                    </a>
                  </div>
                  <div class="vehicle_title">
                    <h6>
                      <a href="vehical-details.php?vhid=<?php echo htmlentities($result->vid);?>">
                        <?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?>
                      </a>
                    </h6>
                    <p>
                      <b>Date: </b> <?php echo htmlentities($result->FromDate);?><b> - </b><?php echo htmlentities($result->ToDate);?>
                    </p>
                    <div style="float: left">
                      <p><b>Message: </b> <?php echo htmlentities($result->message);?> </p>
                      <p><b>Status: </b> <?php if($result->Status==1) { echo 'Confirmed'; } else if($result->Status==2) { echo 'Cancelled'; } else { echo 'Pending'; }?> </p>
                    </div>
                  </div>
                  
                  <?php if($result->Status==1) { ?>
                  
                  <div class="vehicle_status">
                    <a href="car-booking.php?status=cancel&booking=<?php echo $result->BookingNumber ?>" class="btn outline btn-xs">Cancel</a>
                    <div class="clearfix"></div>
                  </div>
                  
                  <?php } else if($result->Status==0) { ?>
                  
                  <div class="vehicle_status">
                    <a href="car-booking.php?status=confirm&booking=<?php echo $result->BookingNumber ?>" class="btn outline btn-xs">Confirm</a>
                    <div class="clearfix"></div>
                  </div>

                  <div class="vehicle_status">
                    <a href="car-booking.php?status=cancel&booking=<?php echo $result->BookingNumber ?>" class="btn outline btn-xs">Cancel</a>
                    <div class="clearfix"></div>
                  </div>
                  
                  <?php } ?>
              </li>

              <hr />

              <?php }}  else { ?>
                <h5 align="center" style="color:red">No booking yet</h5>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/my-vehicles--> 
<?php include('includes/footer.php');?>

<!-- Scripts --> 
<?php include('includes/javascripts.php');?>

</body>
</html>