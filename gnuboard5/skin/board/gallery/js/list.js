;(function ($){
	$.fn.card3D_effect = function(){
		let perspective = '500px',
		delta = 13,
		width = this.width(),
		height = this.height(),
		midWidth = width / 2,
		midHeight = height / 2,
		$this=this;

		//Events
		this.on({
			mousemove: function(e) {
				let pos = $(this).offset(),
				cursPosX = e.pageX - pos.left,
				cursPosY = e.pageY - pos.top,
				cursCenterX = midWidth - cursPosX,
				cursCenterY = midHeight - cursPosY, 
				$card=$(this).find(".gallery-card"), 
				$card_bg=$(this).find(".gallery-card-bg");

				let mouseX= cursPosX - midWidth;
				let mouseY= cursPosY - midHeight;
				let mousePX=mouseX / width;
				let mousePY=mouseY / height;
				// default 30 / 40
				const rX = mousePX * delta;
				const rY = mousePY * delta*-1;
				const tX = mousePX * delta*-2;
				const tY = mousePY * delta*-2;

				$card.css('transform','perspective(' + perspective + ') rotateY('+ (rX) +'deg) rotateX('+ (rY) +'deg)');
				$card_bg.css('transform', 'translateX('+(tX)+'px) translateY('+(tY)+'px)');

				$card.removeClass('is-out');
				$card_bg.removeClass('is-out');
			},
			mouseleave: function(){
				let $card=$(this).find(".gallery-card"), 
				$card_bg=$(this).find(".gallery-card-bg");

				this.mouseLeaveDelay=setTimeout(() => {
					$card.addClass('is-out');
					$card_bg.addClass('is-out');
				}, 500);
			},
			mouseenter: function(){
				clearTimeout(this.mouseLeaveDelay);
			},
		});
		$(window).resize(function(){
			width=$this.width();
			height=$this.height();
			midWidth = width / 2,
			midHeight = height / 2;
		});
		return this;
	};
}(jQuery));

$(function(){
	$('.card-wrap').card3D_effect();
});