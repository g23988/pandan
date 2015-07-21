        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">系統全域設定</h1>
            </div>
                <!-- /.col-lg-12 -->
        </div>


<div class="panel panel-default">

	<div class="panel-body">
	<!-- Nav tabs -->
		<ul class="nav nav-pills">
			<li class="active"><a href="#systemvar" data-toggle="tab">系統變數</a>
			</li>
			<li><a href="#loginsetting" data-toggle="tab">登入設定</a>
			</li>
		</ul>

                            <!-- Tab panes -->
		<?php echo form_open('system/updateSystemSetting')?>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="systemvar">
            
                <h3>系統變數</h3>
                <hr />
                <!--系統變數-->
                <div class="row">
                	<div class="col-lg-4">
                    	<div class="panel panel-default">
                            <div class="panel-heading">
                                登入頁播放影片
                            </div>
                            <div class="panel-body">
                                <select class="form-control" id="useSignMVSelect" name="useSignMVSelect">
                                    <option value="0" <?php if($systemsetting['useSignMV']=="0") echo "selected";?>>不播放</option>
                                    <option value="1" <?php if($systemsetting['useSignMV']=="1") echo "selected";?>>播放</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                    	<div class="panel panel-default">
                            <div class="panel-heading">
                                影片上傳
                            </div>
                            <div class="panel-body">
                                <div class="alert alert-danger">系統禁止上傳。</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                    	<div class="panel panel-default">
                            <div class="panel-heading">
                                首頁副標題
                            </div>
                            <div class="panel-body">
                                <input type="text" class="form-control" id="subtitle" name="subtitle" value="<?=$systemsetting['subTitle'];?>">
                            </div>
                        </div>
                    </div>
                </div>
                <!--系統變數end-->
            </div>
            <div class="tab-pane fade" id="loginsetting">
                <h3>登入設定</h3>
                <hr />
                <!--登入設定-->
                <div class="row">
                	<div class="col-lg-4">
                    	<div class="panel panel-default">
                            <div class="panel-heading">
                                使用LDAP登入
                            </div>
                            <div class="panel-body">
                                <select class="form-control" id="useLDAPselect" name="useLDAPselect">
                                    <option value="0" <?php if($systemsetting['useLDAP']=="0") echo "selected";?>>否</option>
                                    <option value="1" <?php if($systemsetting['useLDAP']=="1") echo "selected";?>>是</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                    	<div class="panel panel-default">
                            <div class="panel-heading">
                                LDAP位置
                            </div>
                            <div class="panel-body">
                                <input type="text" class="form-control" id="ldaplocation" name="ldaplocation" value="<?=$systemsetting['LDAPLocation'];?>">
                            </div>
                        </div>
                    </div>
                </div>
                <!--登入設定end-->
            </div>
        </div>
	</div>
                        <!-- /.panel-body -->
    <div class="panel-footer"><div class="clearfix"><input class="btn btn-primary pull-right" type="submit" name="submit" value="儲存" ></div>
    </div>
</div>



