<script>
$(function(){
	$('#hostlist tbody tr').click(function(){
		$('#hostCloudDetail').load("<?=base_url()?>index.php/host/editHostDetail/"+$(this).attr("hostid"));
	});
	
});
</script>
<table class="table table-hover" style="font-size:112%;" id="hostlist">
	<thead>
		<tr>
        	<th>編號</th>
			<th>名稱</th>
			<th>主機群</th>
		</tr>
	</thead>
	<tbody>
    	<?php foreach($hostcloudDetail as $item):?>
		<tr style="width:100%" hostid="<?php echo $item['HostID']?>">
        	<td><?php echo $item['HostID']?></td>
			<td><?php echo $item['HostName']?></td>
            <td><?php echo $item['CloudName']?></td>
		</tr>
		<?php endforeach;?>
        
	</tbody>            
</table>
