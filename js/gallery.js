$(document).ready(function(){
	// сохранение описания данной галереи
	$('.button_for_main_info').click(function(){
		var main_info=$("[name='main_info']").val();
		var Str = location.href;
        var tmpStr  = Str.match("photos/(.*)/index");
        var newStr = tmpStr[1];
		console.log('этот сайт='+ document.location.host +' '+ 'path= '+ newStr + ' '+ document.URL +'i am work'+ main_info);

		 $.ajax({
           type:'post',
           url:'../../ajax/ajaxrequest.php',
           data: {'label':'save_main_info',
                  'directory': newStr,
                  'data_save': main_info
       },
       success: function(data){
       	
       	
       }
       }
		 	);
	});
	$('button.rename').click(function(){ // переименование изображений
		$(this).siblings('img').css("border","3px solid red");
		$(".modal_window_rename").html('<span id="old_name">'+$(this).siblings('img').attr('src')+'</span>'+' переименовать на <br><input type="text" name="new_name" value="'+$(this).siblings('img').attr('src')+'">');
		
	});
	$('button.save_rename').click(function(){
         var new_name = $('[name="new_name"]').val();
         var old_name = $('#old_name').text();
         console.log("новое имя файла  "+ new_name + ",а старое"+ old_name);
         var Str = location.href;
        var tmpStr  = Str.match("photos/(.*)/index");
        var newStr = tmpStr[1];
        console.log("path to galer= "+newStr);
          $.ajax({
           type:'post',
           url:'../../ajax/ajaxrequest.php',
           data: {'label':'rename_img',
                  'new_name': new_name,
                  'old_name': old_name,
                  'directory': newStr
       },
       success: function(data){
       	console.log(data);
       	$('#renameModal').modal('hide');
       	location.reload();
       
       }
       }
		 	);
	});
	

	$('button.rename_this_file').click(function(){
		var new_name = $('[name="rename"]').val();
		console.log("новое имя файла "+ new_name);
	});
	$('button.add_description').click(function(){
		var this_img_description = $(this).siblings('.description_this_img').html();
		$('textarea[name="description_this_img"]').html(this_img_description);
		 $('.name_this_img').html($(this).siblings('img').attr('src'));
	});
	$('button.save_description_img').click(function(){
		var this_img_description = $('textarea[name="description_this_img"]').val();
		 if (this_img_description=="") {console.log('empty');
// проверить существование текстового файла и удалить его!!!
		  return}
		   var name_this_img=$('.name_this_img').text();
		 var Str = location.href;
        var tmpStr  = Str.match("photos/(.*)/index");
        var newStr = tmpStr[1];
        console.log("path to galer= "+newStr);
		 $.ajax({
		 	  type:'post',
           url:'../../ajax/ajaxrequest.php',
           data: {'label':'description_img',
                  'description': this_img_description,
                  'name_this_img': name_this_img,
                  'directory': newStr
       },
       success: function(data){
       	console.log(data);
       	$('#renameModal').modal('hide');
       	location.reload();
       
       }
		 });


	});

  $(".save_meta_description").click(function(){
    
       var meta_description=$("[name='meta_description']").val();
       $("[name='meta_description']").val('');
     var Str = location.href;
        var tmpStr  = Str.match("photos/(.*)/index");
        var newStr = tmpStr[1];
        console.log(meta_description);
    $.ajax({
      type:'post',
      url:'../../ajax/ajaxrequest.php',
      data:{'label':'meta_description',
             'directory': newStr,
             'meta_description': meta_description},
             success: function(data){
              console.log(data);
              location.reload();
             }
    });

  });// end_.save_meta_description
});