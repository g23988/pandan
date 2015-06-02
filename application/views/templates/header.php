<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>Pandan</title>
    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>resources/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <!--<link href="base_url()resources/css/sticky-footer-navbar.css" rel="stylesheet">-->
	<!-- MetisMenu CSS -->
    <link href="<?=base_url()?>resources/css/metisMenu.min.css" rel="stylesheet">
	<!-- Timeline CSS -->
    <link href="<?=base_url()?>resources/css/timeline.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?=base_url()?>resources/css/sb-admin-2.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <!--<link href="base_url()resources/css/morris.css" rel="stylesheet">-->
    <!-- Custom Fonts -->
    <link href="<?=base_url()?>resources/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>resources/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css">
    <base href="<?=base_url()?>">
    
</head>
<body>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- <script src="<?//=base_url()?>resources/assets/jquery.js"></script> -->
    <script src="<?=base_url()?>resources/js/jquery.min.js"></script>
    <script src="<?=base_url()?>resources/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?=base_url()?>resources/js/metisMenu.min.js"></script>
    <!-- Morris Charts JavaScript -->
    <!--<script src="resources/js/raphael-min.js"></script>
    <script src="resources/js/morris.min.js"></script>
    <script src="resources/js/morris-data.js"></script>-->
    <!-- Custom Theme JavaScript -->
    <script src="<?=base_url()?>resources/js/sb-admin-2.js"></script>
    <!-- get bootstrap-switch.js-->
    <script src="<?=base_url()?>resources/js/bootstrap-switch.min.js"></script>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=base_url()?>">Pandan v2.0</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    
                    <ul class="dropdown-menu dropdown-messages" id="ulmessage">
                    	<script>
							$(function(){
								$('#ulmessage').load('index.php/message/UserMessageHtmlUl/3');
								})
						</script>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="index.php/user/AccountDetailEdit"><i class="fa fa-user fa-fw"></i> 個人資料</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="index.php/signout"><i class="fa fa-sign-out fa-fw"></i> 登出</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="index.php/pages/view"><i class="fa fa-dashboard fa-fw"></i> 訊息</a>
                        </li>
                        <li>
                            <a href="index.php/pandan/pandanByHost/all"><i class="fa fa-power-off fa-fw"></i> 開始</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-desktop fa-fw"></i> 主機<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="index.php/host/view">總覽</a>
                                </li>
                                <li>
                                    <a href="index.php/host/addHostDetail">新增</a>
                                </li>
                                <?php if($username==='admin'):?>
                                <li>

                                <li>
                                    <a href="index.php/hostcloud/view"><i class="fa fa-user-secret fa-fw"></i> 主機群</a>
                                </li>
                                <li>
                                    <a href="index.php/host/clearAllFlag"><i class="fa fa-user-secret fa-fw"></i> 重設標籤</a>
                                </li>

                                </li>
                                <?php endif;?>
                            </ul>
                            <!-- /.nav-second-level fa-cubes-->
                        </li>
                        <?php if($username==='admin'):?>
                        <li>
                            <a href="#"><i class="fa fa-th-large fa-fw"></i> 軟體<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                            <li>
                                <a href="index.php/software/view"><i class="fa fa-user-secret fa-fw"></i> 總覽</a>
                            </li>
                            <li>
                                <a href="index.php/software/addSoftwareDetail"><i class="fa fa-user-secret fa-fw"></i> 新增</a>
                            </li>
                            <li>
                                <a href="index.php/softwarecloud/view"><i class="fa fa-user-secret fa-fw"></i> 軟體群</a>
                            </li>
                            </ul>
                            <!-- /.nav-second-level fa-cubes-->
                        </li>
                        <?php endif;?>
                        <?php if($username==='admin'):?>
                        <li>
                            <a href="#"><i class="fa fa-group fa-fw"></i> 帳號<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                 <li>
                                            <a href="index.php/user/view"><i class="fa fa-user-secret fa-fw"></i> 使用者</a>
                                 </li>
                                 <li>
                                            <a href="index.php/userGroup/view"><i class="fa fa-user-secret fa-fw"></i> 使用者群組</a>
                                 </li>
                            </ul>
                            <!-- /.nav-second-level fa-cubes-->
                        </li>
                        <?php endif;?>
                        <?php if($username==='admin'):?>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> 超級管理員<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="index.php/user/ChangLoginUser"><i class="fa fa-group fa-fw"></i> 切換身分</a>
                                </li>
                                <li>
                                    <a href="index.php/bg/view"><i class="fa fa-sitemap fa-fw"></i> 使用單位</a>
                                </li>
                                <li>
                                    <a href="index.php/listadmin/dataview"><i class="fa fa-file-o fa-fw"></i> 資料類型</a>
                                </li>
                                <li>
                                    <a href="index.php/listadmin/settingview"><i class="fa fa-list-ol fa-fw"></i> 設定檔類型</a>
                                </li>
								<li>
                                    <a href="index.php/listadmin/logview"><i class="fa fa-archive fa-fw"></i> 記錄檔類型</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-plug fa-fw"></i> XML API<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="index.php/pandanoutput/GetAllSoftwarePathData/root/Admin123" target="_blank">軟體明細</a>
                                        </li>
                                        <li>
                                            <a href="index.php/pandanoutput/GetAllDataPathData/root/Admin123" target="_blank">資料明細</a>
                                        </li>
                                        <li>
                                            <a href="index.php/pandanoutput/GetAllHostGroupData/root/Admin123" target="_blank">機器明細</a>
                                        </li>
                                    </ul>
                                    <!-- 管理用 /.nav-third-level -->
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php endif;?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
   
