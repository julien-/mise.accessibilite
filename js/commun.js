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

function isValidDate(date)
{
    var matches = /^(\d{2})[/\/](\d{2})[/\/](\d{4})$/.exec(date);
    if (matches == null) return false;
    var d = matches[1];
    var m = matches[2] - 1;
    var y = matches[3];
    var composedDate = new Date(y, m, d);
    return composedDate.getDate() == d &&
            composedDate.getMonth() == m &&
            composedDate.getFullYear() == y;
}

function alertSuccess(message) {
	
    $('#alerts').append('<div class="col-lg-3"> '+ 
    		'</div>' + 
    		'<div class="col-lg-6 center-block">' +
    			'<div style="position: absolute; z-index: 9999; top:0px; width: 80%;" class="alert alert-success center-text center-block">'+
    		    	'<a href="#" class="close" data-dismiss="alert">&times;</a>'
    		    	+ message +
    			'</div>' + 
    		'</div>' + 
    			'<div class="col-lg-3">' + 
    		'</div>');
    
    var top = $('.alert').offset().top;
    $('.alert').css('top',Math.max(top,$(document).scrollTop()));
      
    $(document).scroll(function(){
        $('.alert').css('position','');
        top = $('.alert').offset().top;
      $('.alert').css('position','absolute');   $('.alert').css('top',Math.max(top,$(document).scrollTop()));
    });
    
	  $('.alert').fadeOut( 4000, function() {
		  $( ".alert" ).remove();
	  });
}

function alertInfo(message) {
    $('#alerts').append('<div class="col-lg-3"> '+ 
    		'</div>' + 
    		'<div class="col-lg-6 center-block">' +
    			'<div style="position: absolute; z-index: 9999; top:0px; width: 80%;" class="alert alert-info center-text center-block">'+
    		    	'<a href="#" class="close" data-dismiss="alert">&times;</a>'
    		    	+ message +
    			'</div>' + 
    		'</div>' + 
    			'<div class="col-lg-3">' + 
    		'</div>');
    
    var top = $('.alert').offset().top;
    $('.alert').css('top',Math.max(top,$(document).scrollTop()));
      
    $(document).scroll(function(){
        $('.alert').css('position','');
        top = $('.alert').offset().top;
      $('.alert').css('position','absolute');   $('.alert').css('top',Math.max(top,$(document).scrollTop()));
    });
    
	  $('.alert').fadeOut( 4000, function() {
		  $( ".alert" ).remove();
	  });
	  
	  $('.alert').fadeOut( 4000, function() {
		  $( ".alert" ).remove();
	  });
}

function alertWarning(message) {
    $('#alerts').append('<div class="col-lg-3"> '+ 
    		'</div>' + 
    		'<div class="col-lg-6 center-block">' +
    			'<div style="position: absolute; z-index: 9999; top:0px; width: 80%;" class="alert alert-warning center-text center-block">'+
    		    	'<a href="#" class="close" data-dismiss="alert">&times;</a>'
    		    	+ message +
    			'</div>' + 
    		'</div>' + 
    			'<div class="col-lg-3">' + 
    		'</div>');
    
    var top = $('.alert').offset().top;
    $('.alert').css('top',Math.max(top,$(document).scrollTop()));
      
    $(document).scroll(function(){
        $('.alert').css('position','');
        top = $('.alert').offset().top;
      $('.alert').css('position','absolute');   $('.alert').css('top',Math.max(top,$(document).scrollTop()));
    });
    
	  $('.alert').fadeOut( 4000, function() {
		  $( ".alert" ).remove();
	  });
	  
	  $('.alert').fadeOut( 4000, function() {
		  $( ".alert" ).remove();
	  });
}

function alertDanger(message) {
    $('#alerts').append('<div class="col-lg-3"> '+ 
    		'</div>' + 
    		'<div class="col-lg-6 center-block">' +
    			'<div style="position: absolute; z-index: 9999; top:0px; width: 80%;" class="alert alert-danger center-text center-block">'+
    		    	'<a href="#" class="close" data-dismiss="alert">&times;</a>'
    		    	+ message +
    			'</div>' + 
    		'</div>' + 
    			'<div class="col-lg-3">' + 
    		'</div>');
    
    var top = $('.alert').offset().top;
    $('.alert').css('top',Math.max(top,$(document).scrollTop()));
      
    $(document).scroll(function(){
        $('.alert').css('position','');
        top = $('.alert').offset().top;
      $('.alert').css('position','absolute');   $('.alert').css('top',Math.max(top,$(document).scrollTop()));
    });
    
	  $('.alert').fadeOut( 4000, function() {
		  $( ".alert" ).remove();
	  });
	  
	  $('.alert').fadeOut( 4000, function() {
		  $( ".alert" ).remove();
	  });
}
 
