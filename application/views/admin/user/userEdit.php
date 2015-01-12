<div class="container">
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
      	<h2>管理使用者<br /><small>設置使用者登入權利</small></h2>
      </div>
      
      <div class="panel panel-default">
      <div class="panel-body">
        <table class="table table-hover" style="font-size:112%;">
            <thead>
                <tr>
                    <th>序號</th>
                    <th>帳號</th>
                    <th>姓名</th>
                    <th>暱稱</th>
                    <th>單位名稱</th>
                    <th>創建人</th>
                    <th>刪除</th>
                </tr>
            </thead>
			<tbody>
                <?php foreach($users as $item):?>
                <tr>
                	<td><?php echo $item['UserID']?></td>
                	<td><?php echo $item['Account']?></td>
                    <td><?php echo $item['Name']?></td>
                    <td><?php echo $item['Nickname']?></td>
                    <td><?php echo $item['groupname']?></td>
                    <td><?php echo $item['Createuser']?></td>
                    <td><a style="color:red;text-decoration:none;" href="<?=base_url()."index.php/user/delete/".$item['UserID']?>">&#10006;</a></td>
                </tr>
                <?php endforeach?>

            </tbody>            
        </table>
		<p class="text-center">
          <button class="btn btn-default" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">新增</button>
        </p>
</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">新增使用者</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open('user/add')?>
          <div class="form-group">
            <label for="group-name" class="control-label">帳號:</label>
            <input type="text" class="form-control" id="Account" name="account">
            <label for="name" class="control-label">姓名:</label>
            <input type="text" class="form-control" id="Name" name="name">
            <label for="nickname" class="control-label">匿稱:</label>
            <input type="text" class="form-control" id="Nickname" name="nickname">
            <label for="groupname" class="control-label">群組名稱:</label>
            <select name="groupname" class="form-control">
            	<?php foreach($groups as $item):?>
            	<option value="<?php echo $item['GroupID']?>"><?php echo $item['Name']?></option>
                <?php endforeach?>
            </select>
          </div>
<!--	     <div class="form-group">
            <label for="message-text" class="control-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>-->
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
        <input class="btn btn-primary" type="submit" name="submit" value="送出" >
      </div>
      </form>
    </div>
  </div>
</div>






    </div> <!-- /container -->
