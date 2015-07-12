<div class="dataTable_wrapper">
<table id="messagetable" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th width="15%">來源</th>
                <th width="40%">內容</th>
                <th width="15%">連結</th>
                <th width="30%">時間</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>來源</th>
                <th>內容</th>
                <th>連結</th>
                <th>時間</th>
            </tr>
        </tfoot>
</table>
</div>
<script>
$(document).ready(function() {
    $('#messagetable').dataTable( {
        "ajax": "http://g23988.synology.me/pandan/index.php/message/UserMessageJson"
    } );
	$('#messagetable tbody').on( 'click', 'tr td:nth-child(3)', function () {
       document.location.href=$(this).html()
    } );
} );
</script>
