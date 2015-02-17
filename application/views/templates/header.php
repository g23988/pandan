<!doctype html>
<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>Pandan</title>
    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>resources/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?=base_url()?>resources/css/sticky-footer-navbar.css" rel="stylesheet">

	
</head>
<body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?=base_url()."index.php"?>">PANDAN</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
			<li><a href="<?=base_url()."index.php/pandan/pandanByHost"?>">Start</a></li>
            <li><a href="<?=base_url()."index.php/message/view"?>">Message</a></li>
            <!-- Host-->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Host<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?=base_url()."index.php/host/view"?>">總覽</a></li>
                <li><a href="<?=base_url()."index.php/host/addHostDetail"?>">新增</a></li>
                <?php if($username==='admin'):?>
                <li class="divider"></li>
                <li class="dropdown-header">Administrator</li>
                <li><a href="<?=base_url()."index.php/hostcloud/view"?>">主機群</a></li>
                <li><a href="<?=base_url()."index.php/host/clearAllFlag"?>">Flag重設</a></li>
				<?php endif;?>
              </ul>
            </li>
            <!-- host結束-->

            <!-- software start -->
            <?php if($username==='admin'):?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Software<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">Administrator</li>
                <li><a href="<?=base_url()."index.php/software/view"?>">總覽</a></li>
                <li><a href="<?=base_url()."index.php/software/addSoftwareDetail"?>">新增</a></li>
                <li><a href="<?=base_url()."index.php/softwarecloud/view"?>">軟體群</a></li>
              </ul>
            </li>
            <?php endif;?>
            <!-- software end-->
            <!--帳號管理-->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?=base_url()."index.php/user/AccountDetailEdit"?>">修改明細</a></li>
                <li><a href="<?=base_url()."index.php/signout"?>">登出</a></li>
              <?php if($username==='admin'):?>
				<li class="divider"></li>
                <li class="dropdown-header">Administrator</li>
                <li><a href="<?=base_url()."index.php/user/view"?>">使用者</a></li>
                <li><a href="<?=base_url()."index.php/userGroup/view"?>">使用者群組</a></li>
                <li><a href="<?=base_url()."index.php/user/ChangLoginUser"?>">切換身分</a></li>
              <?php endif;?>
              </ul>
            </li>
            
            <!--帳號管理結束-->
            <!--管理全域開始-->
            <?php if($username==='admin'):?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administrator<b class="caret"></b></a>
              <ul class="dropdown-menu">
              	<li class="dropdown-header">Account Manager</li>
                <li><a href="<?=base_url()."index.php/user/view"?>">使用者</a></li>
                <li><a href="<?=base_url()."index.php/userGroup/view"?>">使用者群組</a></li>
                <li><a href="<?=base_url()."index.php/user/ChangLoginUser"?>">切換身分</a></li>
				<li class="divider"></li>
                <li class="dropdown-header">BG Manager</li>
                <li><a href="<?=base_url()."index.php/bg/view"?>">使用單位</a></li>
              	<li class="divider"></li>
                <li class="dropdown-header">Cloud Manager</li>
                <li><a href="<?=base_url()."index.php/hostcloud/view"?>">主機群</a></li>
                <li><a href="<?=base_url()."index.php/softwarecloud/view"?>">軟體群</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">List Manager</li>
                <li><a href="<?=base_url()."index.php/listadmin/dataview"?>">資料類型</a></li>
                <li><a href="<?=base_url()."index.php/listadmin/settingview"?>">設定檔類型</a></li>
                <li><a href="<?=base_url()."index.php/listadmin/logview"?>">記錄檔類型</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Output API xml format</li>
                <li><a href="<?=base_url()."index.php/pandanoutput/GetAllSoftwarePathData/root/Admin123"?>">軟體明細</a></li>
                <li><a href="<?=base_url()."index.php/pandanoutput/GetAllDataPathData/root/Admin123"?>">資料明細</a></li>
              </ul>
            </li>
            <?php endif;?>
            <!--管理全域結束-->
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
         
            <!--<li><a href="../navbar/">Mail</a></li>-->
            <!--<li><a href="../navbar-static-top/">Static top</a></li>-->
            <li><a>您好！<?php echo $userinfo['Nickname']?></a></li>
            <li class="active"><a href="<?=base_url()."index.php/signout"?>">登出</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- <script src="<?//=base_url()?>resources/assets/jquery.js"></script> -->
    <script src="<?=base_url()?>resources/js/jquery.min.js"></script>
    <script src="<?=base_url()?>resources/js/bootstrap.min.js"></script>

<script>
var isAlt = false;
//快速進入start偵測 複合健alt + s
function quickstart(event){
	 if (event.keyCode == 18) {
		 isAlt = true;
		 };
	 if (event.keyCode == 83 && isAlt) {
	 	window.location.replace("<?=base_url()."index.php/pandan/pandanByHost"?>");
	 	};
	};
$(function(){
	$(window).bind('keydown', quickstart);
	});
</script>