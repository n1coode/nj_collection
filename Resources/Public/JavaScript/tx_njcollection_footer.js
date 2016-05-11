window.addEventListener('DOMContentLoaded', function() 
{
	setTimeout(function()
	{  
		if(typeof tx_njcollection_carousel_index_start === 'function' 
			&& $('.tx_njcollection.carousel.index').length > 0)
		{
			n1console("tx_njcollection_carousel_index_start" + " existiert");
			tx_njcollection_carousel_index_start();
		}
		else
		{
			n1console("tx_njcollection_carousel_index_start" + " nicht implementiert");
		}

	}, 1750);
});