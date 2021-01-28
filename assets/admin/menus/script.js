
// JavaScript Document
$(function(){
	$('.sidebar-menu > li').each(function(i,obj){
		//console.log(obj);
		var objactive = false;
		if($(obj).hasClass('treeview')){
			$.each($(obj).find('ul > li'),function(i,o){
				acKeys = $(o).attr('data-active');  
				if(acKeys){
					activeFor = acKeys.split(',');
					$.each(activeFor,function(i,oj){
						if(urlseg==$.trim(oj)){
							$(o).addClass('active');
							objactive = true;
						}
					});
				 }
			});
			
			if(objactive){
				$(obj).addClass('active');
				$(obj).find('ul').addClass('menu-open');
			}
		}else{
			acKeys = $(obj).attr('data-active');  
			if(acKeys){
				activeFor = acKeys.split(',');
				$.each(activeFor,function(i,o){
					if(urlseg==$.trim(o)){
						$(obj).addClass('active');
					}
				});
			 }
		}
		
	  });
	
	$('.icheck').iCheck({
	  checkboxClass: 'icheckbox_minimal-blue',
	  radioClass: 'iradio_minimal-blue',
	  increaseArea: '20%' // optional
	});

});

function call_loader(){
	
	if($('#overlay').length == 0 ){
		var over = '<div id="overlay">' +
						'<img id="loading" src="" />'+
				   '</div>';
		
		$(over).appendTo('body');
	}
}

function loader_status()
{
	flag = false;
	if($('#overlay').length>0)
		flag = true;
	
	return flag;	
}

function remove_loader()
{
	$('#overlay').remove();
}


function alert_box(block,type,result)
{
	html = '<div class="alert alert-'+type+' alert-dismissable">'+
				'<i class="fa fa-ban"></i>'+
				'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
				'<strong> Oh snap!</strong> '+result+
			'</div>';
	
	$(block).append(html).show('slow');	
}

function areyousure()
{
	return confirm(are_you_sure+'?');
}

