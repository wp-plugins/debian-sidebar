/**
 * @author Željko Popivoda http://popivoda.com
 *
 * Version 0.1
 * Copyright (c) 2013 Željko Popivoda
 *
 * License:
 * https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * Edited version of Social Sidebar, Thomas Davis.
 *
 */
(function( $ ){

  $.fn.debianSidebar = function( options ) {  

    return this.each(function() {
      IMAGE_BASE = '/wp-content/plugins/debian-sidebar/images/';
      var settings = {
		'top'        : '100px',
        'debian-org': {
			'link': '',
			'image': IMAGE_BASE + 'debian-org.png'
		},
        'why-debian': {
			'link': '',
			'image': IMAGE_BASE + 'why-debian.png'
		},
	'download-debian': {
			'link': '',
			'image': IMAGE_BASE + 'download-debian.png'
		},
	'public': 1
      };
      	
      if ( options ) { 
        $.extend( true, settings, options );
      }
	 
		$(this).append("<div id='debianSidebar' style='position:fixed; top:" + settings['top'] + "; right:-3px; z-index:10000;'></div>");
		sidebar = $("#debianSidebar");
		if( settings['debian-org']['link'] != "" ){
			sidebar.append("<div class='socialNetwork'><a target='_blank' title='Debian' href='" + settings['debian-org']['link'] + "'><img style='z-index: 10000;' src='" + settings['debian-org']['image'] + "' /></a></div>");
		}
		if( settings['why-debian']['link'] != ""){
			sidebar.append("<div class='socialNetwork'><a target='_blank' title='Why use Debian' href='" + settings['why-debian']['link'] + "'><img style='z-index: 10000;' src='" + settings['why-debian']['image'] + "' /></a></div>");
		}		
		if( settings['download-debian']['link'] != ""){
			sidebar.append("<div class='socialNetwork'><a target='_blank' title='Download Debian' href='" + settings['download-debian']['link'] + "'><img style='z-index: 10000;' src='" + settings['download-debian']['image'] + "' /></a></div>");
		}		
		$(".socialNetwork").hover( function(){
			$(this).css("margin-left","-3px");	
		}, function(){
			$(this).css("margin-left","0px");	
		})
		
    });

  };
})( jQuery );
