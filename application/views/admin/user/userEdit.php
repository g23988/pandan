        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">管理使用者 <small>設置使用者登入權利</small></h1>
            </div>
                <!-- /.col-lg-12 -->
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
			<tbody id="userlist">
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
        <script>
		$(function(){
			$('#userlist tr').click(function(){
					//修改使用者明細用 拉回頁面資料
					$('#edituser').modal('show');
					$('#editUserID').val($(this).children('td:eq(0)').html());
					$('#editAccount').val($(this).children('td:eq(1)').html());
					$('#editName').val($(this).children('td:eq(2)').html());
					$('#editNickname').val($(this).children('td:eq(3)').html());
					//$('#editgroupname').val($(this).children('td:eq(4)').html());
					var org_option = $(this).children('td:eq(4)').html();
					$("#editgroupname").children().each(function(){
						//alert($(this).children('td:eq(3)').html());
					if ($(this).html()==org_option){
						$(this).attr("selected", true); 
						 }
					});
					//$(this).children('td:eq(0)').css("background-color","yellow");
					//alert($(this).children('td:eq(0)').html());
				})

			
			});
		</script>
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



<div class="modal fade" id="edituser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">修改使用者</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open('user/UpdateUserDetail')?>
          <div class="form-group">
          	<label for="editUserID" class="control-label">序號:</label>
            <input type="text" class="form-control" id="editUserID" name="editUserID" readonly="readonly">
            <label for="editaccount" class="control-label">帳號:</label>
            <input type="text" class="form-control" id="editAccount" name="editaccount" readonly="readonly">
            <label for="editname" class="control-label">姓名:</label>
            <input type="text" class="form-control" id="editName" name="editname">
            <label for="editnickname" class="control-label">匿稱:</label>
            <input type="text" class="form-control" id="editNickname" name="editnickname">
            <label for="editgroupname" class="control-label">群組名稱:</label>
            <select id="editgroupname" name="editgroupname" class="form-control">
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

