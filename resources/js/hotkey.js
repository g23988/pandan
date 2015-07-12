
var baseHref = document.getElementsByTagName('base')[0].href
var isAlt = false;
//快速進入start偵測 複合健alt + s
function quickstart(event){
	 if (event.keyCode == 18) {
		 isAlt = true;
		 };
	 if (event.keyCode == 65 && isAlt) {
	 	window.location.replace(baseHref+'index.php/pandan/pandanByHost/all');
	 	};
	 if (event.keyCode == 78 && isAlt) {
	 	window.location.replace(baseHref+'index.php/pandan/pandanByHost/never');
	 	};
	};
$(function(){
	$(window).bind('keydown', quickstart);
	});
