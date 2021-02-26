<?php 
  session_start();
  include('includes/config.php');
  error_reporting(0);

  if(strlen($_SESSION['login'])==0) { 
    header('location:index.php');
  }

  if (!file_exists('assets/images/vehicles')) {
    mkdir('assets/images/vehicles', 0777, true);
  }

  if(isset($_POST['submit'])) {
    $vehicletitle = $_POST['VehiclesTitle'];
    $brand = $_POST['VehiclesBrand'];
    $vehicleoverview = $_POST['VehiclesOverview'];
    $priceperday = $_POST['PricePerDay'];
    $fueltype = $_POST['FuelType'];
    $modelyear = $_POST['ModelYear'];
    $seatingcapacity = $_POST['SeatingCapacity'];
    $vimage= array('img1' => NULL, 'img2' => NULL, 'img3' => NULL, 'img4' => NULL, 'img5' => NULL);
    $noofowner = $_POST['NoOfOwner'];
    $kmdriven = $_POST['KmDriven'];
    $enginetype = $_POST['EngineType'];
    $enginedescription = $_POST['EngineDescription'];
    $fuelcapacity = $_POST['FuelCapacity'];
    $transmission = $_POST['Transmission'];
    $cylinders = $_POST['Cylinders'];
    $milagecity = $_POST['MileageCity'];
    $mileagehighway = $_POST['MileageHighway'];
    $airconditioner = isset($_POST['AirConditioner']) ? 1 : 0;
    $powerdoorlocks = isset($_POST['PowerDoorLocks']) ? 1 : 0;
    $antilockbrakingsys = isset($_POST['AntiLockBrakingSystem']) ? 1 : 0;
    $brakeassist = isset($_POST['BrakeAssist']) ? 1 : 0;
    $powersteering = isset($_POST['PowerSteering']) ? 1 : 0;
    $driverairbag = isset($_POST['DriverAirbag']) ? 1 : 0;
    $passengerairbag = isset($_POST['PassengerAirbag']) ? 1 : 0;
    $powerwindow = isset($_POST['PowerWindows']) ? 1 : 0;
    $cdplayer = isset($_POST['CDPlayer']) ? 1 : 0;
    $centrallocking = isset($_POST['CentralLocking']) ? 1 : 0;
    $crashcensor = isset($_POST['CrashSensor']) ? 1 : 0;
    $leatherseats = isset($_POST['LeatherSeats']) ? 1 : 0;
    $enginecheckwarning = isset($_POST['EngineCheckWarning']) ? 1 : 0;
    $automaticheadlamps = isset($_POST['AutomaticHeadlamps']) ? 1 : 0;

    if(isset($_FILES['VehicleImages']) && isset($_FILES['VehicleImages']['name'])) {
      $filecounts = count($_FILES['VehicleImages']['name']) > 5 ? 5 : count($_FILES['VehicleImages']['name']);

      for($i=0; $i<=$filecounts; $i++){
        $filenameinfo = pathinfo($_FILES['VehicleImages']['name'][$i]);
        $filename = slugify($filenameinfo['filename']) .'_'. time() .'.'. $filenameinfo['extension'];

        if(move_uploaded_file($_FILES['VehicleImages']['tmp_name'][$i],'assets/images/vehicles/'.$filename)) {
          $number = $i+1; 
          $key = 'img'.$number;
          $vimage[$key] = $filename;
        }
      }

      $sql= "UPDATE tblvehicles SET
            VehiclesTitle = :vehicletitle,
            VehiclesBrand = :brand,
            VehiclesOverview = :vehicleoverview,
            PricePerDay = :priceperday,
            FuelType = :fueltype,
            ModelYear = :modelyear,
            SeatingCapacity = :seatingcapacity,
            Vimage1 = :vimage1,
            Vimage2 = :vimage2,
            Vimage3 = :vimage3,
            Vimage4 = :vimage4,
            Vimage5 = :vimage5,
            NoOfOwner = :noofowner,
            KmDriven = :kmdriven,
            EngineType = :enginetype,
            EngineDescription = :enginedescription,
            FuelCapacity = :fuelcapacity,
            Transmission = :transmission,
            Cylinders = :cylinders,
            MileageCity = :milagecity,
            MileageHighway = :mileagehighway,
            AirConditioner = :airconditioner,
            PowerDoorLocks = :powerdoorlocks,
            AntiLockBrakingSystem = :antilockbrakingsys,
            BrakeAssist = :brakeassist,
            PowerSteering = :powersteering,
            DriverAirbag = :driverairbag,
            PassengerAirbag = :passengerairbag,
            PowerWindows = :powerwindow,
            CDPlayer = :cdplayer,
            CentralLocking = :centrallocking,
            CrashSensor = :crashcensor,
            LeatherSeats = :leatherseats,
            EngineCheckWarning = :enginecheckwarning,
            AutomaticHeadlamps = :automaticheadlamps,
            PostedBy = :postedby
            WHERE id = :vid";
    } else {
      $sql= "UPDATE tblvehicles SET
            VehiclesTitle = :vehicletitle,
            VehiclesBrand = :brand,
            VehiclesOverview = :vehicleoverview,
            PricePerDay = :priceperday,
            FuelType = :fueltype,
            ModelYear = :modelyear,
            SeatingCapacity = :seatingcapacity,
            NoOfOwner = :noofowner,
            KmDriven = :kmdriven,
            EngineType = :enginetype,
            EngineDescription = :enginedescription,
            FuelCapacity = :fuelcapacity,
            Transmission = :transmission,
            Cylinders = :cylinders,
            MileageCity = :milagecity,
            MileageHighway = :mileagehighway,
            AirConditioner = :airconditioner,
            PowerDoorLocks = :powerdoorlocks,
            AntiLockBrakingSystem = :antilockbrakingsys,
            BrakeAssist = :brakeassist,
            PowerSteering = :powersteering,
            DriverAirbag = :driverairbag,
            PassengerAirbag = :passengerairbag,
            PowerWindows = :powerwindow,
            CDPlayer = :cdplayer,
            CentralLocking = :centrallocking,
            CrashSensor = :crashcensor,
            LeatherSeats = :leatherseats,
            EngineCheckWarning = :enginecheckwarning,
            AutomaticHeadlamps = :automaticheadlamps,
            PostedBy = :postedby
            WHERE id = :vid";      
    }

    $query = $dbh->prepare($sql);
    $query->bindParam(':vehicletitle',$vehicletitle,PDO::PARAM_STR);
    $query->bindParam(':brand',$brand,PDO::PARAM_STR);
    $query->bindParam(':vehicleoverview',$vehicleoverview,PDO::PARAM_STR);
    $query->bindParam(':priceperday',$priceperday,PDO::PARAM_STR);
    $query->bindParam(':fueltype',$fueltype,PDO::PARAM_STR);
    $query->bindParam(':modelyear',$modelyear,PDO::PARAM_STR);
    $query->bindParam(':seatingcapacity',$seatingcapacity,PDO::PARAM_STR);
    $query->bindParam(':noofowner',$noofowner,PDO::PARAM_STR);
    $query->bindParam(':kmdriven',$kmdriven,PDO::PARAM_STR);
    $query->bindParam(':enginetype',$enginetype,PDO::PARAM_STR);
    $query->bindParam(':enginedescription',$enginedescription,PDO::PARAM_STR);
    $query->bindParam(':fuelcapacity',$fuelcapacity,PDO::PARAM_STR);
    $query->bindParam(':transmission',$transmission,PDO::PARAM_STR);
    $query->bindParam(':cylinders',$cylinders,PDO::PARAM_STR);
    $query->bindParam(':milagecity',$milagecity,PDO::PARAM_STR);
    $query->bindParam(':mileagehighway',$mileagehighway,PDO::PARAM_STR);
    $query->bindParam(':airconditioner',$airconditioner,PDO::PARAM_STR);
    $query->bindParam(':powerdoorlocks',$powerdoorlocks,PDO::PARAM_STR);
    $query->bindParam(':antilockbrakingsys',$antilockbrakingsys,PDO::PARAM_STR);
    $query->bindParam(':brakeassist',$brakeassist,PDO::PARAM_STR);
    $query->bindParam(':powersteering',$powersteering,PDO::PARAM_STR);
    $query->bindParam(':driverairbag',$driverairbag,PDO::PARAM_STR);
    $query->bindParam(':passengerairbag',$passengerairbag,PDO::PARAM_STR);
    $query->bindParam(':powerwindow',$powerwindow,PDO::PARAM_STR);
    $query->bindParam(':cdplayer',$cdplayer,PDO::PARAM_STR);
    $query->bindParam(':centrallocking',$centrallocking,PDO::PARAM_STR);
    $query->bindParam(':crashcensor',$crashcensor,PDO::PARAM_STR);
    $query->bindParam(':leatherseats',$leatherseats,PDO::PARAM_STR);
    $query->bindParam(':leatherseats',$leatherseats,PDO::PARAM_STR);
    $query->bindParam(':enginecheckwarning',$enginecheckwarning,PDO::PARAM_STR);
    $query->bindParam(':automaticheadlamps',$automaticheadlamps,PDO::PARAM_STR);
    $query->bindParam(':postedby',$_SESSION['userID'],PDO::PARAM_STR);
    $query->bindParam(':vid',$_GET['vid'],PDO::PARAM_STR);
    
    if(isset($_FILES['VehicleImages']) && isset($_FILES['VehicleImages']['name'])) {
      $query->bindParam(':vimage1',$vimage['img1'],PDO::PARAM_STR);
      $query->bindParam(':vimage2',$vimage['img2'],PDO::PARAM_STR);
      $query->bindParam(':vimage3',$vimage['img3'],PDO::PARAM_STR);
      $query->bindParam(':vimage4',$vimage['img4'],PDO::PARAM_STR);
      $query->bindParam(':vimage5',$vimage['img5'],PDO::PARAM_STR);
    }

    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    
    if($lastInsertId)
    {
      $msg="Vehicle posted successfully";
    }
    else 
    {
      $error="Something went wrong. Please try again";
    }
  }

  $vehicleQuery = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid, tblusers.id as ownerid, tblusers.FullName, tblusers.ContactNo, tblusers.EmailId, CONCAT_WS(', ', tblusers.Address, tblusers.City, tblusers.Country ) AS Address  from tblvehicles
                join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand
                join tblusers on tblusers.id=tblvehicles.PostedBy
                where tblvehicles.id=:vid";
  $vehicleQuery = $dbh -> prepare($vehicleQuery);
  $vehicleQuery->bindParam(':vid',$_GET["vid"], PDO::PARAM_STR);
  $vehicleQuery->execute();
  $vehicleDetails = $vehicleQuery->fetch();
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
<style>
  .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
  }
  .succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
  }
</style>
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
        <h1>Editd Vehicle</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="/">Home</a></li>
        <li>Editd Vehicle</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 

<!--Post-vehicle-->
<section class="user_profile inner_pages">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-3">
        <?php include('includes/sidebar.php');?>
      </div>
      
      <div class="col-md-6 col-sm-8">
        <div class="profile_wrap">
          <h5 class="uppercase underline">Editd Vehicle</h5>
          <?php if(isset($msg) && $msg != "") { ?>
            <div class="succWrap">
              <strong>SUCCESS</strong>:<?php echo $msg; ?>
            </div>
         <?php } else if(isset($error) && $error != "") { ?>
            <div class="errorWrap">
              <strong>ERROR</strong>:<?php echo $error; ?>
            </div>
          <?php } ?>
          <form action="#" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label class="control-label">Vehicles Title</label>
              <input class="form-control white_bg" id="VehiclesTitle" value="<?php echo $vehicleDetails['VehiclesTitle'] ?>" name="VehiclesTitle" type="text">
            </div>
            <div class="form-group">
              <label class="control-label">Select Make</label>
              <div class="select">
                <select class="form-control white_bg" name="VehiclesBrand">
                  <option>Select Brand</option>
                  <option value="1">Mercedes-Benz</option>
                  <option value="2">BMW</option>
                  <option value="3">Porsche</option>
                  <option value="4">Nissan</option>
                  <option value="5">Dodge</option>
                  <option value="7">Tesla</option>
                  <option value="8">Audi</option>
                  <option value="9">Toyota</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label">Vehicle Overview  Description</label>
              <textarea class="form-control white_bg" name="VehiclesOverview" rows="5"><?php echo $vehicleDetails['VehiclesOverview'] ?></textarea>
            </div>
            <div class="form-group">
              <label class="control-label">Price ($)</label>
              <input class="form-control white_bg" id="PricePerDay" value="<?php echo $vehicleDetails['PricePerDay'] ?>" name="PricePerDay" type="text">
            </div>
            <div class="form-group">
              <label class="control-label">Upload Images  ( size = 900 x 560, Max 5 )</label>
              <div class="vehicle_images">
                <div class="upload_more_img">
                  <input name="VehicleImages[]" multiple type="file">
                </div>
              </div>
            </div>
            <div class="gray-bg field-title">
              <h6>Basic Info</h6>
            </div>
            <div class="form-group">
              <label class="control-label">Model Year</label>
              <input class="form-control white_bg" id="year" value="<?php echo $vehicleDetails['ModelYear'] ?>" name="ModelYear" type="text">
            </div>
            <div class="form-group"> 
              <label class="control-label">No. of Owners</label>
              <input class="form-control white_bg" id="owners" value="<?php echo $vehicleDetails['NoOfOwner'] ?>" name="NoOfOwner" type="text">
            </div>
            <div class="form-group">
              <label class="control-label">KMs Driven</label>
              <input class="form-control white_bg" id="kws" value="<?php echo $vehicleDetails['KmDriven'] ?>" name="KmDriven" type="text">
            </div>
            <div class="gray-bg field-title">
              <h6>Technical Specification</h6>
            </div>
            <div class="form-group">
              <label class="control-label">Engine Type</label>
              <input class="form-control white_bg" id="engien" value="<?php echo $vehicleDetails['EngineType'] ?>" name="EngineType" type="text">
            </div>
            <div class="form-group">
              <label class="control-label">Engine Description</label>
              <input class="form-control white_bg" id="engien-description" value="<?php echo $vehicleDetails['EngineDescription'] ?>" name="EngineDescription" type="text">
            </div>
            <div class="form-group">
              <label class="control-label">Fuel Type</label>
              <input class="form-control white_bg" id="fuel" value="<?php echo $vehicleDetails['FuelType'] ?>" name="FuelType" type="text">
            </div>
            <div class="form-group">
              <label class="control-label">Fuel Tank Capacity</label>
              <input class="form-control white_bg" id="capacity" value="<?php echo $vehicleDetails['FuelCapacity'] ?>" name="FuelCapacity" type="text">
            </div>
            <div class="form-group">
              <label class="control-label">Transmission Type</label>
              <input class="form-control white_bg" id="Transmission" value="<?php echo $vehicleDetails['Transmission'] ?>" name="Transmission" type="text">
            </div>
            <div class="form-group">
              <label class="control-label">No. of Cylinders</label>
              <input class="form-control white_bg" id="cylinders" value="<?php echo $vehicleDetails['Cylinders'] ?>" name="Cylinders" type="text">
            </div>
            <div class="form-group">
              <label class="control-label">Mileage-City</label>
              <input class="form-control white_bg" id="mileage" value="<?php echo $vehicleDetails['MileageCity'] ?>" name="MileageCity" type="text">
            </div>
            <div class="form-group">
              <label class="control-label">Mileage-Highway</label>
              <input class="form-control white_bg" id="mileage-h" value="<?php echo $vehicleDetails['MileageHighway'] ?>" name="MileageHighway" type="text">
            </div>
            <div class="form-group">
              <label class="control-label">Seating Capacity</label>
              <input class="form-control white_bg" id="s-capacity" value="<?php echo $vehicleDetails['SeatingCapacity'] ?>" name="SeatingCapacity" type="text">
            </div>
            <div class="gray-bg field-title">
              <h6>Accessories</h6>
            </div>
            <div class="vehicle_accessories">
              <div class="form-group checkbox col-md-6 accessories_list">
                <input id="air_conditioner" name="AirConditioner" type="checkbox">
                <label for="air_conditioner">Air Conditioner</label>
              </div>
              <div class="form-group checkbox col-md-6 accessories_list">
                <input id="door" name="PowerDoorLocks" type="checkbox">
                <label for="door">Power Door Locks</label>
              </div>
              <div class="form-group checkbox col-md-6 accessories_list">
                <input id="antiLock" name="AntiLockBrakingSystem" type="checkbox">
                <label for="antiLock">AntiLock Braking System (ABS)</label>
              </div>
              <div class="form-group checkbox col-md-6 accessories_list">
                <input id="brake" name="BrakeAssist" type="checkbox">
                <label for="brake">Brake Assist</label>
              </div>
              <div class="form-group checkbox col-md-6 accessories_list">
                <input id="steering" name="PowerSteering" type="checkbox">
                <label for="steering">Power Steering</label>
              </div>
              <div class="form-group checkbox col-md-6 accessories_list">
                <input id="airbag" name="DriverAirbag" type="checkbox">
                <label for="airbag">Driver Airbag</label>
              </div>
              <div class="form-group checkbox col-md-6 accessories_list">
                <input id="windows" name="PowerWindows" type="checkbox">
                <label for="windows">Power Windows</label>
              </div>
              <div class="form-group checkbox col-md-6 accessories_list">
                <input id="passenger_airbag" name="PassengerAirbag" type="checkbox">
                <label for="passenger_airbag">Passenger Airbag</label>
              </div>
              <div class="form-group checkbox col-md-6 accessories_list">
                <input id="player" name="CDPlayer" type="checkbox">
                <label for="player">CD Player</label>
              </div>
              <div class="form-group checkbox col-md-6 accessories_list">
                <input id="sensor" name="CrashSensor" type="checkbox">
                <label for="sensor">Crash Sensor</label>
              </div>
              <div class="form-group checkbox col-md-6 accessories_list">
                <input id="seats" name="LeatherSeats" type="checkbox">
                <label for="seats">Leather Seats</label>
              </div>
              <div class="form-group checkbox col-md-6 accessories_list">
                <input id="locking" name="CentralLocking" type="checkbox">
                <label for="locking">Central Locking</label>
              </div>
              <div class="form-group checkbox col-md-6 accessories_list">
                <input id="engine_warning" name="EngineCheckWarning" type="checkbox">
                <label for="engine_warning">Engine Check Warning</label>
              </div>
              <div class="form-group checkbox col-md-6 accessories_list">
                <input id="headlamps" name="AutomaticHeadlamps" type="checkbox">
                <label for="headlamps">Automatic Headlamps</label>
              </div>
            </div>
            <div class="form-group">
              <button type="submit" name="submit" class="btn">Submit Vehicle <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/Post-vehicle--> 

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