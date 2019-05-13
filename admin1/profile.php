<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Profile</title>
</head>

<body id="backimage">
<div class="container border-top"  style="background-color:#FBFCFC; margin-top:1%; margin-bottom:2%">
    <?php
    include ('header.php');
    ?>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-8">
		<div class="well">
    <ul class="nav nav-pills">
      <li class="active"><a href="#home" data-toggle="tab">Profile</a></li>
      <li><a href="#profile" data-toggle="tab">Password</a></li>
    </ul>
    <div id="myTabContent" class="tab-content" style="margin-left:10px">
      <div class="tab-pane active in" id="home">
        <div class="row justify-content">
        <div class="card">
        <header class="card-header">
        	<h4 class="card-title mt-2">Profile</h4>
        </header>
        <article class="card-body">

        <form method="post">
            <div class="form-group text-center" >
                <div><?php if(isset($faild_err)) echo $faild_err; ?></div>
                <img src="image/user.png" onclick="triggerClick()" alt="profile" id="profileDisplay" style="display:block;width:150px; height:150px; margin:10px auto;border-radius:50%;">
                <input type='file' name='profileImage' onchange="displayImage(this)" id="profileImage" style="display: none;"/>
                <label style="font-weight: bold;">Choose profile</label>
            </div>
        	<div class="form-row">
        		<div class="col form-group">
        			<label>First Name </label>
        		  	<input type="text" name="fname" class="form-control" placeholder="" value="<?php  echo $fname; ?>">
        		</div> <!-- form-group end.// -->
        		<div class="col form-group">
        			<label>Last Name</label>
        		  	<input type="text" class="form-control" placeholder="" value="<?php  echo $lname; ?>">
        		</div> <!-- form-group end.// -->
        	</div> <!-- form-row end.// -->
            <div class="form-row">
                <div class="col form-group">
                    <label>Email </label>
                    <input type="text" name="fname" class="form-control" placeholder="" value="<?php  echo $email; ?>">
                </div> <!-- form-group end.// -->
                <div class="col form-group">
                    <label>User Name</label>
                    <input type="text" class="form-control" placeholder="" value="<?php  echo $uName; ?>">
                </div> <!-- form-group end.// -->
            </div> <!-- form-row end.// -->
          <div class="form-group">
        		<label>User Name</label>
        		<input type="text" class="form-control" placeholder="">
        	</div> <!-- form-group end.// -->
        	<div class="form-group">
        			<label class="form-check form-check-inline">
        		  <input class="form-check-input" type="radio" name="gender" value="option1">
        		  <span class="form-check-label"> Male </span>
        		</label>
        		<label class="form-check form-check-inline">
        		  <input class="form-check-input" type="radio" name="gender" value="option2">
        		  <span class="form-check-label"> Female</span>
        		</label>
        	</div> <!-- form-group end.// -->
        	<div class="form-row">
            <div class="form-group col-md-6">
        		  <label>Facultie</label>
        		  <select id="inputState" class="form-control">
        		    <option> Choose...</option>
        		      <option>IT</option>
        		      <option>SE</option>
        		      <option>IM</option>
        		  </select>
        		</div> <!-- form-group end.// -->
        		<div class="form-group col-md-6">
        		  <label>Year</label>
        		  <select id="inputState" class="form-control">
        		    <option> Choose...</option>
        		      <option>1</option>
        		      <option>2</option>
        		      <option selected="">3 </option>
        		      <option>4</option>
        		  </select>
        		</div> <!-- form-group end.// -->
        	</div> <!-- form-row.// -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block"> Update  </button>
            </div> <!-- form-group// -->
        </form>
        </article> <!-- card-body end .// -->
        </div> <!-- card.// -->

        </div> <!-- row.//-->
      </div>

      <!-- Edit password//-->
      <div class="tab-pane fade" id="profile">
        <div class="row justify-content">
        <div class="card">
        <header class="card-header">
          <h4 class="card-title mt-2">Change Password</h4>
        </header>
        <article class="card-body">
        <form>
          <div class="form-group">
            <label>Current password</label>
              <input class="form-control" type="password">
          </div> <!-- form-group end.// -->
          <div class="form-group">
            <label>New password</label>
              <input class="form-control" type="password">
          </div> <!-- form-group end.// -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block"> Change Password  </button>
            </div> <!-- form-group// -->
        </form>
        </article> <!-- card-body end .// -->
        </div> <!-- card.// -->

        </div> <!-- row.//-->
      </div>
  </div>
	</div>
	</div>

	<div class="col-sm-4"> <!-- side bar start.//-->
    <div class="card" style="margin-top:7%">
    <header class="card-header">
      <h5 class="card-title mt-1">My Courses</h5>
    </header>
    <div style="padding:10px">
      <p>SPM</p>
      <p>ISDM</p>
      <p>OOP</p>
    </div>
    </div>

    <div class="card" style="margin-top:7%">
    <header class="card-header">
      <h5 class="card-title mt-1">Assignment Submission</h5>
    </header>
    <div style="padding:10px">
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link" href="#">Active</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Disabled</a>
        </li>
      </ul>
    </div>
    </div>
  </div> <!-- side bar end.//-->
  </div>
</div>

<!-- About start.// -->
<div class="row text-center" style="margin: 0 10px 1% 10px;background-color:#6c757d">
  <div class="col-sm-4">
    <div id="section1" class="container-fluid bg-secondary" style="padding-top:40px;padding-bottom:20px; min-height:200px">
      <h1>About</h1>
      <p>Try to scroll this section and look at the navigation bar while scrolling! Try to scroll this section and look at the navigation bar while scrolling!</p>
    </div>
  </div>
  <div class="col-sm-4">
    <div id="section1" class="container-fluid bg-secondary" style="padding-top:40px;padding-bottom:20px; min-height:200px">
      <h1>Contact</h1>
      <p>Try to scroll this section and look at the navigation bar while scrolling! Try to scroll this section and look at the navigation bar while scrolling!</p>
    </div>
  </div>
  <div class="col-sm-4">
    <div id="section1" class="container-fluid bg-secondary" style="padding-top:40px;padding-bottom:20px; min-height:200px">
      <h1>Follow</h1>
      <p>Facebook</p>
      <p>Twitter</p>
    </div>
  </div>
</div> <!-- About end.// -->

<footer style="margin:0 10px">
  <p>ABC @ 2019 All Rights Reserved. </p>
</footer>
</div>
</body>
</html>
