$(document).ready(function() {	

	var InfiniteSlider =
	{
		init: function()
		{
			//initial fade-in time (in milliseconds)
			var initialFadeIn = 1000;

			//interval between items (in milliseconds)
			var itemInterval = 6500;

			//cross-fade time (in milliseconds)
			var fadeTime = 1500;

			//count number of items
			var numberOfItems = $('.SLIDER-CONTENT').length;

			//set current item
			var currentItem = 0;

			//show first item
			$('.SLIDER-CONTENT').eq(currentItem).fadeIn(initialFadeIn);

			//loop through the items
			var infiniteLoop = setInterval(function(){
				$('.SLIDER-CONTENT').eq(currentItem).fadeOut(fadeTime);

				if(currentItem == numberOfItems -1){
					currentItem = 0;
				}else{
					currentItem++;
				}
				$('.SLIDER-CONTENT').eq(currentItem).fadeIn(fadeTime);

			}, itemInterval);
		}
	};

	InfiniteSlider.init();
	
});