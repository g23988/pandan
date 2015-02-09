<div class="row">
<div  class="col-md-12">
	<table class="table table-striped">
    <tr>
    <td>從未盤點</td>
    <td id="count_pandan_nerver"><?php echo $count_pandan_nerver;?></td>
    <td><a id="count_pandan_nerver_btn" href="<?=base_url()?>index.php/pandan/pandanByHost" class="btn btn-sm btn-danger">前往機器列表</a></td>
    </tr>
    <tr>
    <td>盤點中</td>
    <td id="count_pandan_dnf"><?php echo $count_pandan_dnf;?></td>
    <td><a id="count_pandan_dnf_btn" href="<?=base_url()?>index.php/pandan/pandanByHost" class="btn btn-sm btn-warning">前往機器列表</a></td>
    </tr>
    </table>

</div>

</div>

<script>
$(function(){
	if($('#count_pandan_nerver').html()=='0'){ $('#count_pandan_nerver_btn').css('display','none');	}
	if($('#count_pandan_dnf').html()=='0'){ $('#count_pandan_dnf_btn').css('display','none');	}
	})
</script>

