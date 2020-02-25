( function( $ ) {
	$( document ).ready(function() {
		$('#cssmenu > ul > li > a').click(function() {
		  $('#cssmenu li').removeClass('active');
		  $(this).closest('li').addClass('active');	
		  var checkElement = $(this).next();
		  if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
			$(this).closest('li').removeClass('active');
			checkElement.slideUp('normal');
		  }
		  if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
			$('#cssmenu ul ul:visible').slideUp('normal');
			checkElement.slideDown('normal');
		  }
		  if($(this).closest('li').find('ul').children().length == 0) {
			return true;
		  } else {
			return false;	
		  }		
		});
		/*Based on Payment type, show bank information*/	
		$("#paymentType").change(function(){
			if($(this).val()=="bank"){
				$(".bank_name, .bank_type").show();
			}else{
				$(".bank_name, .bank_type").hide();
			}
		});

		/*If spouse is working, allow the user to keyin company name*/	
		$("#dropSpouse").change(function(){
			alert($(this).val());
			if($(this).val()=="Y"){
				$(".company_name").show();
			}else{
				$(".company_name").hide();
			}
		});
		//Close the open accodian 
		$('#accordion a').click(function(e) {
			$('.collapse').collapse('hide');
		});
		
	});

} )( jQuery );
