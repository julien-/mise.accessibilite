$(".icon").click(function() {
	var clickedIndex = $(this).data('id');
	$( ".icon" ).each(function( index ) 
	{
		if (index != clickedIndex)
		{
			$(this).removeClass('glyphicon-minus-sign');
			$(this).addClass('glyphicon-plus-sign');
		}
	});
	
	
	if ($(this).hasClass('glyphicon-plus-sign'))
	{
		$(this).removeClass('glyphicon-plus-sign');
		$(this).addClass('glyphicon-minus-sign');
	}
	else if ($(this).hasClass('glyphicon-minus-sign'))
	{
		$(this).removeClass('glyphicon-minus-sign');
		$(this).addClass('glyphicon-plus-sign');
	}
});