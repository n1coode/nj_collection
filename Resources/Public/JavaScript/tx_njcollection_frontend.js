/* 
 * General functions, constants ... that are available at all domains
 */
window.addEventListener('DOMContentLoaded', function() 
{
	requirejs(['jquery','jqueryUI','njCollection','njCollectionCarousel'], function() 
	{
		if($('.tx_njcollection.carousel').length > 0)
		{
			var njCollectionCarousel = [];
			$('.tx_njcollection.carousel').each(function()
			{
				var uid = $(this).attr('data-uid');
				njCollectionCarousel.uid = new NjCollectionCarousel($(this).attr('data-uid'),$(this).attr('data-carousel'));
			});
		}
	});
}); //end of window.addEventListener('DOMContentLoaded')