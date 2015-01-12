<div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
      	<h2>主機新增 <small>新增由 <?php echo $username;?> 管理的主機</small></h2>
      </div>
      <div class="panel panel-default">
      <div class="panel-body">
           <?php echo form_open('host/add') ?>
              <div class="form-group" style="font-size:112%;">
              	<div class="row">
                	<div class="col-md-9 col-md-offset-1">
                        <label for="hostid" class="control-label">編號：</label>
                        <input type="text" class="form-control" id="hostid" name="hostid" readonly="readonly" value="自動編號"/>
                        <label for="hostname" class="control-label">主機名稱*：</label>
                        <input type="text" class="form-control" id="hostname" name="hostname" />
                        <label for="hostcloudid" class="control-label">主機群*：</label>
                        <select class="form-control" name="hostcloudid" id="hostcloudid">
                            <?php foreach($hostclouds as $cloud):?>
                            <option value="<?php echo $cloud['CloudID']?>"><?php echo $cloud['Name']?></option>
                            <?php endforeach;?>
                        </select><br />
                	</div>
                </div>
              
                <hr />
                <div class="row">
                	<div class="col-md-9 col-md-offset-1">
                        <label for="remark" class="control-label">備註：</label>
                        <textarea rows="5" class="form-control" id="remark" name="remark"></textarea>
                	</div>
                </div>
              </div>

            
          </div>
          	<div class="row">
            	<div class="col-md-9 col-md-offset-1">
                <p class="text-center">
         		   <input class="btn btn-primary" type="submit" name="submit" value="新增" >
          		</p>
                </div>
            </div>
 
          </form>          
</div>
</div>
    </div> <!-- /container -->