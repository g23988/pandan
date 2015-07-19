//取得base url
var baseHref = document.getElementsByTagName('base')[0].href

$.get(baseHref+'index.php/host/showUserAllHostJson', function(data){
    $("#searchinput").typeahead({ 
		source:data,
		items:'all',
		afterSelect:function(obj){
			location.href = baseHref+'index.php/pandan/view/'+obj.id;
			}	
	});
},'json');


