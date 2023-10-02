(function($) {

	
	$(document).on('click','.custom--input-password .eye-icon', function(e){
		e.preventDefault()
		if($(this).parents('.custom--input-password').find('input[type="text"]').length)
		{
			$(this).parents('.custom--input-password').find('input').attr('type','password')
			$(this).removeClass('fa-eye').addClass('fa-eye-slash')
		}else{
			
			$(this).parents('.custom--input-password').find('input').attr('type','text')
			$(this).removeClass('fa-eye-slash').addClass('fa-eye')
		}
	})

 
})(jQuery);
