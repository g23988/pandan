<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
  <!--  <link rel="shortcut icon" href="../../assets/ico/favicon.png"> -->

    <title>Pandan Signin</title>

    <!-- Bootstrap core CSS 
    <link href="<?=base_url()?>resources/css/bootstrap.css" rel="stylesheet">-->
    <link href="<?=base_url()?>resources/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?=base_url()?>resources/css/signin.css" rel="stylesheet">
	<link href="<?=base_url()?>resources/css/font-awesome.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

	<script src="<?=base_url()?>resources/js/jquery.min.js"></script>
    <script src="<?=base_url()?>resources/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>resources/js/jquery.videoBG.js"></script>
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="container">
     <!-- <form class="form-signin">-->
        <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3"> 
              	<h1 class="form-signin-heading">Pandan<br>
        <small>104 系統盤點</small></h1><br>
        <div class="panel panel-primary" >
            <div class="panel-heading">
                <div class="panel-title text-center">網域帳密認證</div>
            </div>     

            <div class="panel-body" >
				
                <!--<form name="form" id="form" class="form-horizontal" enctype="multipart/form-data" method="POST">-->
                           <?php 
							$attributes = array('id' => 'form');
							echo form_open('signin',$attributes);?>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="user" type="text" class="form-control" name="username" value="" placeholder="User">                                        
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                    </div>                                                                  

                    <div class="form-group">
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                            <button type="submit" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-log-in"></i> Login</button>                          
                        </div>
                    </div>

                     
     		   <div style="font-size:10px; color:red;"><?php echo validation_errors();?></div>
               </form>
            </div>                     
        </div>  
    </div>
        


    </div> <!-- /container -->

<div id="particles"></div>
<?php
//影片背景部分
$mp4 = "";
$ogv = "";
$webm = "";
if ($systemsetting['useSignMV']==1){
	$mp4 = base_url()."resources/image/104.mp4";
	$ogv = base_url()."resources/image/104.ogv";
	$webm = base_url()."resources/image/104.webm";
	}

?>
<script>
$(function(){
	$('#particles').videoBG({
	mp4:'<? echo $mp4;?>',
	ogv:'<? echo $ogv;?>',
	webm:'<? echo $webm;?>',
	poster:'<?=base_url()?>resources/image/tunnel_animation.jpg',
	scale:true,
	zIndex:-2
	});
	
	});
</script>
  
  </body>
</html>
