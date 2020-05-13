$(document).ready(function($){

    var win_w=$(window).width();//текущая ширина экрана
    
  var vseImg=$("img.img_this").map(function(v_index,elem){  //собираются все ссылки на изображения и за одно подготовка к lazyload
  	                if (v_index<4){ return $(elem).attr("src");}// это пропускаются первые изображения от назойливого внимания lazyload
  	                  	else {
  	                  	var zx=$(elem).attr("src");
  	                  	 $(elem).addClass("lazy");
                     var dataoriginal=$(elem).attr("src");
					  $(elem).attr("data-original", dataoriginal);
					  $(elem).attr("src", "js/free-preloaders3c.gif");
					  return zx;
					        }
					 });

          $("img.lazy").show().lazyload({  // эффект lazyload к viewer отношения не имеет, но без него долго грузится
        threshold : 1200,
        effect : 'fadeIn'
      }); 
if (win_w<1080) {return;}
	 var count_img=0;
	  var img_Big_now=0;
	  var width_tec=win_w-160;
	  var border_left=148;
	     var str_chislo_vsego=vseImg.length;// этот параметр нужен если просмотр части галлереи закрыт для бесплатного просмотра
	  build_table(str_chislo_vsego,vseImg.length); //построение таблицы в меню всплывающем с ссылками на страницы
 ////////первый клик по img галереи
        $("img.img_this").click(function(event){

		  if (img_Big_now==1) return;
		  img_Big_now=1;
		  // $(".all_img").css({"opacity":"0.3"});
		   /*
		   var zx=$(document).scrollTop()+10;
		  $("#maximg").css({"top": zx,
                          "display":"block"
                           });
                           */
			 count_img=$("img.img_this").index(this);
           		var attrSrc=vseImg.get(count_img);
          //var this_left=($(window).width() - $(this).width())/2;
		  //if (this_left < 70) this_left=70;
		  /*
            $("<img src='"+attrSrc+"'>").appendTo("#maximg").css({
          "width":width_tec,
		  "left": border_left+"px",
		  "position":"absolute",
          "display":"none"          
            }).fadeIn(1000);
         $("#panelupr").css({"display":"block",
		                    "top":"30px"
							});			
		 $("#this_nomer").text("страница №"+(count_img+1));	
		 */
		 next_img(count_img,attrSrc,border_left,width_tec); 
		});  ///конец первый клик по img галереи

		 //переход вперед внутри #maximg через клик по картинке (или второй клик по уже открытой картинке с целью перейти на следующую)
       $("#maximg").delegate("img","click",function(event){
	     

			if (count_img+1>=vseImg.length) {
			                   /*
                            if (str_chislo_vsego >vseImg.length) { 
                                                 
                                                oplata_window();
                                                  }
												  */
										//forma_oplati();	//или сообщение, что картинка последняя
										alert("это последнее изображение");	  
                                           return;}
			  var gh="#maximg>img:eq("+count_img +")";
		    $(gh).css({"opacity":"0.8"});
			count_img++;
          var attrSrc=vseImg.get(count_img);
		 
          next_img(count_img,attrSrc,border_left,width_tec);          		   
	   });// конец  переход вперед внутри #maximg через клик по картинке


         //клик по назад
       $("#nazad").click(function(){
	   
	   if (count_img==0) return;
	   
	   var gh="#maximg>img:eq("+count_img +")";
		    $(gh).css({"opacity":"0.8"});
	   count_img--;
	   var attrSrc=vseImg.get(count_img);
	   next_img(count_img,attrSrc,border_left,width_tec);
	   });	//end клик по назад

       //клик по вперёд
	    $("#vpered").click(function(){
        if (count_img+1>=vseImg.length) {
			                   /*
                            if (str_chislo_vsego >vseImg.length) { 
                                                 
                                                oplata_window();
                                                  }
												  */
									//forma_oplati();	
									alert("это последнее изображение");	 		  
                                           return;}
			  var gh="#maximg>img:eq("+count_img +")";
		    $(gh).css({"opacity":"0.8"});
			count_img++;
          var attrSrc=vseImg.get(count_img);
		 
           next_img(count_img,attrSrc,border_left,width_tec);  

           });// end клик по вперед
        //клик по увеличить
		$("#uveli4").click(function(){
		 $("#maximg>img:last-child").animate({
                              width: '+=140px'
                                                        }); 
                                                   
            width_tec=width_tec+140;    

                               $("#maximg").animate({
                                    left: '-=70'
                                  });

                               $("#maximgX").animate({
                                    left: '+=140'
                                  });
		});//end клик по увеличить

        //клик по уменьшить		
        $("#umen").click(function(){

        	if (width_tec<200) return;

		 $("#maximg>img:last-child").animate({
                              width: '-=140px'
                                                        }); 
                           
						   $("#maximgX").animate({
                            left: '-=140px'
                           });
                                                      
               width_tec=width_tec-140;    
                               $("#maximg").animate({
                                    left: '+=70'
                                  });
		});//end клик по уменьшить

////НАВЕДЕНИЕ на часть меню ВСЕ СТРАНИЦЫ
             $("#vveditenomer").hover(
                   function(){
                 $("#kolvostranitc_map").css({"visibility":"visible"});
                              },
                 function(){
                       $("#kolvostranitc_map").hover(
                              function(){},
                              function(){$("#kolvostranitc_map").css({"visibility":"hidden"});
                                          });
                 
                  
                              } );
              $(".nomerimg").delegate("a","click",function(event){ //клик по выбранному в выпавшей таблице номеру картики
        // PredvDogruz();
        var z=Number($(event.delegateTarget).text());
        
         var gh="#maximg>img:eq("+count_img +")";
        $(gh).css({"opacity":"0.8"});
                                                                
         
        
          count_img=z-1;
          var attrSrc=vseImg.get(count_img);
            
               	
        	next_img(count_img,attrSrc,border_left,width_tec);		   
											                       });
												//// конец меню при наведении на "все страницы"	

		///закрытие по клику на X
           $("#maximgX").click(function(event){ // крестик над картинкой
      
              img_Big_now=close_all();
       });


             $("#close_all_panel").click(function(event){ // и закрытие по крестику на панели управления
        
                img_Big_now=close_all();
                                                        });
         
       //конец закрытия по клику на X

		//закрытие по клику по любому месту кроме пространства страницы
	   /*
		  $(document).mouseup(function (e){ // событие клика по веб-документу
    var div = $("#maximg"); // тут указываем ID элемента
    var panelupravl=$("#panelupr");
    if ((!div.is(e.target) // если клик был не по нашему блоку
        && div.has(e.target).length == 0)&&(!panelupravl.is(e.target) && panelupravl.has(e.target).length ==0)) { // и не по его дочерним элементам
     // $(".page").css({"opacity":1});
      
      div.fadeOut(1000,function(){
        
       // img_Big_now=0;
       // $("#maximg>img").remove();
      }); // скрываем его
      
     // panelupravl.fadeOut(1000);
     
     
	  
    }
	
  });
    */
        ////конец закрытие по клику по любому месту кроме пространства страницы
});//последняя скобка $(document).ready(function($){

function next_img(count_img,attrSrc,border_left,width_tec) { //правильнее было назвать this_img или vivod_img
      var zx=$(document).scrollTop()+10;////пододвигает на верх картинки
	   $("#maximg").css({"top": zx,
	                     "display":"block"});
    // var this_left=($(window).width() - $("img.everybody_img:eq("+count_img+")").width())/2;
	 
		  //if (this_left < 70) this_left=70;
            $("<img src='"+attrSrc+"'>").appendTo("#maximg").css({
		  "width":	width_tec,
          "left": border_left+"px",
		  "position":"absolute",
          "display":"none"          
            }).fadeIn(1000,function(){
			clear_not_last();
			});
			
         $("#panelupr").css({"display":"block",
		                    "top":"30px"
							});
             							
		 $("#this_nomer").text("страница №"+(count_img+1));

		  $("#maximgX").css({
                                "position":"relative",
                                 "left":width_tec+120,
                                 "top":"0"
          });
		 
		//$(".all_img").css({"opacity":"0.5"}); 
		$("#fon_maximg").css({"display":"block"});
		
}


function clear_not_last(){
	if ($("#maximg>img").length==1) return;
    $("#maximg>img").prev("img").remove();
} 

function close_all(){
	 $("#fon_maximg").fadeOut(800);
        $('#maximg').fadeOut(800,function(){
          
          
            
        $("#maximg>img").remove();
        
        });
        
       //$("#maximgX").css({"display":"none"});
       
       $("#panelupr").fadeOut(800);
       return 0;
}
function build_table(str_chislo_vsego=vseImg_length,vseImg_length) {  ////функция построения таблицы, что принаведении курсора в  меню ВСЕ СТРАНИЦЫ
	
	      var td=20;//число столбцов
       var tr=Math.ceil(str_chislo_vsego/td);//число строк
       var table="<table class='kolvostranitc_map'>";//определяем переменную,где будет таблица
       var nomerimg=1;
       for (var j=1; j<=tr;j++){
        table +="<tr>";
          for (var i=1;i<=td;i++){
            if (nomerimg<=str_chislo_vsego){ 
                                   if (nomerimg <= vseImg_length) {
                                             table += "<td><div class='kolvostranitc_map nomerimg'><center><a href='' onclick='return false' nomerimg='"+nomerimg+"'>"+nomerimg+"</a></center></div></td>";}
                                   else { table +="<td><div class='kolvostranitc_map dlyavip'><center><a title='только по подписке' href='' onclick='return false'>"+nomerimg+"</a></center></div></td>";}
                                             } else {table +="<td></td>";}
            nomerimg++;
          }
        table +="</tr>";
       }
       table +="</table>";
	   $("#kolvostranitc_map").append(table);
       $(".kolvostranitc_map").css({"margin":"2px",
                                     "width":"29px",
									 "fontWeight":"bold",
									 "backgroundColor":"rgba(227, 97, 16, 0.5)"});
		$(".kolvostranitc_map>center>a").css({"textDecoration":"none"});							 
        $("#kolvostranitc_map").css({"position":"absolute",
                                      "top":0,
                                     "left":"0px",
                                     "backgroundColor":"rgba(231, 242, 12, 0.5)",
                                     "visibility":"hidden"
                                                       });
		$(".dlyavip").css({"backgroundColor":"rgba(250, 37, 37, 0.6)"});
		$("#vveditenomer").css({"position":"relative"});
}