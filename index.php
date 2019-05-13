<?php
include('user/config.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Index</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
   <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body id="backimage">
<div class="container border-top"  style="background-color:#FBFCFC; margin-top:1%; margin-bottom:2%">
  <div class=" text-left" style="background-color:#FBFCFC;margin:0 10px">
  	<div class="row">
  		<div class="col-md-auto">
  			<img src="image/logo.png" alt="logo" style="width:100px;">
  		</div>
  		<div class="col col-lg-6">
            <h1 style="font-family:cursive, sans-serif">ABC INSTITUTE</h1>
  			<p>Learning Management</p>
  		</div>
  		<div class="col text-right">
  			<button type="button" class="btn btn-round btn-primary" onclick="window.location.href='user/login.php'" >Login</button>
  		</div>
  	</div>
  </div>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="margin:0 10px">
  <a class="navbar-brand" href="#">ABC</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link active" href="index.php">Home</a>
      </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Faculties</a>
            <div class="dropdown-menu">
                <?php
                $result=mysqli_query($con,"SELECT * FROM faculty  order by facultyID asc");

                if($result === FALSE) {
                    die(mysqli_error());
                }
                while($res=mysqli_fetch_array($result))
                {
                    ?>
                    <a class="dropdown-item" href="user/year.php?faculty=1&facultyName=<?php echo $res['facultyName']; ?>"><?php echo $res['facultyName']; ?> </a>
                    <?php
                }
                ?>
            </div>
        </li>
    <li class="nav-item">
      <a class="nav-link " href="#section1">About</a>
    </li>
    </ul>
  </div>
	<form class="form-inline " id="collapsibleNavbar" action="/action_page.php">
		<input class="form-control mr-sm-2" type="text" placeholder="Search">
		<button class="btn btn-success" type="submit"><i class="fa fa-search"></i> </button>

	</form>
</nav>

<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel" style="margin:30px 10px; ">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="image/a.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="image/b.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="image/c.jpg" class="d-block w-100" alt="...">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>

<!-- notice -->
<div class="jumbotron" style="margin:0 10px">
  <h3 class="display-5">Hello, world!</h3>
  <hr class="my-4">
  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
</div>
<!-- end notice-->

<!-- our course -->
    <div class="container">
        <div class="row" style="margin:0 10px">
            <!-- course -->
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                      <p><img class="img-fluid" src="image/1.jpg" alt="card image"></p>
                      <h4 class="card-title">Information Technology</h4>
                      <p class="card-text">This is basic card with image on top, title, description and button.</p>
                      <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <!-- ./course -->
            <!-- course -->
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                      <p><img class="img-fluid" src="image/2.jpg" alt="card image"></p>
                      <h4 class="card-title">Software Engineering</h4>
                      <p class="card-text">This is basic card with image on top, title, description and button.</p>
                      <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <!-- ./course -->
            <!-- course -->
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                      <p><img class="img-fluid" src="image/3.jpg" alt="card image"></p>
                      <h4 class="card-title">Cyber</h4>
                      <p class="card-text">This is basic card with image on top, title, description and button.</p>
                      <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <!-- ./course -->
        </div>
    </div>
<!-- our course -->

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
