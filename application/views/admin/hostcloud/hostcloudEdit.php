<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">管理主機群 <small>管理主機歸納群組</small></h1>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-desktop fa-fw"></i> 主機群
			<div class="pull-right"><button type="button" class="btn btn-default btn-xs fa fa-plus" data-toggle="modal" data-target="#addModal" data-whatever="@mdo"></button></div>
	</div>
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table id="hostcloudtable" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="10%">序號</th>
                        <th width="30%">群名稱</th>
                        <th width="25%">位置</th>
                        <th width="35%">描述</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>序號</th>
                        <th>群名稱</th>
                        <th>位置</th>
                        <th>描述</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
	//讀取群名稱ajax
	var baseHref = document.getElementsByTagName('base')[0].href
    $('#hostcloudtable').dataTable( {
        "ajax": baseHref+"index.php/hostcloud/HostCloudJson"
    } );
	//觸發更動修改頁面
	$('#hostcloudtable tbody').on( 'click', 'tr', function () {
       $('#editModal').modal('show');
	   $('#editcloudid').val($(this).children('td:eq(0)').html());
		$('#editcloudname').val($(this).children('td:eq(1)').html());
		$('#editlocation').val($(this).children('td:eq(2)').html());
		$('#editdescription').val($(this).children('td:eq(3)').html());
		$('#deletehostcloud').attr('href',baseHref+"index.php/hostcloud/delete/"+$(this).children('td:eq(0)').html());
		
	   
    } );
} );
</script>


<!--新增的是窗-->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">新增主機群</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open('hostcloud/add')?>
          <div class="form-group">
            <label for="cloudname" class="control-label">主機群名稱:</label>
            <input type="text" class="form-control" id="cloudname" name="cloudname">
            <label for="location" class="control-label">位置:</label>
            <input type="text" class="form-control" id="location" name="location">
            <label for="description" class="control-label">描述:</label>
            <textarea rows="5" class="form-control" id="description" name="description"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
        <input class="btn btn-primary" type="submit" name="submit" value="送出" >
      </div>
      </form>
    </div>
  </div>
</div>

<!--修改的視窗-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">修改主機群明細</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open('hostcloud/edit')?>
          <div class="form-group">
            <label for="editcloudid" class="control-label">主機群序號:</label>
            <input type="text" class="form-control" id="editcloudid" name="editcloudid" readonly="readonly">
            <label for="editcloudname" class="control-label">主機群名稱:</label>
            <input type="text" class="form-control" id="editcloudname" name="editcloudname">
            <label for="editlocation" class="control-label">位置:</label>
            <input type="text" class="form-control" id="editlocation" name="editlocation">
            <label for="editdescription" class="control-label">描述:</label>
            <textarea rows="5" class="form-control" id="editdescription" name="editdescription"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <a id="deletehostcloud" class="btn btn-danger pull-left" href="">刪除</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
        <input class="btn btn-primary" type="submit" name="submit" value="送出" >
      </div>
      </form>
    </div>
  </div>
</div>

