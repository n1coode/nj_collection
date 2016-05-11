$(document).ready(function()
{
	$('NAV UL.sub').each(function()
	{
		var maxWidth = $(this).outerWidth(true);
		var comWidth = 0;
				
		$(this).children('LI').each(function()
		{
			comWidth = njMeasureText($(this).children('A').text(), 'OpenSans', '14px');
			if(comWidth > maxWidth)
			{
				maxWidth = comWidth;
			}		
		});
		$(this).css('width',maxWidth+'px')
	});
	
	$('.scrollup').click(function () {
	    $("html, body").animate({
	        scrollTop: 0
	    }, 600);
	    return false;
	});
});


$(window).scroll(function() 
{
	if($(this).scrollTop() > (parseInt($(window).outerHeight()))/2) 
	{
		$('#scrollToTop').fadeIn(750); 
    }
    else 
    {
    	$('#scrollToTop').fadeOut(1000);
    }
});


$(function(){
	$('NAV.top UL.top > LI.inclSub').hover(
		function() { $(this).children('UL').show(); },
		function() { $(this).children('UL').hide(); }
	);
});
$(function(){
	$('NAV UL.top > LI > UL.sub > LI').hover(
		function() { $(this).children('UL').show(); },
		function() { $(this).children('UL').hide(); }
	);
});
$(function(){
	$('#vkNavigation>DIV.vkWrapper>DIV.con UL.top > LI > UL.sub > LI > UL.bottom > LI').hover(
		function() { $(this).children('UL').show(); },
		function() { $(this).children('UL').hide(); }
	);
});
$(function(){
	$('#vkNavigation>DIV.vkWrapper>DIV.con UL.top > LI > UL.sub > LI > UL.bottom > LI > UL.down > LI').hover(
		function() { $(this).children('UL').show(); },
		function() { $(this).children('UL').hide(); }
	);
});


function njMeasureText(tText, tFont, tFontsize)
{
	//TODO get automatically Fontsize / Fontfamily / Letterspacing and so on 
	var width;
	
	$('body').append('<span id="njNavInit"></span>');
	$('#njNavInit')
		.css('top', '-1000px').css('left', '-1000px')
		.css('font-family', tFont)
		.css('font-size', tFontsize);
	
	$('#njNavInit').append(tText);
	
	width = $('#njNavInit').outerWidth();
	
	$('#njNavInit').remove()
	
	return width + 30;
}