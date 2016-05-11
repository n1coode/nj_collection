
function NjCollectionCarousel($uid,$action)
{
	console.log('NjCollectionCarousel instantiated');
	
	this.njcollection_extkey		= 'tx_njcollection';
	this.controller					= 'carousel';
	this.action						= $action;
	this.uid						= $uid;
	
	this.selectors					= [];
	this.selectors['base']			= '.' + this.njcollection_extkey + '.'+this.controller + '.' + this.action;	
	this.selectors['collection']	= '.collection';
	this.selectors['item']			= '.item';
	
	this.viewport_width;
	this.number_of_items;
	this.collection;
	
	this.njCollection			= new NjCollection();

	this.timeoutInterval;

	this.initialize();
	//var njCollection = new NjCollection();
	//alert(njCollection.getDimensions(njCollection._ACTION_GET_WIDTH_VIEWPORT));
	
};


NjCollectionCarousel.prototype.initialize = function()
{
	this.viewport_width = this.njCollection.getDimensions(this.njCollection._ACTION_GET_WIDTH_VIEWPORT);
	this.collection = $(this.selectors.base+'[data-uid='+this.uid+']'+' '+this.selectors.collection);
	setTimeout(this.start(this.action),500);
	this.set(this.action);
};

NjCollectionCarousel.prototype.set = function(action)
{
	switch(action)
	{
		case 'index':
			this.indexSet();
			break;
		default:;
	}
};

NjCollectionCarousel.prototype.indexSet = function()
{
	this.number_of_items = this.collection.children(this.selectors.item).length;
	if(this.number_of_items > 0)
	{
		var zindex = 100;
		var i = 1;
		this.collection.children(this.selectors.item).each(function()
		{
			$(this).css( {'zIndex' : zindex-i } );
			i++;
		});
		this.collection.children(this.selectors.item)
		.not(this.collection.children(this.selectors.item).first())
		.each(function()
		{
			$(this).css({opacity:0});
		});
	}
};


NjCollectionCarousel.prototype.start = function(action)
{
	switch(action)
	{
		case 'index':
			this.indexStart();
			break;
		default:;
	}
};

NjCollectionCarousel.indexFade = function(
	uid,
	collection,
	selectors
)
{
	var collection = collection;
	var selectors = selectors;
	
	var zindex = 100;
	var actElement = collection.children(selectors.item + '[data-status="'+NjCollection._STATUS_ACTIVE+'"]');
	
	var nextElement = actElement.next();

	if(actElement.is(":last-child"))
	{
		nextElement = collection.children(selectors.item).first();
	}

	actElement.css({zIndex:zindex}).animate({opacity:0},1500,'easeOutBounce',function(){ $(this).attr("data-status",NjCollection._STATUS_INACTIVE); });
	nextElement.css({zIndex:zindex-1}).animate({opacity:100},750,'easeInBounce',function(){ $(this).attr("data-status",NjCollection._STATUS_ACTIVE); });
};

NjCollectionCarousel.prototype.indexStart = function()
{
	this.collection.children(this.selectors.item).first().attr("data-status",NjCollection._STATUS_ACTIVE);
	this.collection.parent().find('.overlay').animate({backgroundColor:'transparent'},1500,'easeOutBounce',function(){});
	
	var self = this;
	this.timeoutInterval = setInterval(function() 
	{
		NjCollectionCarousel.indexFade(
			self.uid,
			self.collection,
			self.selectors);
	},5000);
};

