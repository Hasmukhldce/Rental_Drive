<?php 
session_start();
include('includes/config.php');
error_reporting(1);

$vhid = intval($_GET['vhid']);

if(isset($_POST['submit'])) {
  $fromdate = $_POST['fromdate'];
  $todate = $_POST['todate']; 
  $message = $_POST['message'];
  $useremail = $_SESSION['login'];
  $status = 0;
  $currentBooking = "SELECT * FROM tblbooking 
                    where (
                      :fromdate BETWEEN date(FromDate) and date(ToDate) ||
                      :todate BETWEEN date(FromDate) and date(ToDate) ||
                      date(FromDate) BETWEEN :fromdate and :todate
                    )
                    and VehicleId=:vhid";
  $currentBooking = $dbh -> prepare($currentBooking);
  $currentBooking->bindParam(':vhid',$vhid, PDO::PARAM_STR);
  $currentBooking->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
  $currentBooking->bindParam(':todate',$todate,PDO::PARAM_STR);
  $currentBooking->execute();
  
  if($currentBooking->rowCount()==0) {
    $newBooking="INSERT INTO  tblbooking(BookingNumber, userEmail,VehicleId,FromDate,ToDate,message,Status)
                  VALUES(:bookingnumber, :useremail,:vhid,:fromdate,:todate,:message,:status)";
    $newBooking = $dbh->prepare($newBooking);
    $newBooking->bindParam(':bookingnumber',time(),PDO::PARAM_STR);
    $newBooking->bindParam(':useremail',$useremail,PDO::PARAM_STR);
    $newBooking->bindParam(':vhid',$vhid,PDO::PARAM_STR);
    $newBooking->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
    $newBooking->bindParam(':todate',$todate,PDO::PARAM_STR);
    $newBooking->bindParam(':message',$message,PDO::PARAM_STR);
    $newBooking->bindParam(':status', $status,PDO::PARAM_STR);
    $newBooking->execute();
    $lastInsertId = $dbh->lastInsertId();
    
    if($lastInsertId) {
      echo "<script>alert('Booking successfull.');</script>";
      echo "<script type='text/javascript'> document.location = 'my-booking.php'; </script>";
    } else  {
      echo "<script>alert('Something went wrong. Please try again');</script>";
      echo "<script type='text/javascript'> document.location = 'car-listing.php'; </script>";
    }
  }  else{
    echo "<script>alert('Car already booked for these days');</script>"; 
    echo "<script type='text/javascript'> document.location = 'car-listing.php'; </script>";
  }
}

$vehicleQuery = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid, tblusers.id as ownerid, tblusers.FullName, tblusers.ContactNo, tblusers.EmailId, CONCAT_WS(', ', tblusers.Address, tblusers.City, tblusers.Country ) AS Address  from tblvehicles
                join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand
                join tblusers on tblusers.id=tblvehicles.PostedBy
                where tblvehicles.id=:vhid";
$vehicleQuery = $dbh -> prepare($vehicleQuery);
$vehicleQuery->bindParam(':vhid',$vhid, PDO::PARAM_STR);
$vehicleQuery->execute();
$vehicleDetails = $vehicleQuery->fetch();

//dd($vehicleDetails, 1);
?>

<!DOCTYPE HTML>
<html lang="en">
<head>

<title>Rental Drive | Car Details</title>

<!--stylesheets-->
<?php include('includes/stylesheets.php');?>
<!-- /stylesheets -->

</head>
<body>

<!--Header--> 
<?php include('includes/header.php');?>
<!-- /Header --> 

<!--Listing-Image-Slider-->
<section id="listing_img_slider">
  <?php
    if(isset($vehicleDetails["Vimage1"])) {
      echo '<div>
              <img src="assets/images/vehicles/'. $vehicleDetails["Vimage1"] .'" class="img-fluid">
            </div>';
    }

    if(isset($vehicleDetails["Vimage2"])) {
      echo '<div>
              <img src="assets/images/vehicles/'. $vehicleDetails["Vimage2"] .'" class="img-fluid">
            </div>';
    }

    if(isset($vehicleDetails["Vimage3"])) {
      echo '<div>
              <img src="assets/images/vehicles/'. $vehicleDetails["Vimage3"] .'" class="img-fluid">
            </div>';
    }

    if(isset($vehicleDetails["Vimage4"])) {
      echo '<div>
              <img src="assets/images/vehicles/'. $vehicleDetails["Vimage4"] .'" class="img-fluid">
            </div>';
    }

    if(isset($vehicleDetails["Vimage5"])) {
      echo '<div>
              <img src="assets/images/vehicles/'. $vehicleDetails["Vimage5"] .'" class="img-fluid">
            </div>';
    }
  ?>
</section>
<!--/Listing-Image-Slider-->

<!--Listing-detail-->
<section class="listing-detail">
  <div class="container">
    <div class="listing_detail_head row">
      <div class="col-md-9">
        <h2><?php echo $vehicleDetails["BrandName"].' '. $vehicleDetails["VehiclesTitle"].' '. $vehicleDetails["ModelYear"] ?></h2>
        <div class="car-location">
          <span>
            <i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $vehicleDetails["Address"] ?>
          </span>
        </div>
      </div>
      <div class="col-md-3">
        <div class="price_info">
          <p>$<?php echo $vehicleDetails["PricePerDay"] ?> <small>per day</small></p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9">
        <div class="main_features">
          <ul>
            <li> <i class="fa fa-tachometer" aria-hidden="true"></i>
              <h5><?php echo $vehicleDetails["KmDriven"] ?></h5>
              <p>Total Kilometres</p>
            </li>
            <li> <i class="fa fa-calendar" aria-hidden="true"></i>
              <h5><?php echo $vehicleDetails["ModelYear"] ?></h5>
              <p>Model Year</p>
            </li>
            <li> <i class="fa fa-cogs" aria-hidden="true"></i>
              <h5><?php echo $vehicleDetails["FuelType"] ?></h5>
              <p>Fuel Type</p>
            </li>
            <li> <i class="fa fa-power-off" aria-hidden="true"></i>
              <h5><?php echo $vehicleDetails["Transmission"] ?></h5>
              <p>Transmission</p>
            </li>
            <li> <i class="fa fa-superpowers" aria-hidden="true"></i>
              <h5><?php echo $vehicleDetails["EngineType"] ?></h5>
              <p>Engine Type</p>
            </li>
            <li> <i class="fa fa-user-plus" aria-hidden="true"></i>
              <h5><?php echo $vehicleDetails["SeatingCapacity"] ?></h5>
              <p>Seats</p>
            </li>
          </ul>
        </div>
        <div class="listing_more_info">
          <div class="listing_detail_wrap"> 
            <!-- Nav tabs -->
            <ul class="nav nav-tabs gray-bg" role="tablist">
              <li role="presentation"><a class="active" href="#vehicle-overview " aria-controls="vehicle-overview" role="tab" data-toggle="tab">Vehicle Overview </a></li>
              <li role="presentation"><a href="#specification" aria-controls="specification" role="tab" data-toggle="tab">Technical Specification</a></li>
              <li role="presentation"><a href="#accessories" aria-controls="accessories" role="tab" data-toggle="tab">Accessories</a></li>
            </ul>
            
            <!-- Tab panes -->
            <div class="tab-content"> 
              <!-- vehicle-overview -->
              <div role="tabpanel" class="tab-pane active" id="vehicle-overview">
                <p><?php echo $vehicleDetails["VehiclesOverview"] ?></p>
              </div>
              
              <!-- Technical-Specification -->
              <div role="tabpanel" class="tab-pane" id="specification">
                <div class="table-responsive"> 
                  <!--Basic-Info-Table-->
                  <table>
                    <thead>
                      <tr>
                        <th colspan="2">BASIC INFO</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Model Year</td>
                        <td><?php echo $vehicleDetails["ModelYear"] ?></td>
                      </tr>
                      <tr>
                        <td>No. of Owners</td>
                        <td><?php echo $vehicleDetails["NoOfOwner"] ?></td>
                      </tr>
                      <tr>
                        <td>KMs Driven</td>
                        <td><?php echo $vehicleDetails["KmDriven"] ?></td>
                      </tr>
                      <tr>
                        <td>Fuel Type</td>
                        <td><?php echo $vehicleDetails["FuelType"] ?></td>
                      </tr>
                    </tbody>
                  </table>
                  
                  <!--Technical-Specification-Table-->
                  <table>
                    <thead>
                      <tr>
                        <th colspan="2">Technical Specification</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Engine Type</td>
                        <td><?php echo $vehicleDetails["EngineType"] ?></td>
                      </tr>
                      <tr>
                        <td>Engine Description</td>
                        <td><?php echo $vehicleDetails["EngineDescription"] ?></td>
                      </tr>
                      <tr>
                        <td>No. of Cylinders</td>
                        <td><?php echo $vehicleDetails["Cylinders"] ?></td>
                      </tr>
                      <tr>
                        <td>Mileage-City</td>
                        <td><?php echo $vehicleDetails["MileageCity"] ?></td>
                      </tr>
                      <tr>
                        <td>Mileage-Highway</td>
                        <td><?php echo $vehicleDetails["MileageHighway"] ?></td>
                      </tr>
                      <tr>
                        <td>Fuel Tank Capacity</td>
                        <td><?php echo $vehicleDetails["FuelCapacity"] ?></td>
                      </tr>
                      <tr>
                        <td>Seating Capacity</td>
                        <td><?php echo $vehicleDetails["SeatingCapacity"] ?></td>
                      </tr>
                      <tr>
                        <td>Transmission Type</td>
                        <td><?php echo $vehicleDetails["Transmission"] ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              
              <!-- Accessories -->
              <div role="tabpanel" class="tab-pane" id="accessories"> 
                <!--Accessories-->
                <table>
                  <thead>
                    <tr>
                      <th colspan="2">Accessories</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Air Conditioner</td>
                      <td>
                        <?php
                          if($vehicleDetails["AirConditioner"] == 1) {
                            echo '<i class="fa fa-check" aria-hidden="true">';
                          } else {
                            echo '<i class="fa fa-close" aria-hidden="true">';
                          }
                        ?>
                        </i>
                      </td>
                    </tr>
                    <tr>
                      <td>AntiLock Braking System</td>
                      <td>
                        <?php
                          if($vehicleDetails["AntiLockBrakingSystem"] == 1) {
                            echo '<i class="fa fa-check" aria-hidden="true">';
                          } else {
                            echo '<i class="fa fa-close" aria-hidden="true">';
                          }
                        ?>
                        </i>
                      </td>
                    </tr>
                    <tr>
                      <td>Power Steering</td>
                      <td>
                        <?php
                          if($vehicleDetails["PowerSteering"] == 1) {
                            echo '<i class="fa fa-check" aria-hidden="true">';
                          } else {
                            echo '<i class="fa fa-close" aria-hidden="true">';
                          }
                        ?>
                        </i>
                      </td>
                    </tr>
                    <tr>
                      <td>Power Windows</td>
                      <td>
                        <?php
                          if($vehicleDetails["PowerWindows"] == 1) {
                            echo '<i class="fa fa-check" aria-hidden="true">';
                          } else {
                            echo '<i class="fa fa-close" aria-hidden="true">';
                          }
                        ?>
                        </i>
                      </td>
                    </tr>
                    <tr>
                      <td>CD Player</td>
                      <td>
                        <?php
                          if($vehicleDetails["CDPlayer"] == 1) {
                            echo '<i class="fa fa-check" aria-hidden="true">';
                          } else {
                            echo '<i class="fa fa-close" aria-hidden="true">';
                          }
                        ?>
                        </i>
                      </td>
                    </tr>
                    <tr>
                      <td>Leather Seats</td>
                      <td>
                        <?php
                          if($vehicleDetails["LeatherSeats"] == 1) {
                            echo '<i class="fa fa-check" aria-hidden="true">';
                          } else {
                            echo '<i class="fa fa-close" aria-hidden="true">';
                          }
                        ?>
                        </i>
                      </td>
                    </tr>
                    <tr>
                      <td>Central Locking</td>
                      <td>
                        <?php
                          if($vehicleDetails["CentralLocking"] == 1) {
                            echo '<i class="fa fa-check" aria-hidden="true">';
                          } else {
                            echo '<i class="fa fa-close" aria-hidden="true">';
                          }
                        ?>
                        </i>
                      </td>
                    </tr>
                    <tr>
                      <td>Power Door Locks</td>
                      <td>
                        <?php
                          if($vehicleDetails["PowerDoorLocks"] == 1) {
                            echo '<i class="fa fa-check" aria-hidden="true">';
                          } else {
                            echo '<i class="fa fa-close" aria-hidden="true">';
                          }
                        ?>
                        </i>
                      </td>
                    </tr>
                    <tr>
                      <td>Brake Assist</td>
                      <td>
                        <?php
                          if($vehicleDetails["BrakeAssist"] == 1) {
                            echo '<i class="fa fa-check" aria-hidden="true">';
                          } else {
                            echo '<i class="fa fa-close" aria-hidden="true">';
                          }
                        ?>
                        </i>
                      </td>
                    </tr>
                    <tr>
                      <td>Driver Airbag</td>
                      <td>
                        <?php
                          if($vehicleDetails["DriverAirbag"] == 1) {
                            echo '<i class="fa fa-check" aria-hidden="true">';
                          } else {
                            echo '<i class="fa fa-close" aria-hidden="true">';
                          }
                        ?>
                        </i>
                      </td>
                    </tr>
                    <tr>
                      <td>Passenger Airbag</td>
                      <td>
                        <?php
                          if($vehicleDetails["PassengerAirbag"] == 1) {
                            echo '<i class="fa fa-check" aria-hidden="true">';
                          } else {
                            echo '<i class="fa fa-close" aria-hidden="true">';
                          }
                        ?>
                        </i>
                      </td>
                    </tr>
                    <tr>
                      <td>Crash Sensor</td>
                      <td>
                        <?php
                          if($vehicleDetails["CrashSensor"] == 1) {
                            echo '<i class="fa fa-check" aria-hidden="true">';
                          } else {
                            echo '<i class="fa fa-close" aria-hidden="true">';
                          }
                        ?>
                        </i>
                      </td>
                    </tr>
                    <tr>
                      <td>Engine Check Warning</td>
                      <td>
                        <?php
                          if($vehicleDetails["EngineCheckWarning"] == 1) {
                            echo '<i class="fa fa-check" aria-hidden="true">';
                          } else {
                            echo '<i class="fa fa-close" aria-hidden="true">';
                          }
                        ?>
                        </i>
                      </td>
                    </tr>
                    <tr>
                      <td>Automatic Headlamps</td>
                      <td>
                        <?php
                          if($vehicleDetails["AutomaticHeadlamps"] == 1) {
                            echo '<i class="fa fa-check" aria-hidden="true">';
                          } else {
                            echo '<i class="fa fa-close" aria-hidden="true">';
                          }
                        ?>
                        </i>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        
          <!--Comment-Form-->
          <div class="comment_form">
            <h6>Leave a Comment</h6>
            <form action="#">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Full Name">
              </div>
              <div class="form-group">
                <input type="email" class="form-control" placeholder="Email Address">
              </div>
              <div class="form-group">
                <textarea rows="5" class="form-control" placeholder="Comments"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" class="btn" value="Submit Comment">
              </div>
            </form>
          </div>
          <!--/Comment-Form--> 
          
        </div>
   
      </div>
      
      <!--Side-Bar-->
      <aside class="col-md-3">
        <div class="add_compare">
          <button type="button" class="btn btn-block" data-toggle="modal" data-target="#make_offer"> <i class="fa fa-money" aria-hidden="true"></i> Book Now </button>
        </div>
        <div class="share_vehicle">
          <p>Share: <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a> </p>
        </div>        
        
        <div class="sidebar_widget">
            <div class="widget_heading">
              <h5><i class="fa fa-address-card-o" aria-hidden="true"></i> Owner Contact </h5>
            </div>
            <div class="dealer_detail">
              <p><span>Name:</span> <?php echo $vehicleDetails["FullName"] ?></p>
              <p><span>Email:</span> <?php echo $vehicleDetails["EmailId"] ?></p>
              <p><span>Phone:</span> <?php echo $vehicleDetails["ContactNo"] ?></p>
          </div>
        </div>

        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-envelope" aria-hidden="true"></i>Book Now</h5>
          </div>
          <form method="post">
            <div class="form-group">
              <label>From Date:</label>
              <input type="date" class="form-control" name="fromdate" placeholder="From Date" required>
            </div>
            <div class="form-group">
              <label>To Date:</label>
              <input type="date" class="form-control" name="todate" placeholder="To Date" required>
            </div>
            <div class="form-group">
              <textarea rows="4" class="form-control" name="message" placeholder="Message" required></textarea>
            </div>
            
            <?php if($_SESSION['login']) { ?>
              <div class="form-group">
                <input type="submit" class="btn"  name="submit" value="Book Now">
              </div>
            <?php } else { ?>
              <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login For Book</a>
            <?php } ?>
          </form>
        </div>
      </aside>
      <!--/Side-Bar--> 
    </div>
    
    <div class="space-20"></div>
    
  </div>
</section>
<!--/Listing-detail--> 

<!--Make a booking -->
<div class="modal fade" id="make_offer">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Make a booking</h3>
      </div>
      <div class="modal-body">
        <form action="#" method="get">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Full Name">
          </div>
          <div class="form-group">
            <input type="email" class="form-control" placeholder="Email Address">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Phone Number">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Offer Price">
          </div>
          <div class="form-group">
            <textarea class="form-control" placeholder="Message"></textarea>
          </div>
          <div class="form-group">
            <input type="submit" value="Submit Query" class="btn btn-block">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--/Make a booking --> 

<!-- Chat with owner -->
<div class="modal fade" id="email_friend">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Chat with owner</h3>
      </div>
      <div class="modal-body">
        <form action="#" method="get">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Your Name">
          </div>
          <div class="form-group">
            <input type="email" class="form-control" placeholder="Your Email Address">
          </div>
          <div class="form-group">
            <input type="email" class="form-control" placeholder="Friend Email Address">
          </div>
          <div class="form-group">
            <textarea rows="4" class="form-control" placeholder="Message"></textarea>
          </div>
          <div class="form-group">
            <input type="submit" value="Submit Query" class="btn btn-block">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--/ Chat with owner --> 

<!--Request-More-Info -->
<div class="modal fade" id="more_info">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Request More Info</h3>
      </div>
      <div class="modal-body">
        <form action="#" method="get">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Full Name">
          </div>
          <div class="form-group">
            <input type="email" class="form-control" placeholder="Email Address">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Phone Number">
          </div>
          <div class="form-group">
            <textarea rows="4" class="form-control" placeholder="Message"></textarea>
          </div>
          <div class="form-group">
            <input type="submit" value="Submit Query" class="btn btn-block">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--/Request-More-Info --> 

<!--Footer -->
<?php include('includes/footer.php');?>
<!-- /Footer--> 

<!--Back to top-->
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top--> 

<!--Login-Form -->
<?php include('includes/login.php');?>
<!--/Login-Form --> 

<!--Register-Form -->
<?php include('includes/registration.php');?>

<!--/Register-Form --> 

<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php');?>

<!-- Scripts --> 
<?php include('includes/javascripts.php');?>

</body>
</html>
