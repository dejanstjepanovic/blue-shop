/* el-finder-manipulation
 * by Bole
----------------------------------------------------------------------------------------------------*/
$(function() {
	/* startup */
	$('<div class="selected-images"><div id="open"></div></div>').insertAfter('#p_images');
	var i=0;
	if($('#p_images').val()){
		images = $("#p_images").val().split(';');
		for(i=0;i<images.length;i++){
			$('.selected-images').prepend('<div class="image-thumb"><img src="/media/images/'+images[i]+'" width="100" height="80" alt=""/></div>');
		}
	}
	var imageCounter=i;
	var values=$('#p_images').val();
	
	/* remove */
	$('.image-thumb').live('mouseenter',function(){
		$(this).append('<img class="remove-image" src="/static/img/layer-remove.png" alt="">');
	});
	$('.image-thumb').live('mouseleave',function(){
		$(this).children('.remove-image').remove();
	});
	$('.image-thumb').live('click',function(){
		removed = $(this).children('img').attr('src').replace('/media/images/','');
		$(this).animate({width:'0px'},500,function(){$(this).remove();});
		values = values.replace(removed,'');
		values = values.replace(';;',';');
		if(values.charAt(0)==';') values = values.substring(1,values.length);
		if(values.charAt(values.length-1)==';') values = values.substring(0,values.length-1);
		$('#p_images').val(values);
		imageCounter--;	
	});
	
	/* elfinder popup */
	$('#open').live('click',function() {
		$(this).append('<div id="finder"></div>');
		$('#finder').elfinder({
			url : '/admin/el-finder/product-images',
			docked : false,
			dialog : {
				title : 'File manager',
				height : 500
			},
			editorCallback : function(url) {
				url = url.replace('/media/images/',''); 
				imageCounter++;
				switch(imageCounter){
				case 1: 
					values = url;		
				break;
				default:
					values += ';'+url;
				break; 
				}
				$('.selected-images').prepend('<div class="image-thumb"><img src="/media/images/'+url+'" width="100" height="80" alt=""/></div>');
				$('#p_images').val(values);	
			},
			closeOnEditorCallback : true
		});
	});
});
