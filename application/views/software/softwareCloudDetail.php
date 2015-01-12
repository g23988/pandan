<script>
$(function(){
	$('#softwarelist tbody tr').click(function(){
		$('#softwareCloudDetail').load("<?=base_url()?>index.php/software/editSoftwareDetail/"+$(this).attr("softwareid"));
	});
	
});
</script>
<table class="table table-hover" style="font-size:112%;" id="softwarelist">
	<thead>
		<tr>
        	<th>編號</th>
			<th>名稱</th>
			<th>軟體群</th>
		</tr>
	</thead>
	<tbody>
    	<?php foreach($softwarecloudDetail as $item):?>
		<tr style="width:100%" softwareid="<?php echo $item['SoftwareID']?>">
        	<td><?php echo $item['SoftwareID']?></td>
			<td><?php echo $item['SoftwareName']?></td>
            <td><?php echo $item['CloudName']?></td>
		</tr>
		<?php endforeach;?>
        
	</tbody>            
</table>
