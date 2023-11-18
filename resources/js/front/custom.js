
$(window).on('load', function(){
	$('body').removeClass('loaded');
	
	$( ".card-wrap img[data-src]" ).each(function(index){
	  src = $( this ).attr('data-src');
	  if ( $( this ).attr('src') === undefined) {
		  // атрибут есть
		  $( this ).attr('src', src);
		}
	});
	
	
});
$.fn.setCursorPosition = function(pos) {
    if ($(this).get(0).setSelectionRange) {
      $(this).get(0).setSelectionRange(pos, pos);
    } else if ($(this).get(0).createTextRange) {
      var range = $(this).get(0).createTextRange();
      range.collapse(true);
      range.moveEnd('character', pos);
      range.moveStart('character', pos);
      range.select();
    }
  };
  
$(function(){
	if(window.location.hash.indexOf('search') == 1) {
	     $('.searth_form_recipe').submit();
	}
	/* Burger */
	/* ---------------------------------------------- */
	$(".show_all").on('click',function(){
		$(".nav_item_btn:not(.show_all)").toggle();
		$("#sticky-wrapper").css( "height", "auto" );
		
		return false;
	});
	
	$(".nav_item_btn:not(.show_all)").on('click',function(){
		if (window.matchMedia('(max-width: 767px)').matches) {
	       $(".nav_item_btn:not(.show_all)").toggle();
	    }	
	});
	
	
	$(".toggle-menu").on('click',function(){
		$(this).toggleClass("is-active");
		$('.mobile-menu').toggleClass('is-open')
		return false;
	});

	$(".add_to_book").on('click',function(){
		$('#add_to_book_modal').toggleClass('show')
		return false;
	});
	
	$(".registerm").on('click',function(){
		$('#registerm').toggleClass('show')
		return false;
	});
	
	
	$(".recipe_book").on('click',function(){
		if($('.logout_btn').length > 0){
			location.href="/account/books";
			return false;
		}else{
			alert('Создавать кулинарные книги могут только авторизованные пользователи!');
			location.href="/account/login";
			return false;
		}
		
	});
	
	$(".add_recipe").on('click',function(){
		if($('.logout_btn').length > 0){
			location.href="/account/add.php?type=recipe";
			return false;
		}else{
			alert('Добавлять рецепты могут только авторизованные пользователи!');
			location.href="/account/login";
			return false;
		}
		
	});
	
	
	
	
	
	$(".error_recipe").on('click',function(){
		$('#error_recipe_modal').toggleClass('show')
		return false;
	});
	
	
	$("#registerm .close_modal").on('click',function(){
		$('#registerm').toggleClass('show')
		return false;
	});
	$("#add_to_book_modal .close_modal").on('click',function(){
		$('#add_to_book_modal').toggleClass('show')
		return false;
	});
	$("#error_recipe_modal .close_modal").on('click',function(){
		$('#error_recipe_modal').toggleClass('show')
		return false;
	});
	
	$(".save_pecite_to_book").on('click',function(){
	
	var form = $('#add_to_book_modal form');
	var myArray = [];
    $("#add_to_book_modal form :checkbox:checked").each(function() {
        myArray.push(this.value);
    });
    
    $('#books_id').val(myArray.join(","));
	if(myArray.length == 0 && $('#new_book').val() == ""){
		alert('Выберите или создайте новую книгу!');
	}else{
		$.ajax({
	        type: "POST",
	        url: '/scripts/books.php',
	       data: form.serialize()
	    }).done(function(data) {
	    	 if(data=='true'){
	        	location.reload();
	        }
	        else{
	        	alert('Ошибка');
	        }
	        
	    });
	}
	
    return false;
	});
	
	
	$(".send_error").on('click',function(){
	
	var form = $('#error_recipe_modal form');
	if($('#error_recipe_modal [name="text"]').val() == ""){
		alert('Необходимо описать ошибку');
		return false;
	}
	$.ajax({
        type: "POST",
        url: '/scripts/send.php',
       data: form.serialize()
    }).done(function(data) {
    	 if(data=='true'){
	    	 alert("Сообщение об ошибке отправлено администрации сайта!")
        	location.reload();
        }
        else{
        	alert('Ошибка');
        }
        
    });
    return false;
	});
	
	
	$(".form-check-label").on('click',function(){
		$(this).toggleClass("is-checked");
		checkBoxes = $(this).find("input");
		if(checkBoxes.prop("checked")==true)
		     checkBoxes.prop("checked", false); 
		   else
		     checkBoxes.prop("checked", true);
		     
		//return false;
	});
	

	$(".rubric__button").on('click',function(){
		$(this).toggleClass("is-active").parent().toggleClass("is-open");
		$('.nav-rubric').slideToggle(300)
		return false;
	});
	$(".counter__input").on('click',function(){
		var currentVal = $(this).val();
		var current_col = $('.input-calc-js').val()
        var portion = currentVal.replace(current_col, '').replace(parseInt(current_col), '');
        
		$(this).val(portion);
		$(this).setCursorPosition(0);
		
		$(".input_title").slideToggle().delay(2000).slideToggle();
		
		return false;
	});
	$( ".counter__input" ).focusout(function(){ 
	    var currentVal = $(this).val();
		var col = parseFloat(currentVal);
		var current_col = $('.input-calc-js').val();
		
		var portion = currentVal.replace(/\d+/g, '');
		
		//current_col = current_col.toFixed(1);
		
		if ( parseInt(current_col) ==  current_col) {
		    current_col = parseInt(current_col);
		  }
		
		if(isNaN(col)){
			$(this).val(current_col + portion);
		}
		
	 });

	$(".sidebar .nr-dropdown > a").on('click',function(){
		$(".sidebar  .nr-dropdown").not($(this).parent()).removeClass('is-active')
		$(this).parent().toggleClass("is-active")
		return false;
	});

	$(".rubric .nr-dropdown > a").on('click',function(){
		$(".sidebar  .nr-dropdown").not($(this).parent()).removeClass('is-active')
		$(this).parent().toggleClass("is-active")
		return false;
	});



		$(document).on('click', '.js-minus',function(){
			
		var col1 = $(this).parent().find('.input-calc-js').val();
		
		if(col1 > 1){
			if(window.startPortionSize == undefined) { window.startPortionSize = col1; }
			var portionType = "int";
			if((Math.ceil(parseFloat(window.startPortionSize)) != parseInt(window.startPortionSize))) { var portionType = "float"; }
			
			if(col1 < 0.1) { return false; }
			
			if(portionType == "int")
			{
				var col = parseInt(col1) - 1;
			}
			else
			{
				var col = parseFloat(col1) - parseFloat(window.startPortionSize);
				var col = col.toFixed(1);            
			}       
			
			var $last = col.toString().substr(-1);
			var $portion;
			
			var currentVal = "0" + $('.counter__input').val();
			
			if(currentVal.indexOf("порци") === -1)
			{
				var $portion = currentVal.replace(/[0-9\.]{2,5}/g, '');
			}
			else
			{
			
				if(col>20 || col<10){
					if($last==0){
						$portion = ' порций';
				}
				else if($last==1){
						$portion = ' порция';
				}
				else if($last>1 && $last < 5){
						$portion = ' порции';
				}
				else if($last > 4 && $last < 10){
						$portion = ' порций';
				}
				}
				else{
					$portion = ' порций';
				}
			
			}

			$('.counter__input').val(col+$portion);
			$('.input-calc-js').val(col);
			$('.input-calc-js').change();
		}
		return false;
	});
	$(document).on('click', '.js-plus',function(){
		var col1 = $(this).parent().find('.input-calc-js').val();
		if(window.startPortionSize == undefined) { window.startPortionSize = col1; }
        var portionType = "int";
        if((Math.ceil(parseFloat(window.startPortionSize)) != parseInt(window.startPortionSize))) { var portionType = "float"; }
                
        if(portionType == "int")
        {
            var col = parseInt(col1) + 1;
        }
        else
        {
            var col = parseFloat(col1) + parseFloat(window.startPortionSize);
            var col = col.toFixed(1);            
        }       
        
		var $last = col.toString().substr(-1);
		var $portion;
        
        var currentVal = "0" + $('.counter__input').val();
                
        if(currentVal.indexOf("порци") === -1)
        {
            var $portion = currentVal.replace(/[0-9\.]{2,5}/g, '');
        }
        else
        {
            
            if(col>20 || col<10){
                if($last==0){
                    $portion = ' порций';
            }
            else if($last==1){
                    $portion = ' порция';
            }
            else if($last>1 && $last < 5){
                    $portion = ' порции';
            }
            else if($last > 4 && $last < 10){
                    $portion = ' порций';
            }
            }
            else{
                $portion = ' порций';
            }
        }
        
        
		$('.counter__input').val(col+$portion);
		$('.input-calc-js').val(col);
		$('.input-calc-js').change();
		return false;
	});
	
	
	$('.counter__input').keyup(function(){
		var col1 = $(this).val();
	        if(window.startPortionSize == undefined) { window.startPortionSize = col1; }
	        var portionType = "int";
	        
	        if((Math.ceil(parseFloat(window.startPortionSize)) != parseInt(window.startPortionSize))) { var portionType = "float"; }
	        
	        if(col1 < 0.1) { return false; }
	        
	         if (this.value.match(/[^0-9]/g)) {
                //this.value = this.value.replace(/[^0-9]/g, '');
            }
	        
	       
            var col = parseFloat(col1);
            var col = col.toFixed(1); 
            var portion = $(this).attr("data-portion-type");
            
         //$(this).val(col + " " + portion);   
                       
	    $('.input-calc-js').val(col);    
		$('.input-calc-js').change();
	});
	
	function filter() {
		
		$('.filter__button').on('click', function(){
			var thisFilter = $(this)
			 $(".filter__button")
				.not(thisFilter)
				.removeClass("is-active")
				.parents(".filter")
				.removeClass("is-open")
				.find(".filter__dropdown")
				.slideUp(200);
			$(this)
				.toggleClass("is-active")
				.parents(".filter")
				.toggleClass("is-open")
				.find(".filter__dropdown")
				.slideToggle(200);
		});

		
			$(document).on('click', '.filter__list li',function(){
			$(this).toggleClass('is-selected');
			var parent = $(this).parents(".filter");
			var count = $(this)
				.parent()
				.find("li.is-selected").length;
			parent.find(".filter__count").html(count);
		})
	}
	filter();

	// Поиск в выпадающем списке
	function searchBox() {
		var ul = $('.filter');
		var input = ul.find('.filter__search input');
		var li = ul.find('li');

		input.keyup(function(){
		  
		    var value = $(this).val().toLowerCase();
		    li.filter(function() {
		      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)

			});
		 })
	}
	searchBox();


	function ingredients() {
		$(document).on('click', '.ingredients-table__row',function(){
			if ($(this).find('input[type="checkbox"]:checked').length) {
				$(this).addClass('is-checked');
			} else {
				$(this).removeClass('is-checked');
			}
		})
	}
	ingredients();

	
	/* Popup  */
	/* ---------------------------------------------- */

	var isMobile = {Android: function() {return navigator.userAgent.match(/Android/i);},BlackBerry: function() {return navigator.userAgent.match(/BlackBerry/i);},iOS: function() {return navigator.userAgent.match(/iPhone|iPad|iPod/i);},Opera: function() {return navigator.userAgent.match(/Opera Mini/i);},Windows: function() {return navigator.userAgent.match(/IEMobile/i);},any: function() {return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());}};

	if(location.hash){
		var hsh=location.hash.replace('#','');
		if($('.popup-'+hsh).length>0){
			popupOpen(hsh);
		}else if($('div.'+hsh).length>0){
			$('body,html').animate({scrollTop:$('div.'+hsh).offset().top,},500, function(){});
		}
	}

	var act="click";
	if(isMobile.iOS()){
		var act="touchstart";
	}

	$('.popup-open').click(function(event) {
		var popup = $(this).attr('href').replace('#','');
		var video = $(this).data('video');
		popupOpen(popup,video);
		return false;
	});
	function popupOpen(popup,video){
		$('.popup').removeClass('active').hide();
		
		if(!isMobile.any()){
			$('body').css({paddingRight:$(window).outerWidth()-$('.main-wrapper').outerWidth()}).addClass('lock');
			// $('.pdb').css({paddingRight:$(window).outerWidth()-$('.main-wrapper').outerWidth()});
		}else{
			setTimeout(function() {
				$('body').addClass('lock');
			},300);
		}
		history.pushState('', '', '#'+popup);
		if(video!='' && video!=null){
			$('.popup-'+popup+' .popup-video__value').html('<iframe src="https://www.youtube.com/embed/'+v+'?autoplay=1"  allow="autoplay; encrypted-media" allowfullscreen></iframe>');
		}
		$('.popup-'+popup).fadeIn(300).delay(300).addClass('active');

		if($('.popup-'+popup).find('.slick-slider').length>0){
			$('.popup-'+popup).find('.slick-slider').slick('setPosition');
		}
	}

	function popupClose(){
		$('.popup').removeClass('active').fadeOut(300);
		
		if(!isMobile.any()){
			setTimeout(function() {
				$('body').css({paddingRight:0});
				// $('.pdb').css({paddingRight:0});
			},200);
			setTimeout(function() {
				$('body').removeClass('lock');

			},200);
		}else{
			$('body').removeClass('lock');
		}

		$('.popup-video__value').html('');

		history.pushState('', '', window.location.href.split('#')[0]);
	}
	$('.popup-close,.popup__close').on('click', function(event) {
		popupClose();
		return false;
	});
	$('.popup').on('click', function(e) {
		if (!$(e.target).is(".popup>.popup-container *") || $(e.target).is(".popup-close") || $(e.target).is(".popup__close")) {
			popupClose();
			return false;
		}
	});
	$(document).on('keydown',function(e) {
		if(e.which==27){
			popupClose();
		}
	});

	/* Forms  */
	/* ---------------------------------------------- */
	$('input.form-input, textarea.form-input').focus(function(){
		var label = $(this).prev('.placeholder');
		var value = $(this).val();

		if(value == ''){
			label.stop().hide();
			$(this).parent().addClass('focus')
		} else {
			label.hide();

		}
	}).blur(function(){
		var label = $(this).prev('.placeholder');
		var value = $(this).val();
		if ($(this).hasClass('tel')) {
		    if(value == '' || !full){
		      label.stop().show();
		      $(this).parent().removeClass('focus')
		    }
		   } else {
		   	 if(value == ''){
		      label.stop().show();
		      $(this).parent().removeClass('focus')
		    }
		   }

	});


	/* Plugins */
	/* ---------------------------------------------- */


	/* Styler */
	if($('.styler').length){
		$('.styler').styler({
			singleSelectzIndex: '5',
			selectVisibleOptions: '7',
		});
	};

	/* Slick Slider */
	

	if($('.new-slider').length){

		$('.new-slider').slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			appendArrows: '.csp1',
			responsive: [{
				breakpoint: 992, 
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
				} 
			},{
				breakpoint: 768, 
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					variableWidth: true,
				} 
			},
			]
			

		});
	};
	if($('.best-slider').length){

		$('.best-slider').slick({
			
			slidesToShow: 3,
			slidesToScroll: 1,
			appendArrows: '.csp2',
			responsive: [{
				breakpoint: 992, 
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
				} 
			},{
				breakpoint: 768, 
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					variableWidth: true,
				} 
			},
			]

		});
	};

	if($('.rubric-slider').length){

		$('.rubric-slider').slick({
			
			slidesToShow: 3,
			slidesToScroll: 1,
			appendArrows: '.csp3',
			responsive: [{
				breakpoint: 992, 
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
				} 
			},{
				breakpoint: 768, 
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					variableWidth: true,
				} 
			},
			]

		});
	};

	$slick_slider = $('.crs-slider');
	var settings = {
		slidesToShow: 6,
		slidesToScroll: 1,
		prevArrow: '<button class="slick-arrow slick-arrow2 slick-prev"></button>',
		nextArrow: '<button class="slick-arrow slick-arrow2 slick-next"></button>',
		responsive: [{
			breakpoint: 1350, 
			settings: {
				arrows: false,
				
			} 
		},{
			breakpoint: 1200, 
			settings: {
				slidesToShow: 4,
				slidesToScroll: 1,
				arrows: false,
				
			} 
		},{
			breakpoint: 992, 
			settings: {
				slidesToShow: 3,
				slidesToScroll: 1,
				arrows: false,
				
			} 
		},{
			breakpoint: 768, 
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				variableWidth: true,
				
			} 
		},
		]
	}
	$slick_slider.slick(settings);
	
	$(".open-all-cards").on('click',function(){

		if ($slick_slider.hasClass('slick-initialized')) {
			$slick_slider.slick('unslick');
		} else if (!$slick_slider.hasClass('slick-initialized')) {
			return $slick_slider.slick(settings);
		}

	});
	if($('.crs-slider').length){

		$('.crs-slider').slick({
			
			slidesToShow: 6,
			slidesToScroll: 1,
			prevArrow: '<button class="slick-arrow slick-arrow2 slick-prev"></button>',
			nextArrow: '<button class="slick-arrow slick-arrow2 slick-next"></button>',
			responsive: [{
				breakpoint: 1350, 
				settings: {
					arrows: false,
					
				} 
			},{
				breakpoint: 1200, 
				settings: {
					slidesToShow: 4,
					slidesToScroll: 1,
					arrows: false,
					
				} 
			},{
				breakpoint: 992, 
				settings: {
					slidesToShow: 3,
					slidesToScroll: 1,
					arrows: false,
					
				} 
			},{
				breakpoint: 768, 
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					arrows: false,
					variableWidth: true,
					
				} 
			},
			]
			

		});
	};

	if($('.pr-steps-slider').length){

		$('.pr-steps-slider').slick({
			
			slidesToShow: 1,
			slidesToScroll: 1,
			dots: true,
			arrows: true,
			infinite: false,
			adaptiveHeight: true,
			appendArrows: '.popup-rec .box-paging',
			appendDots: '.popup-rec .box-paging',
			fade: true,
			customPaging: function(slick, index) {
			    return '<button type="button"><span class="dotted">' + ++index+ '</span></button>'
			  }
			

		});
	};


});

$('.load-comment-js').click(function(){
	var id = $(this).attr('data-id');
	$.ajax({
            type: "POST",
            url: '/scripts/comment.php?type=load',
            data: {id:id}
        }).done(function(data) {
        	 if(data!='empty'){
            	$('.load-comment-js').css({'display':'none'});
            	$('.comments-wrap').html(data);
            }
            else{
            	alert('Ошибка');
            }
            
        });
        return false;
});
$('.click-like-js').click(function(){
	var id = $(this).attr('data-id');
	var th = $(this);
	$.ajax({
            type: "POST",
            url: '/scripts/comment.php?type=like',
            data: {id:id}
        }).done(function(data) {
        	 if(data>=0){
        	 	$(th).find('.col-like-js').text(' '+data);
            }
            else if(data=='like'){
            	alert('Вы уже поставили лайк на этот коментарий');
            }
            else{
            	alert('Ошибка');
            }
            
        });
        return false;
});
$('.form-comment-js').submit(function(){
	var form_data = new FormData($(this)[0]);
	
	$.ajax({
            type: "POST",
            contentType: false, 
      processData: false,
            url: '/scripts/comment.php?type=add',
            data: form_data
        }).done(function(data) {
        	if(data=='true'){
        		//alert('Ваш коментарий отправлен на одобрение');
        		$( "#comment-block" ).slideUp( "slow", function() {
				    $( ".sucsess_comment" ).slideDown( "slow" );
				 });
        		
        	}
        	else if(data=='many'){
        		alert('Ошибка, вы загрузили больше 4-х фото');
        	}
            else{
            	alert('Ошибка');
            }
        });
        return false;
});

$('.form-comment-js-answ').submit(function(){
	var form_data = new FormData($(this)[0]);
	var forma = $(this);
	$.ajax({
            type: "POST",
            contentType: false, 
      processData: false,
            url: '/scripts/comment.php?type=add',
            data: form_data
        }).done(function(data) {
        	if(data=='true'){
        		//alert('Ваш коментарий отправлен на одобрение');
        		forma.parent().slideUp( "slow", function() {
				    $(this).parent().find( ".sucsess_answer" ).slideDown( "slow" );
				 });
        	}
            else{
            	alert('Ошибка');
            }
        });
        return false;
});


$("#js-file").change(function(){
	if (window.FormData === undefined) {
		alert('В вашем браузере загрузка файлов не поддерживается');
	} else {
		
		var formData = new FormData();
		
		
		if($('.img-item').length > 4){
			alert('Вы не можете загрузить больше 4 фото');
			return false;
		}
		total = $('.img-item').length;
		
		$.each($("#js-file")[0].files, function(key, input){
			if(total < 4){
				if(this.size < 5000000){
					formData.append('file[]', input);
					total++;
				}else{
					alert('Размер файла превышает 5 Мб');
				}
				
				
			}else{
				alert('Вы не можете загрузить больше 4 фото');
				return false;
			}
			
		});
		
 
		$.ajax({
			type: 'POST',
			url: '/scripts/upload_image.php',
			cache: false,
			contentType: false,
			processData: false,
			data: formData,
			dataType : 'json',
			success: function(msg){
				msg.forEach(function(row) {
					if (row.error == '') {
						$('#js-file-list').append(row.data);
						$(".jq-file__name").text("Файлов: "+total);
					} else {
						alert(row.error);
					}
				});
				$("#js-file").val(''); 
			}
		});
		
		
	}
});
 
/* Удаление загруженной картинки */
function remove_img(target){
	$(target).parent().remove();
	total = $('.img-item').length;
	$(".jq-file__name").text("Файлов: "+total);
}

$('.btn-like-js').click(function(){
	var id = $(this).attr('data-id');
	var get = $(this).attr('data-get');
	$.ajax({
            type: "POST",
            url: '/scripts/script-recipe.php?type='+get,
            data: {id:id}
        }).done(function(data) {
        	if(data>=0){
	        	
        		if(get=='like'){
        			$('.like-btn1').addClass('like-active');
        			$('.dislike-btn1').removeClass('dislike-active');
        		}
        		else{
        			$('.dislike-btn1').addClass('dislike-active');
        			$('.like-btn1').removeClass('like-active');
        		}
        	}
        	else if(data=='like'){
        		alert('Вы уже оставили позитивную оценку рецепту');
        	}
        	else if(data=='dislike'){
        		alert('Вы уже оставили негативную оценку рецепту');
        	}
            else{
            	alert('Ошибка');
            }
        });
        return false;
});
$('.answer-click-js').click(function(event){
	
        event.preventDefault();
        $(this).parent().parent().find('.answer_block').slideToggle( "slow" );

		var id = $(this).attr('data-id');
		$('.input-answer-js').val(id);
        return false;
});


$('.btn-comment').click(function(event){
        event.preventDefault();
        var top = $('#comment-block').offset().top;
        $('body,html').animate({scrollTop: top}, 800);
        return false;
});
	
$('.input-calc-js').change(function(){
	var col = $(this).val();
	var id = $(this).attr('data-id');
	let arr = [];
	var $i=0;
	$('.ingredients-table label').each(function(){
		if($(this).find('[type="checkbox"]').prop('checked')==true){
			var index = $(this).index();
			arr.push(index);
			$i++;
		}
	});
	if($i>0){
		var array = JSON.stringify(arr);
	}
	else{
		var array = '';
	}
	$.ajax({
        type: "POST",
        url: '/scripts/script-recipe.php?type=col_recipe',
        data: {id:id,col:col,arr:array}
    }).done(function(data){
    	if(data!='empty'){
    		$('.ingredients-table').html(data);
    	}
    	else{
    		//alert('Ошибка');
    	}
    });
});

$('.btn_select_l').click(function(){
	$('.select_litr').slideToggle();
		
});
$('.select_litr ul li').click(function(){
	var col1 = $(this).text();
	if(window.startPortionSize == undefined) { window.startPortionSize = col1; }
    var portionType = "int";
    if((Math.ceil(parseFloat(window.startPortionSize)) != parseInt(window.startPortionSize))) { var portionType = "float"; }
            
    var col = parseFloat(col1);
    var col = col.toFixed(1); 
        
     $('.counter__input').val(col1);
	$('.input-calc-js').val(col);
	
	$('.input-calc-js').change();   
        
	$('.select_litr').slideToggle();
	
});

$('.card-wrap__img .zoom').click(function(){
	$('.pop-img').fadeIn(300);
	return false;
});


$('.btn-print-js').click(function(){
	window.print() ;
	return false;
});
$('.btn-load-js').click(function(){
	var get = $(this).attr('data-get');
	var col = $(this).parent().parent().prev().children().length;
 	var push = $(this).parent().parent().prev();
 	var th = $(this);
	$.ajax({
            type: "POST",
            url: '/scripts/pagin.php?type='+get,
            data: {number:col}
        }).done(function(data) {
        	$(push).append(data);
        	if(push.children().length<(col+3)){
        		$(th).css({'display':'none'});
        	}
        });
        return false;
});
$('.searth_form_recipe').submit(function(){
	var fdata = new FormData();
	let a_ings = [];
	let b_ings = [];
	let w_cook = [];
	let method = [];
	var $i=0;
	$('.a_ings-list-js .is-selected').each(function(){
		var val = $(this).text();
		a_ings.push(val);
		$i++;
	});
	if($i>0){
		fdata.append('a_ings',JSON.stringify(a_ings));
	}
	var $i=0;
	$('.w_cook-list-js .is-selected').each(function(){
		var val = $(this).text();
		w_cook.push(val);
		$i++;
	});
	if($i>0){
		fdata.append('w_cook',JSON.stringify(w_cook));
	}
	var $i=0;
	$('.b_ings-list-js .is-selected').each(function(){
		var val = $(this).text();
		b_ings.push(val);
		$i++;
	});
	if($i>0){
		fdata.append('b_ings',JSON.stringify(b_ings));
	}
	var $i=0;
	$('.method-list-js .is-selected').each(function(){
		var val = $(this).text();
		method.push(val);
		$i++;
	});
	if($i>0){
		fdata.append('method',JSON.stringify(method));
	}
	var name = $(this).find('input').val();
	if(name!=''){
		fdata.append('name',name);
	}
	$.ajax({
            type: "POST",
            contentType: false, 
      processData: false,
            url: '/scripts/searth.php?type=recipe',
            data:fdata
        }).done(function(data) {
        	$('.searth-push-js').html(data);
        });
        return false;
});
jQuery(function($){
        $(document).mouseup(function (e){
            var block = $(".filter");
            if (!block.is(e.target) 
                && block.has(e.target).length === 0) {
                   $(".filter__button")
				.removeClass("is-active")
				.parents(".filter")
				.removeClass("is-open")
				.find(".filter__dropdown")
				.slideUp(200);
            }
        });
    });
function nav(){
    $i=0;
    $('.card-info__description').find('h2').each(function(){
    	var text= $(this).text();
    $(this).attr('id','block_recipe'+$i);
    $('.nav-recipe').append('<a href=#block_recipe'+$i+'>'+text+'</a>');
    $i++;
    
});
    $('.end-text').find('h2').each(function(){
    	var text= $(this).text();
    $(this).attr('id','block_recipe'+$i);
    $('.nav-recipe').append('<a href=#block_recipe'+$i+'>'+text+'</a>');
    $i++;
    
});
    if($i<1){
    	 $('.nav-recipe').css({'display':'none'});
    }
}
//nav();
$(".nav-recipe a").on('click',function(){
	event.preventDefault();
        var top = $($(this).attr('href')).offset().top;
        $('body,html').animate({scrollTop: top}, 800);
    return false;
});
$('.seath_seath').keyup(function(){
	var push = $(this).parent().prev();
	var get = $(this).attr('data-get');
	var val= $(this).val();
	$.ajax({
            type: "POST",
            url: '/scripts/searth.php?type='+get,
            data:{val:val}
        }).done(function(data) {
        	$(push).html(data);
        	
        });
        return false;
});
$('.pr-steps__img .zoom').click(function(){
	var src = $(this).closest('.img').find('img').attr('src');
	$('.pop-big-step').find('img').attr('src',src);
	$('.pop-big-step').fadeIn(300);
	$('.pop-big-step').fadeIn(300);

	return false;
});

$('.flex-imgs-comment .zoom').click(function(){
	var src = $(this).closest('.flex-imgs-comment').find('img').attr('src');
	$('.pop-big-step').find('img').attr('src',src);
	$('.pop-big-step').fadeIn(300);
	$('.pop-big-step').fadeIn(300);

	return false;
});
