<!--Header-->
<header class="header_style2 nav-stacked affix-top" data-spy="affix" data-offset-top="1">
  <!-- Navigation -->
  <nav id="navigation_bar" class="navbar navbar-expand-lg">
    <div class="container">
  <div class="row header-row">
      <div class="navbar-header">
        <div class="logo"> <a href="index.php"><img src="assets/images/logo.png" alt="image"/></a> </div>
    
        <button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse" class="navbar-toggler" type="button"> 
          <i class="fa fa-bars"></i>
        </button>
      </div>
      <div class="collapse navbar-collapse" id="navigation">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home</a></li>
          <li><a href="about-us.php">About Us</a></li>
          <li><a href="car-listing.php">Car Listing</a>
          <li><a href="faqs.php">FAQs</a></li>
          <li><a href="contact-us.php">Contact Us</a></li>
        </ul>
      </div>
      
      <div class="header_wrap">
        <?php if(strlen($_SESSION['login']) > 1) { ?>
          <div class="user_login">
            <ul>
              <li class="dropdown"> <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i></a>
                <ul class="dropdown-menu">
                  <li><a href="profile.php">Profile Settings</a></li>
                  <li><a href="my-vehicles.php">Posted Vehicles</a></li>
                  <li><a href="post-vehicle.php">Post a Vehicle</a></li>
                  <li><a href="car-booking.php">Vehicle Bookings</a></li>
                  <li><a href="my-booking.php">My Bookings</a></li>
                  <li><a href="logout.php">Sign Out</a></li>
                </ul>
              </li>
            </ul>
          </div>
        <?php } else { ?>
          <div class="login_btn"> <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login / Register</a> </div>
        <?php } ?>
      </div>
      </div>
    </div>
  </nav>
  <!-- Navigation end --> 
  
</header>
<!-- /Header --> 