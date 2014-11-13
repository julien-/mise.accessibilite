/** Messages fading **/
  $( ".fading-alert" ).fadeOut( 4000, function() {
	  $( ".fading-alert" ).addClass('hidden');
  });
  
  $('#nav').affix({
      offset: {
        top: $('header').height()
      }
});	

$('#sidebar').affix({
      offset: {
        top: 500
      }
});	
  