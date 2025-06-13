(function($) {
	"use strict";
	
	// ______________Active Class
	$(".app-sidebar li a").each(function() {
	  var pageUrl = window.location.href.split(/[?#]/)[0];
		if (this.href == pageUrl) { 
			$(this).addClass("active");
			$(this).parent().addClass("active"); // add active to li of the current link
			$(this).parent().parent().prev().addClass("active"); // add active class to an anchor
			$(this).parent().parent().prev().click(); // click the item to make it drop
		}
	});
	
	//Active Class
	$(".app-sidebar li a").each(function() {
		var pageUrl = window.location.href.split(/[?#]/)[0];
		if (this.href == pageUrl) {
			$(this).addClass("active");
			$(this).parent().addClass("active"); // add active to li of the current link
			$(this).parent().addClass("resp-tab-content-active"); // add active to li of the current link
			$(this).parent().parent().parent().prev().addClass("active"); // add active class to an anchor
			$(this).parent().parent().parent().prev().click(); // click the item to make it drop
		}
	});
	
	$(".submenu-list li a").each(function() {
		var pageUrl = window.location.href.split(/[?#]/)[0];
		if (this.href == pageUrl) {
			$(this).addClass("active");
			$(this).parent().parent().parent().parent().parent().addClass("active"); // add active to li of the current link
			$(this).parent().parent().parent().parent().parent().addClass("resp-tab-content-active"); // add active to li of the current link
			$(this).parent().parent().parent().prev().addClass("active"); // add active class to an anchor
			$(this).parent().parent().parent().prev().click(); // click the item to make it drop
		}
	});
	
	// VerticalTab
	$('#parentVerticalTab').easyResponsiveTabs({
		type: 'vertical',
		width: 'auto', 
		fit: true, 
		closed: 'accordion',
		tabidentify: 'hor_1',
		activate: function(event) {
			var $tab = $(this);
			var $info = $('#nested-tabInfo2');
			var $name = $('span', $info);
			$name.text($tab.text());
			$info.show();
		}
	});
	
	$(document).ready(function(){	
	
		if ($('.home-dashlead.active').hasClass('active'))
        $('li.home-dashlead').addClass('active');
	
		if ($('.apps-dashlead.active').hasClass('active'))
        $('li.apps-dashlead').addClass('active');
	
		if ($('.maps-dashlead.active').hasClass('active'))
        $('li.maps-dashlead').addClass('active');
	
		if ($('.elements-dashlead.active').hasClass('active'))
        $('li.elements-dashlead').addClass('active');
	
		if ($('.ui-dashlead.active').hasClass('active'))
        $('li.ui-dashlead').addClass('active');
		
		if ($('.forms-dashlead.active').hasClass('active'))
        $('li.forms-dashlead').addClass('active');
	
		if ($('.charts-dashlead.active').hasClass('active'))
        $('li.charts-dashlead').addClass('active');
	
		if ($('.pages-dashlead.active').hasClass('active'))
        $('li.pages-dashlead').addClass('active');
	
		if ($('.ecommerce-dashlead.active').hasClass('active'))
        $('li.ecommerce-dashlead').addClass('active');
	
		if ($('.utilities-dashlead.active').hasClass('active'))
        $('li.utilities-dashlead').addClass('active');
		
		if ($('.custom-dashlead.active').hasClass('active'))
        $('li.custom-dashlead').addClass('active');
		
		if ($('.submenu-dashlead.active').hasClass('active'))
        $('li.submenu-dashlead').addClass('active');
	
	
	});
	
	/*---Scroling ---*/
	//P-scroll
	const ps =  new PerfectScrollbar('.first-sidemenu', {
		suppressScrollX: true
	});
	const ps1 =  new PerfectScrollbar('.second-sidemenu', {
		suppressScrollX: true
	});
	
})(jQuery);