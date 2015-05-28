        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">使用者明細 <small>修改 <?php echo $username;?> 的明細</small></h1>
            </div>
                <!-- /.col-lg-12 -->
        </div>


      <div class="panel panel-default">
      <div class="panel-body">
           <?php echo form_open('user/UpdateAccountDetail') ?>
              <div class="form-group" style="font-size:112%;">
              	<div class="row">
                	<div class="col-md-9 col-md-offset-1">
                        <label for="userid" class="control-label">系統使用者編號：</label>
                        <input type="text" class="form-control" id="userid" name="userid" readonly="readonly" value="<?php echo $userinfo['UserID']?>"/>
                        <label for="name" class="control-label">姓名*：</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $userinfo['Name']?>"/>
                        <label for="nickname" class="control-label">暱稱*：</label>
                        <input type="text" class="form-control" id="nickname" name="nickname" value="<?php echo $userinfo['Nickname']?>"/>
                        <label for="email" class="control-label">Email：</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $userinfo['Email']?>"/>
                        <input type="hidden" id="org_groupid" value="<?php echo $userinfo['GroupID']?>"/>
                        <label for="groupid" class="control-label">屬於群組*：</label>
                        <select class="form-control" name="groupid" id="groupid">
                            <?php foreach($groups as $item):?>
                            <option value="<?php echo $item['GroupID']?>"><?php echo $item['Name']?></option>
                            <?php endforeach;?>
                        </select><br />
                        <p class="bg-danger">注意：修改成功後將會自動登出</p>
                        <p class="text-center">
         		   <input class="btn btn-primary" type="submit" name="submit" value="修改" >
          			</p>
                	</div>
                </div>
              </div>

          </div>
 
          </form>          
</div>
</div>
