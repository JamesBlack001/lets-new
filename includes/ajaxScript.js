	$(document).ready(function(){
		$('#homeLink').on('click',function(e){
			e.preventDefault();
			$('#contentContainer').load('http://localhost/newmvc/mvc/includes/content.php');
		})
	})