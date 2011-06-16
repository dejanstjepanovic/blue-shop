/**
 * @author Dejan Stjepanovic <stj.dejan@gmail.com>
 */

(function($){
	$.fn.extend({
		mbSlider: function(opts){
			var opts,slide,container,defaults,run,currentS;
			currentS 	= 2;
			slide 		= $(this);
			container 	= slide.find('.slide-container');
			defaults 	= {
				animPause	: 6000,
				animDur		: 1000,
				animTypeI	: 'h',	//h - horisontal, v - vertical, f - fade (images)
				animTypeD	: 'f',	//h - horisontal, v - vertical, f - fade (decription)
				withImgs	: null,
				withDesc	: null,
			};
			
			prepairOpts();
			makeElementsImg();
			makeElementsDesc();
			run = setInterval(loopAnim, opts.animPause);
			
			function loopAnim(){
				animImgs(currentS);
				animDesc(currentS);
				if (++currentS > opts.countS) currentS = 1;
			}
			
			function animImgs(sl){
				var sl;
				if (!opts.withImgs) return;
				switch(opts.animTypeI) {
					case 'h':
						var left = opts.mainWidth - (opts.mainWidth * sl);
						slide.find('.slide-img-cont').animate({left:left}, opts.animDur);
						break;
					case 'f':
						var show = slide.find('.slide-img').get(sl-1);
						slide.find('.slide-img').css({'z-index':'200'}).fadeOut(opts.animDur);
						$(show).css({'z-index':'201'}).fadeIn(opts.animDur);
						break;
					/*case 'v':
						break;*/
					default: 
						break;
				}
			}
			
			function animDesc(sl){
				var sl;
				if (!opts.withDesc) return;
				switch(opts.animTypeD) {
					case 'h':
						var left = opts.descWidth - (opts.descWidth * sl);
						slide.find('.slide-desc-cont').animate({left:left}, opts.animDur);
						break;
					case 'f':
						var show =  slide.find('.slide-desc').get(sl-1);
						slide.find('.slide-desc').css({'z-index':'205'}).fadeOut(opts.animDur);
						$(show).css({'z-index':'206'}).fadeIn(opts.animDur);
						break;
					/*case 'v':
						break;*/
					default: 
						break;
				}
			}
			
			function makeElementsImg(){
				if (!opts.withImgs) return;
				slide.append('<div class="slide-img-wrap"><div class="slide-img-cont"></div></div>');
				slide.find('.slide-img').each(function(){
					slide.find('.slide-img-cont').append('<div class="slide-img" style="background-image:url(\'' 
						+ $(this).attr('src') + '\');width:' + opts.mainWidth  + 'px;height:' 
						+ opts.mainHeight  + 'px"></div>');
					$(this).remove();
				});
				slide.find('.slide-img-wrap').css({
						width	:opts.mainWidth, 
						height	:opts.mainHeight, 
						overflow:'hidden',
						position:'absolute', 
						top		:'0', 
						left	:'0'
					});
				slide.find('.slide-img-cont').css({
						width	:opts.mainWidth*opts.countS, 
						height	:opts.mainHeight, 
						position:'absolute', 
						top		:'0', 
						left	:'0', 
					});
				slide.find('.slide-img').css({
						width	 :opts.mainWidth, 
						height	 :opts.mainHeight,
						'z-index':'200'
					});
					
				switch (opts.animTypeI) {
					case 'h':
						slide.find('.slide-img').css({
								'float'	 :'left'
							});
						break;
					case 'f':
						slide.find('.slide-img-cont').css({
								width	:opts.mainWidth
							});
						slide.find('.slide-img').css({
								position:'absolute', 
								top		:'0', 
								left	:'0', 
							}).hide().first().show();
						break;
					/*case 'v':
						break;*/
					default: 
						break;
				}
			}
			
			function makeElementsDesc(){
				if (!opts.withDesc) return;
				slide.append('<div class="slide-desc-wrap"><div class="slide-desc-cont"></div></div>');
				container.find('.slide-desc').each(function(){
					slide.find('.slide-desc-cont').append($(this), function(){
						$(this).remove();
					});
				});
				slide.find('.slide-desc-wrap').css({
						width	:opts.descWidth, 
						height	:opts.descHeight, 
						overflow:'hidden',
						position:'absolute', 
						top		:'0', 
						left	:opts.mainWidth-opts.descWidth
					});
				slide.find('.slide-desc-cont').css({
						width	:opts.descWidth*opts.countS, 
						height	:opts.descHeight, 
						position:'absolute', 
						top		:'0', 
						left	:'0', 
					});
				slide.find('.slide-desc').css({
						width	 		 :opts.descWidth-opts.descPadding.l-opts.descPadding.r, 
						height	 		 :opts.descHeight-opts.descPadding.t-opts.descPadding.b,
						'padding-top'	 :opts.descPadding.t+'px',
						'padding-right'	 :opts.descPadding.r+'px',
						'padding-bottom' :opts.descPadding.b+'px',
						'padding-left'	 :opts.descPadding.l+'px',
						'z-index'		 :'205'
					});
					
				switch (opts.animTypeD) {
					case 'h':
						slide.find('.slide-desc').css({
								'float'	 :'left'
							});
						break;
					case 'f':
						slide.find('.slide-desc-cont').css({
								width	:opts.descWidth
							});
						slide.find('.slide-desc').css({
								position:'absolute', 
								top		:'0', 
								left	:'0', 
							}).hide().first().show();
						break;
					/*case 'v':
						break;*/
					default: 
						break;
				}
			}
			
			function prepairOpts(){
				opts = $.extend(defaults, opts);
				
				if (opts.countS = slide.find('.slide-img').length) opts.withImgs = true;
				
				if (typeof(opts.mainWidth) == 'undefined')
					opts.mainWidth = slide.width();
				else
					opts.mainWidth = parseInt(opts.mainWidth);
				if (typeof(opts.mainHeight) == 'undefined')
					opts.mainHeight = slide.height();
				else
					opts.mainHeight = parseInt(opts.mainHeight);
				
				if (opts.countS = slide.find('.slide-desc').length) {
					opts.withDesc = true;
					if (typeof(opts.descWidth) == 'undefined')
						opts.descWidth = (opts.withImgs) ? parseInt(opts.mainWidth / 3) : opts.mainWidth;
					else 
						opts.descWidth = parseInt(opts.descWidth);
					if (typeof(opts.descHeight) == 'undefined') 
						opts.descHeight = parseInt(opts.mainHeight);
					else 
						opts.descHeight = parseInt(opts.descHeight);
					
					opts.descPadding = {
						t: parseInt(slide.find('.slide-desc').css('padding-top')),
						r: parseInt(slide.find('.slide-desc').css('padding-right')),
						b: parseInt(slide.find('.slide-desc').css('padding-bottom')),
						l: parseInt(slide.find('.slide-desc').css('padding-left'))
					};
				}
			}
		}
	});
})(jQuery);
