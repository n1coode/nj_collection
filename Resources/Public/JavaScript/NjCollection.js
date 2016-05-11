var NjCollection = function(){};

NjCollection._ACTION_GET_HEIGHT				= 'getHeight';
NjCollection._ACTION_GET_HEIGHT_DOCUMENT	= 'documentHeight';
NjCollection._ACTION_GET_HEIGHT_SCREEN		= 'screenHeight';
NjCollection._ACTION_GET_HEIGHT_VIEWPORT	= 'viewportHeight';
NjCollection._ACTION_HIDE					= 'hide';
NjCollection._ACTION_INIT					= 'init';
NjCollection._ACTION_SHOW					= 'show';
NjCollection._ACTION_MAXIMIZE				= 'maximize';
NjCollection._ACTION_MINIMIZE				= 'minimize';
NjCollection._ACTION_GET_WIDTH				= 'getWidth';
NjCollection._ACTION_GET_WIDTH_DOCUMENT		= 'documentWidth';
NjCollection._ACTION_GET_WIDTH_SCREEN		= 'screenWidth';
NjCollection._ACTION_GET_WIDTH_SCROLLBAR	= 'scrollbarWidth';
NjCollection._ACTION_GET_WIDTH_VIEWPORT		= 'viewportWidth';
NjCollection._STATUS_ACTIVE					= 'active';
NjCollection._STATUS_INACTIVE				= 'inactive';


NjCollection.prototype.initialize = function()
{
	
};

NjCollection.prototype.getDimensions = function(type)
{	
	switch(type)
	{
		case NjCollection._ACTION_GET_HEIGHT_DOCUMENT:
			if (typeof document.body.offsetHeight !== 'undefined')
			{
				return document.body.offsetHeight;
			}
			break;
		case NjCollection._ACTION_GET_HEIGHT_SCREEN:
			if (typeof screen.availHeight !== 'undefined')
			{
				return  screen.availHeight;
			}
			break;
		case NjCollection._ACTION_GET_HEIGHT_VIEWPORT:
			if (typeof document.documentElement.clientHeight !== 'undefined')
			{
				return document.documentElement.clientHeight;
			}
			break;
		case NjCollection._ACTION_GET_WIDTH_DOCUMENT:
			if (typeof document.body.offsetWidth !== 'undefined')
			{
				return document.body.offsetWidth;
			}
			break;
		case NjCollection._ACTION_GET_WIDTH_SCREEN:
			if (typeof screen.availWidth !== 'undefined')
			{
				return screen.availWidth;
			}
			break;
		case NjCollection._ACTION_GET_WIDTH_SCROLLBAR:
			return scrollbar();
			break;
		case NjCollection._ACTION_GET_WIDTH_VIEWPORT:
			if (typeof document.documentElement.clientWidth !== 'undefined')
			{
				return document.documentElement.clientWidth;
			}
			break;
		default:;
	} //end of switch
	
	function scrollbar()
	{
		var outer = document.createElement("div");
		outer.style.visibility = "hidden";
		outer.style.width = "100px";
		document.body.appendChild(outer);

		var widthNoScroll = outer.offsetWidth;
		// force scrollbars
		outer.style.overflow = "scroll";

		// add inner div
		var inner = document.createElement("div");
		inner.style.width = "100%";
		outer.appendChild(inner);        

		var widthWithScroll = inner.offsetWidth;

		// remove divs
		outer.parentNode.removeChild(outer);

		return widthNoScroll - widthWithScroll;
	}
};

NjCollection.prototype.setTimoutIntervall = function(func, wait, times)
{
	//http://www.thecodeship.com/web-development/alternative-to-javascript-evil-setinterval/
    var interv = function(w, t){
        return function(){
            if(typeof t === "undefined" || t-- > 0){
                setTimeout(interv, w);
                try{
                    func.call(null);
                }
                catch(e){
                    t = 0;
                    throw e.toString();
                }
            }
        };
    }(wait, times);

    setTimeout(interv, wait);
};