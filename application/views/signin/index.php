<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
  <!--  <link rel="shortcut icon" href="../../assets/ico/favicon.png"> -->

    <title>Pandan Signin</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>resources/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?=base_url()?>resources/css/signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
     <!-- <form class="form-signin">-->
		
        
        <?php 
		$attributes = array('class' => 'form-signin');
		echo form_open('signin',$attributes);?>

      	<h1 class="form-signin-heading">Pandan<br>
        <small>現在，開始盤點</small></h1><br>
        <input type="text" class="form-control" placeholder="Username"  name="username" autofocus>
        <input type="password" class="form-control" placeholder="Password" name="password">
        <div style="font-size:10px; color:red;"><?php echo validation_errors();?></div>
        <label class="checkbox">
      <!--    <input type="checkbox" value="remember-me"> Remember me -->
        </label>
        
        <button class="btn btn-lg btn-primary btn-block" type="submit">登入</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
