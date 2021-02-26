<?php 
session_start();
include('includes/config.php');
error_reporting(0);

$vehicleListingQuery = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid
      from tblvehicles
      join tblbrands on tblbrands.id = tblvehicles.VehiclesBrand
      WHERE tblvehicles.IsDeleted = 0
      AND tblvehicles.DisplayStatus = 1";
$vehicleList = $dbh -> prepare($vehicleListingQuery);
$vehicleList->execute();
$vehicles = $vehicleList->fetchAll(PDO::FETCH_OBJ);
$totalVehicles = $vehicleList->rowCount();
?>

<!DOCTYPE HTML>
<html lang="en">
<head>

<title>Rental Drive | Car Listing</title>

<!--stylesheets-->
<?php include('includes/stylesheets.php');?>
<!-- /stylesheets -->

</head>
<body>

<!--Header--> 
<?php include('includes/header.php');?>
<!-- /Header --> 

<!--Page Header-->
<section class="page-header listing_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Car Listing</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li>Car Listing</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 

<!--Listing-->
<section class="listing-page">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-md-push-3">
    <div class="mobile_search">
     <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-filter" aria-hidden="true"></i> Find Your Dream Car </h5>
          </div>
          <div class="sidebar_filter">
            <form action="#" method="get">
              <div class="form-group select">
                <select class="form-control">
                  <option>Select Location</option>
                  <option>Location 1</option>
                  <option>Location 2</option>
                  <option>Location 3</option>
                  <option>Location 4</option>
                </select>
              </div>
              <div class="form-group select">
                <select class="form-control">
                  <option>Select Brand</option>
                  <option>Brand 1</option>
                  <option>Brand 2</option>
                  <option>Brand 3</option>
                  <option>Brand 4</option>
                </select>
              </div>
              <div class="form-group select">
                <select class="form-control">
                  <option>Select Model</option>
                  <option>Series 1</option>
                  <option>Series 2</option>
                  <option>Series 3</option>
                  <option>Series 4</option>
                </select>
              </div>
              <div class="form-group select">
                <select class="form-control">
                  <option>Year of Model </option>
                  <option>2016</option>
                  <option>2015</option>
                  <option>2014</option>
                  <option>2013</option>
                </select>
              </div>
              <div class="form-group select">
                <select class="form-control">
                  <option>Type of Car </option>
                  <option>New Car</option>
                  <option>Used Car</option>
                </select>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Search Car</button>
              </div>
            </form>
          </div>
        </div>
     </div>
        <div class="result-sorting-wrapper">
          <div class="sorting-count">
            <p>1 - 12 <span>of <?php echo $totalVehicles ?> Results for your search.</span></p>
          </div>
          <div class="result-sorting-by">
            <p>Sort by:</p>
            <form action="#" method="post">
              <div class="form-group select sorting-select">
                <select class="form-control ">
                  <option>Price (low to high)</option>
                  <option>Price (high to low)</option>
                  <option>Newest Items</option>
                </select>
              </div>
            </form>
          </div>
        </div>
        <div class="row">
          <?php foreach($vehicles as $result) { ?>
            <div class="col-md-4 grid_listing">
              <div class="product-listing-m gray-bg">
                <div class="product-listing-img">
                  <a href="car-details.php?vhid=<?php echo htmlentities($result->id);?>">
                    <img src="assets/images/vehicles/<?php echo htmlentities($result->Vimage1);?>" class="img-fluid"/>
                  </a>
                </div>
                <div class="product-listing-content">
                  <h5>
                    <a href="car-details.php?vhid=<?php echo htmlentities($result->id);?>">
                      <?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?>
                    </a>
                  </h5>
                  <p class="list-price">$<?php echo htmlentities($result->PricePerDay);?> Per Day</p>
                  <ul class="features_list">
                    <li><i class="fa fa-road" aria-hidden="true"></i><?php echo htmlentities($result->KmDriven);?> KM</li>
                    <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity);?> seats</li>
                    <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->ModelYear);?> model</li>
                    <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->FuelType);?></li>
                  </ul>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
        <div class="pagination">
          <ul>
            <li class="current">1</li>
          </ul>
        </div>
      </div> 
    </div>
  </div>
</section>
<!-- /Listing--> 

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
