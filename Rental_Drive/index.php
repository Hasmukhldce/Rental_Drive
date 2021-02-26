<?php 
  session_start();
  include('includes/config.php');
  error_reporting(0);
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

<!--Banner-->
<section id="banner2">
  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
     <!-- Wrapper for slides -->
     <div class="carousel-inner">
          <!--item-1-->
        <div class="item carousel-item active">
              <img src="assets/images/banner-image-1.jpg" class="img-fluid" alt="image">
              <div class="carousel-caption">
                <div class="banner_text text-center div_zindex white-text">
                        <h1>Looking for car rental</h1>
                        <h3>More than a thousand cars for you to choose. </h3>
                        <a href="car-listing.php" class="btn">View All Cars</a>
                    </div>
              </div>
          </div>
        
          <!--item-2-->
        <div class="item carousel-item">
              <img src="assets/images/banner-image-2.jpg" alt="image" class="img-fluid">
              <div class="carousel-caption">
                <div class="banner_text text-center div_zindex white-text">
                        <h1>Earn extra money, Rent your car</h1>
                        <h3>More than a thousand users who need car for rent. </h3>
                        <a href="#signupform" class="btn" data-toggle="modal" data-dismiss="modal">Join Rental Drive</a>
                    </div>
              </div>
          </div>
     </div>

          <!-- Controls -->
          <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </a>
          <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="carousel-control-next-icon"></span>
          </a>
    </div>
</section>
<!--/Banner-->


<!-- Filter-Form -->
<section id="filter_form2">
  <div class="container">
    <div class="main_bg white-text">
        <h3>Find a car that suits you best</h3>
        
          <form action="#" method="get">
      <div class="row">
            <div class="form-group col-md-4 col-sm-6">
              <div class="select">
                <select class="form-control">
                  <option value="">Select Location </option>
                  <option value="">Location 1 </option>
                  <option value="">Location 1 </option>
                </select>
              </div>
            </div>
            <div class="form-group col-md-4 col-sm-6">
              <div class="select">
                <select class="form-control">
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
            <div class="form-group col-md-4 col-sm-6">
              <div class="select">
                <select class="form-control">
                  <option>Select Model</option>
                  <option>Series 1</option>
                  <option>Series 2</option>
                  <option>Series 3</option>
                </select>
              </div>
            </div>
            <div class="form-group col-md-4 col-sm-6">
              <div class="select">
                <select class="form-control">
                  <option>Year of Model </option>
                  <option>2016</option>
                  <option>2015</option>
                  <option>2014</option>
                </select>
              </div>
            </div>
            <div class="form-group col-md-4 col-sm-6">
              <div class="select">
                <select class="form-control">
                  <option>Type of Car </option>
                  <option>New Car</option>
                  <option>Used Car</option>
                </select>
              </div>
            </div>
            <div class="form-group col-md-4 col-sm-6">
              <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Search Car </button>
            </div>
      </div>
          </form>
        
    </div>
  </div>
</section>
<!-- /Filter-Form --> 


<!--About-us-->
<section id="about_us" class="section-padding">
  <div class="container">
      <div class="section-header text-center">
          <h2>Welcome to Rental Drive</h2>
            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. </p>
        </div>
        
        <div class="row">
          <div class="col-md-3 col-sm-6">
              <div class="about_info">
                    <div class="icon_box">
                        <i class="fa fa-money" aria-hidden="true"></i>
                    </div>
                    <h5>Best Price</h5>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6">
              <div class="about_info">
                    <div class="icon_box">
                        <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                    </div>
                    <h5>Endless options</h5>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6">
              <div class="about_info">
                    <div class="icon_box">
                        <i class="fa fa-history" aria-hidden="true"></i>
                    </div>
                    <h5>Free Support</h5>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6">
              <div class="about_info">
                    <div class="icon_box">
                        <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                    <h5>Professional Dealers</h5>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/About-us-->

<!--Fan-Fact-->
<section id="fun-facts" class="dark-bg vc_row">
    <div class=" col-md-6 vc_col section-padding">
        <div class="fact_m white-text">
            <h2>About Rental Drive</h2>
            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. </p>
    
            <ul>
                <li>
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <h2>50+</h2>
                    <p>Locations</p>                    
                </li>
                
                <li>
                    <i class="fa fa-car" aria-hidden="true"></i>
                    <h2>50+</h2>
                    <p>Brands</p>                    
                </li>
                
                <li>
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                    <h2>500+</h2>
                    <p>Renters</p>                    
                </li>
                
                <li>
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                    <h2>500+</h2>
                    <p>Satisfied Customers</p>        
                </li>
            </ul>
        </div>
    </div>
  <div class=" col-md-6 vc_col section-padding">
      <div class="facts_section_bg"></div>
  </div>
</section>
<!--/Fan-fact-->

<!--Featured Car-->
<section class="section-padding">
  <div class="container">
    <div class="section-header text-center">
      <h2>Featured  Cars Special Offers</h2>
      <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. </p>
    </div>
    <div class="row">
      <div class="col-list-3">
        <div class="featured-car-list">
          <div class="featured-car-img"> <a href="#"><img src="assets/images/featured-img-1.jpg" class="img-fluid" alt="Image"></a>
          </div>
          <div class="featured-car-content">
            <h6><a href="#">Maserati QUATTROPORTE 1,6</a></h6>
            <div class="price_info">
              <p class="featured-price">$90,000</p>
              <div class="car-location"><span><i class="fa fa-map-marker" aria-hidden="true"></i> Colorado, USA</span></div>
            </div>
            <ul>
              <li><i class="fa fa-road" aria-hidden="true"></i>0,000 km</li>
              <li><i class="fa fa-tachometer" aria-hidden="true"></i>30.000 miles</li>
              <li><i class="fa fa-calendar" aria-hidden="true"></i>2005 model</li>
              <li><i class="fa fa-car" aria-hidden="true"></i>Diesel</li>
              <li><i class="fa fa-user" aria-hidden="true"></i>5 seats</li>
              <li><i class="fa fa-superpowers" aria-hidden="true"></i>143 kW</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-list-3">
        <div class="featured-car-list">
          <div class="featured-car-img"> <a href="#"><img src="assets/images/featured-img-2.jpg" class="img-fluid" alt="Image"></a>
          </div>
          <div class="featured-car-content">
            <h6><a href="#">Mazda CX-5 SX, V6, ABS, Sunroof</a></h6>
            <div class="price_info">
              <p class="featured-price">$90,000</p>
              <div class="car-location"><span><i class="fa fa-map-marker" aria-hidden="true"></i> Colorado, USA</span></div>
            </div>
            <ul>
              <li><i class="fa fa-road" aria-hidden="true"></i>0,000 km</li>
              <li><i class="fa fa-tachometer" aria-hidden="true"></i>30.000 miles</li>
              <li><i class="fa fa-calendar" aria-hidden="true"></i>2005 model</li>
              <li><i class="fa fa-car" aria-hidden="true"></i>Diesel</li>
              <li><i class="fa fa-user" aria-hidden="true"></i>5 seats</li>
              <li><i class="fa fa-superpowers" aria-hidden="true"></i>143 kW</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-list-3">
        <div class="featured-car-list">
          <div class="featured-car-img"> <a href="#"><img src="assets/images/featured-img-3.jpg" class="img-fluid" alt="Image"></a>
          </div>
          <div class="featured-car-content">
            <h6><a href="#">BMW 535i</a></h6>
            <div class="price_info">
              <p class="featured-price">$90,000</p>
              <div class="car-location"><span><i class="fa fa-map-marker" aria-hidden="true"></i> Colorado, USA</span></div>
            </div>
            <ul>
              <li><i class="fa fa-road" aria-hidden="true"></i>0,000 km</li>
              <li><i class="fa fa-tachometer" aria-hidden="true"></i>30.000 miles</li>
              <li><i class="fa fa-calendar" aria-hidden="true"></i>2005 model</li>
              <li><i class="fa fa-car" aria-hidden="true"></i>Diesel</li>
              <li><i class="fa fa-user" aria-hidden="true"></i>5 seats</li>
              <li><i class="fa fa-superpowers" aria-hidden="true"></i>143 kW</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /Featured Car--> 


<!-- Services -->
<section id="our_services" class="dark-bg vc_row">
  <div class="col-md-6 vc_col section-padding">
      <div class="facts_section_bg"></div>
  </div>
    
    <div class=" col-md-6 vc_col section-padding">
        <div class="our_services white-text">
            <h2>Our Services</h2>
            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised 
            words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing 
            hidden in the middle of text. </p>
            <!--Services-info-->
            <div class="services_info">
                <div class="icon_box">
                    <i class="fa fa-car" aria-hidden="true"></i>
                </div>
                <h4><a href="#">Rental Car</a></h4>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered.</p>
            </div>
            
            <!--Services-info-->
            <div class="services_info">
                <div class="icon_box">
                    <i class="fa fa-money" aria-hidden="true"></i>
                </div>
                <h4><a href="#">Earn Money</a></h4>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered.</p>
            </div>
        </div>
    </div>
</section>
<!-- /Services -->


<!--Testimonial -->
<section id="testimonial" class="section-padding">
  <div class="container div_zindex">
    <div class="section-header text-center">
      <h2>Our Testimonial</h2>
      <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. </p>
    </div>
    <div class="row">
      <div id="testimonial-slider-2">
           <div class="testimonial_wrap">
               <div class="testimonial-img">
                  <img src="assets/images/testimonial-img-1.jpg" alt="image">
               </div>
               <div class="testimonial-heading">
                  <h5>Donald Brooks</h5>
                  <span class="client-designation">CEO of xzy company</span> 
               </div>
               <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et 
               quas molestias excepturi sint occaecati cupiditate non provident, similique sunt .</p>
           </div>
           
           <div class="testimonial_wrap">
               <div class="testimonial-img">
                  <img src="assets/images/testimonial-img-2.jpg" alt="image">
               </div>
               <div class="testimonial-heading">
                  <h5>Enzo Giovanotelli </h5>
                  <span class="client-designation">CEO of xzy company</span> 
               </div>
               <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et 
               quas molestias excepturi sint occaecati cupiditate non provident, similique sunt .</p>
           </div>
           
           <div class="testimonial_wrap">
               <div class="testimonial-img">
                  <img src="assets/images/testimonial-img-3.jpg" alt="image">
               </div>
               <div class="testimonial-heading">
                  <h5>Donald Brooks</h5>
                  <span class="client-designation">CEO of xzy company</span> 
               </div>
               <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et 
               quas molestias excepturi sint occaecati cupiditate non provident, similique sunt .</p>
           </div>
           
           <div class="testimonial_wrap">
               <div class="testimonial-img">
                  <img src="assets/images/testimonial-img-4.jpg" alt="image">
               </div>
               <div class="testimonial-heading">
                  <h5>Enzo Giovanotelli </h5>
                  <span class="client-designation">CEO of xzy company</span> 
               </div>
               <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et 
               quas molestias excepturi sint occaecati cupiditate non provident, similique sunt .</p>
           </div>
           
           <div class="testimonial_wrap">
               <div class="testimonial-img">
                  <img src="assets/images/testimonial-img-2.jpg" alt="image">
               </div>
               <div class="testimonial-heading">
                  <h5>Enzo Giovanotelli </h5>
                  <span class="client-designation">CEO of xzy company</span> 
               </div>
               <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et 
               quas molestias excepturi sint occaecati cupiditate non provident, similique sunt .</p>
           </div>
      </div>
    </div>
  </div>

</section>
<!-- /Testimonial-->


<!-- Help-Number--> 
<section id="help" class="section-padding">
  <div class="container">
    <div class="div_zindex white-text text-center">
          <h2>
            Have Any Question ?<br>
            +1 (807) 357-9414
          </h2>
      </div>
  </div>
    
  <!-- Dark-overlay-->    
  <div class="dark-overlay"></div>
</section>
<!-- /Help-Number--> 

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