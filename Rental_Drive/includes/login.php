<?php
  if(isset($_POST['login'])) {
    $email=$_POST['email'];
    $password=md5($_POST['password']);

    $sql ="SELECT id,EmailId,Password,FullName FROM tblusers WHERE EmailId=:email and Password=:password";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetch();

    if($query->rowCount() > 0) {
      $_SESSION['login'] = $_POST['email'];
      $_SESSION['fname'] = $results["FullName"];
      $_SESSION['userID'] = $results["id"];
      $currentpage=$_SERVER['REQUEST_URI'];
      echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
    } else {      
      echo "<script>alert('Invalid Details');</script>";
    }
  }
?>

<!--Login-Form -->
<div class="modal fade" id="loginform">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Login</h3>
      </div>
      <div class="modal-body">
        
          <div class="login_wrap">
      <div class="row">
            <div class="col-md-6 col-sm-6">
              <form action="#" method="POST">
                <div class="form-group">
                  <input type="text" name="email" class="form-control" placeholder="Username or Email address*">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control" placeholder="Password*">
                </div>
                <div class="form-group checkbox">
                  <input type="checkbox" id="remember">
                  <label for="remember">Remember Me</label>
                </div>
                <div class="form-group">
                  <input type="submit" name="login" value="Login" class="btn btn-block">
                </div>
              </form>
            </div>
            <div class="col-md-6 col-sm-6">
              <a href="#signupform" class="btn btn-block facebook-btn" data-toggle="modal" data-dismiss="modal">Create a new account</a>
              <br/>
              <a href="#forgotpassword" class="btn btn-block googleplus-btn" data-toggle="modal" data-dismiss="modal">Forgot Password ?</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/Login-Form --> 