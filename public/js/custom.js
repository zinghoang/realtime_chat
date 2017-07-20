(function($) { "use strict";

$('.cart-complete').parent().addClass('checkout-mess');

// MENU  UPDATED V 1.5=============== //
if ( $(window).width() > 767) {     
   jQuery('ul.sf-menu').superfish({
			animation: {opacity:'show'},
		animationOut: {opacity:'hide'}
		});
}
else {		
		jQuery('ul.sf-menu').superfish({
		animation: {opacity:'visible'},
		animationOut: {opacity:'visible'}
		});
}

// HOVER IMAGE MAGNIFY V.1.5========= //
    //Set opacity on each span to 0%
    $(".photo_icon").css({'opacity':'0'});

	$('.picture a').hover(
		function() {
			$(this).find('.photo_icon').stop().fadeTo(800, 1);
		},
		function() {
			$(this).find('.photo_icon').stop().fadeTo(800, 0);
		}
	)

// STICKY NAV V.1.5========= //    
$(window).scroll(function() {
    if ($(this).scrollTop() > 1){  
        $('nav.top-menu').addClass("sticky");
    }
    else{
        $('nav.top-menu').removeClass("sticky");
    }
});
	
// MENU MOBILE ==========//
// Collpsable menu mobile and tablets
$('#mobnav-btn').click(
function () {
    $('.sf-menu').stop().slideToggle(400);
});

$('.sf-with-ul').click(
function () {
    $(this).next().toggleClass("xpopdrop");
});

// SCROLL TO TOP ===============================================================================
$(function() {
    $(window).scroll(function() {
        if($(this).scrollTop() != 0) {
            $('#toTop').fadeIn();   
        } else {
            $('#toTop').fadeOut();
        }
    });
 
    $('#toTop').click(function() {
        $('body,html').animate({scrollTop:0},500);
    }); 
    
});

if( window.innerWidth < 770 ) {
    $("button.forward, button.backword").click(function() {
  $("html, body").animate({ scrollTop: 115 }, "slow");
  return false;
});
}

if( window.innerWidth < 500 ) {
    $("button.forward, button.backword").click(function() {
  $("html, body").animate({ scrollTop: 245 }, "slow");
  return false;
});
}
if( window.innerWidth < 340 ) {
    $("button.forward, button.backword").click(function() {
  $("html, body").animate({ scrollTop: 280 }, "slow");
  return false;
});
}

$('.filterable .filters input').keyup(function(e){
    /* Ignore tab key */
    var code = e.keyCode || e.which;
    if (code == '9') return;
    /* Useful DOM data and selectors */
    var $input = $(this),
    inputContent = $input.val().toLowerCase(),
    $panel = $input.parents('.filterable'),
    column = $panel.find('.filters th').index($input.parents('th')),
    $table = $panel.find('.table'),
    $rows = $table.find('tbody tr');
    /* Dirtiest filter function ever ;) */
    var $filteredRows = $rows.filter(function(){
        var value = $(this).find('td').eq(column).text().toLowerCase();
        return value.indexOf(inputContent) === -1;
    });
    /* Clean previous no-result if exist */
    $table.find('tbody .no-result').remove();
    /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
    $rows.show();
    $filteredRows.hide();
    /* Prepend no-result row if all rows are filtered */
    if ($filteredRows.length === $rows.length) {
        $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
    }
});

})(jQuery);