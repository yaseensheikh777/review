<?php 
  use app\Routes;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="http://getbootstrap.com/assets/ico/favicon.png">

    <title>Review System</title>

    <!-- Bootstrap core CSS -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.css" rel="stylesheet">
    <link type="text/css" href="<?php echo HTTP_SERVER; ?>/assets/css/style.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/starter-template/starter-template.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Review System</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo HTTP_SERVER; ?>">Home</a></li>
            <?php if (!isset($_SESSION['email'])) { ?>
              <li><a href="<?php echo HTTP_SERVER; ?>/login">Login</a></li>
              <?php } ?>
            <li><a href="<?php echo HTTP_SERVER; ?>/contact">Contact</a></li>
          </ul>
          <?php if(isset($_SESSION['email'])) { ?>
            <nav>
              <ul class="cf">
                  <li><a class="dropdown" href="#">   Muhammad Ali   </a>
                      <ul>
                          <li><a href="#">Setting</a></li>
                          <li><a href="#">Logout</a></li>
                      </ul>
                      </li>
              </ul>
          </nav>
          <?php } ?>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">


        <?php Routes::app() ?>


    </div><!-- /.container -->


  </body>
</html>
