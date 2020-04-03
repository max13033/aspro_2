equalWideBlockHeight = function(){
	if($('.wide-block').length) //sliceheight for wide block
	{
		if(window.matchMedia('(min-width: 768px)').matches)
		{
			$('.wide-block').each(function(){
				$(this).css('height', '');
				var _this = $(this),
					parent_block = _this.closest('.items'),
					block_height = _this.actual('outerHeight', { includeMargin : true })-1,
					margin = parseInt($('.wide-block').css('margin-bottom')),
					equal_height = 0;

				if(parent_block.find('.col-item').length)
				{
					parent_block.find('.col-item .item').css('height', '');
					parent_block.find('.col-item').each(function(){
						equal_height += $(this).actual('outerHeight', { includeMargin : true })-36.5;
					})

					if(equal_height)
					{
						equal_height -= margin;
						if(equal_height >= block_height)
							_this.css('height', equal_height);
						else
						{
							equal_height += margin;
							var last_item = parent_block.find('.col-item:last-child .item');
							last_item.css('height', (last_item.actual('outerHeight') + (block_height - equal_height)));
						}
					}
				}
			})
		}
		else
		{
			$('.wide-block').css('height', '');
			$('.col-item .item').css('height', '');
		}
		$('.top_inner_block_wrapper').css({'padding-bottom':'10px'})
	}

	$('#white-curtain').hide();

	/*if ($('.b-project-list').length && $('.b-project-list .col-md-4.col-sm-4 .b-project-list__wrapper').length>=2) {
		h = $('.b-project-list .col-md-4.col-sm-4 .b-project-list__wrapper').height()
		h = h*2
		h = h - $('.b-project-list .col-md-8.col-sm-8 .prev_text-block').height()
		h = h-18
		$('.b-project-list .col-md-8.col-sm-8 .animation-boxs').css('height', h+'px')
	}*/
}
$(document).ready(function(){
	BX.onCustomEvent('onWindowResize', false);
	equalWideBlockHeight();
	$('.banners-small.blog img').on('load', function(){
		equalWideBlockHeight();
		$('.banners-small .item.normal-block').sliceHeight();
	});
})


BX.addCustomEvent('onWindowResize', function(eventdata) {
	try{
		ignoreResize.push(true);
		equalWideBlockHeight();
	}
	catch(e){}
	finally{
		ignoreResize.pop();
	}
});
BX.addCustomEvent('onCompleteAction', function(eventdata){
	if(eventdata.action === 'ajaxContentLoaded')
	{
		$(eventdata.content).find('.item').each(function(){
			$('.banners-small.blog img').on('load', function(){
				equalWideBlockHeight();
				$('.banners-small .item.normal-block').sliceHeight();
			});
		})
		setTimeout(function(){
			equalWideBlockHeight();
		}, 350);
	}
});
