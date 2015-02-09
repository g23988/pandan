<div class="row">
<div id="canvas-holder" class="col-md-8">
			<canvas id="chart-area" width="1000" height="300"/>
</div>
<div id="test" class="col-md-4">
</div>
</div>
<script>

$(function(){
		$('#chart-area').attr('width',$('#canvas-holder').width());
		$.getJSON('<?=base_url()?>index.php/message/PandanNumByUser',function(result){
			var pieDatax = [];
				$.each(result,function(i,field){
					pieDatax.push({
						value:parseInt(field['value']),
						color:getRandomColor(),
						label:field['label']
						});
				});
				
			var total = 0;
			for(var key in pieDatax){
				var html = '<span class="glyphicon glyphicon-user" style=" color:' + pieDatax[key]['color'] + '; font-size:20px;"></span>';
				$('#test').append(html+ ' ' +pieDatax[key]['label'] + ' ' +pieDatax[key]['value']+ '<br>');
				total += pieDatax[key]['value'];
				}
			$('#pandancounttotal').html(total);
			
			var ctx = document.getElementById("chart-area").getContext("2d");
			window.myPie = new Chart(ctx).Pie(pieDatax,{
				
				//tooltipTemplate: "<%= value %>",
				/*onAnimationComplete: function()
				{
					this.showTooltip(this.segments, true);
				},*/
				//tooltipEvents: [],
				showTooltips: true
				});
			});
		


function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}




	})
	
	</script>



