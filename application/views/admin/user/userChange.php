        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">切換身分 <small>賦予您天神的力量，化身為任何人量</small></h1>
            </div>
                <!-- /.col-lg-12 -->
        </div>
<script>
//切換身分
$(function(){
	$('#userlist tr').click(function(){
		var username = $(this).children('td:eq(1)').html();
		window.location.href = "<?=base_url()."index.php/signin/resignin/"?>"+username;
		
		});
	
	})
</script>


      
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
                </tr>
                <?php endforeach?>

            </tbody>            
        </table>

</div>
</div>


