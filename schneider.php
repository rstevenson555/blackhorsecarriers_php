<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <style type="text/css">
            span.highlight
            {
                background-color:yellow
            }
        </style>

        <meta name="generator" content=
              "HTML Tidy for Mac OS (BBTidy vers 1st December 2002), see www.w3.org">
        <title>2009 Presidents Award</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <?php include "script_head.php" ?>
		<link rel="stylesheet" href="css/black.css" type="text/css" />
		<link type="text/css" rel="stylesheet"
              href="css/style-mock2.css" />
        <link type="text/css" rel="stylesheet"
              href="css/highline_nav.css" />
        <link type="text/css" rel="stylesheet"
              href="css/nav.css" />

		<link rel="stylesheet" href="css/basic.css" type="text/css" />
		<link rel="stylesheet" href="css/galleriffic-5.css" type="text/css" />

		<!-- <link rel="stylesheet" href="css/white.css" type="text/css" /> -->

		<!-- We only want the thunbnails to display when javascript is disabled -->


        <link type="text/css" rel="stylesheet" href="css/style-mock2.css" />
        <link type="text/css" rel="stylesheet" href="css/highline_nav.css" />
        <link type="text/css" rel="stylesheet" href="css/nav.css" />
        <meta content="Robert Stevenson" name="author">
    </head>

	<?php include 'utils.php' ?>
	<?php include 'locations.php' ?>
    <body style="color:black;" id="normalbody">
        <div id="page_wrapper">
            <div id="main">
				<?php include 'navigation.php' ?>

                <script type="text/javascript"  src="scripts/jquery.history.js"></script>
                <script type="text/javascript"  src="scripts/jquery.galleriffic.js"></script>
                <script type="text/javascript"  src="scripts/jquery.opacityrollover.js"></script>
				<div class="bodyText articleText" style="font-size: 11pt;background-image: url(images/background2.jpg);" >


					<table style="margin-top:10px;width:100%">
						<tbody>
							<tr >
								<td align="center">
									<p style="">
                                                                            <h1>

Schneider Logistics, Inc. 2012 Carrier of the Year Award
                                    </h1>

									</p>
								</td>
							</tr>
						</tbody>
					</table>

					<table style="margin-top:10px;width: 100%; ">
						<tbody>
							<tr>
								<td colspan="2" align="center">
									<img border="1" src="images/schneider_large.jpg"/>
								</td>
							</tr>
                            <tr>
                                <td colspan="2" align="center"><h3>Dave Anderson and Joe Chaltry</h3></td>
                            </tr>
						</tbody>
					</table>
                    

                    <p>Black Horse Carriers has received the prestigious Schneider Logistics, Inc. 2012 Carrier of the Year Award for its second time.  Black Horse Carriers was the only Dedicated Dealer Service (DDS) provider to win the award at this year’s 10th Annual Carrier Recognition Event.  This award was given in recognition of the fine service provided to the FORD Motor Company from our two terminals in Evansville, Indiana and Menomonie, Wisconsin in which we deliver parts to the Ford, Lincoln and Mercury Dealers in Illinois, Indiana, Iowa, Kentucky, Missouri, Minnesota, North Dakota, Tennessee and Wisconsin.
 </p>
 
 <p>More than 225 representatives from the top 10 percent of Schneider Logistics’ contracted carriers attended this year’s event, which was held August 21st at Lambeau Field in Green Bay.  The conference recognized 18 transportation companies with Schneider Logistics’ top honors, including Carrier of the Year and Customer Service Representative of the Year awards.</p>
 
 <p>Our compliments go out to these terminals, led by Shonna Southwell in Evansville, Indiana, Bill Johnson in Menomonie, Wisconsin and the entire Automotive Division headed by James Isaacson and John Garretson.</p>
					
					
						<!-- End Gallery Html Containers -->
						<div style="clear: both;"></div>
					

				</div>
            </div>
        </div>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				// We only want these styles applied when javascript is enabled
				$('div.content').css('display', 'block');

				// Initially set opacity on thumbs and add
				// additional styling for hover effect on thumbs
				var onMouseOutOpacity = 0.67;
				$('#thumbs ul.thumbs li, div.navigation a.pageLink').opacityrollover({
					mouseOutOpacity:   onMouseOutOpacity,
					mouseOverOpacity:  1.0,
					fadeSpeed:         'fast',
					exemptionSelector: '.selected'
				});

				// Initialize Advanced Galleriffic Gallery
				var gallery = $('#thumbs').galleriffic({
					delay:                     2500,
					numThumbs:                 10,
					preloadAhead:              10,
					enableTopPager:            false,
					enableBottomPager:         false,
					imageContainerSel:         '#slideshow',
					controlsContainerSel:      '#controls',
					captionContainerSel:       '#caption',
					loadingContainerSel:       '#loading',
					renderSSControls:          true,
					renderNavControls:         true,
					playLinkText:              'Play Slideshow',
					pauseLinkText:             'Pause Slideshow',
					prevLinkText:              '&lsaquo; Previous Photo',
					nextLinkText:              'Next Photo &rsaquo;',
					nextPageLinkText:          'Next &rsaquo;',
					prevPageLinkText:          '&lsaquo; Prev',
					enableHistory:             false,
					autoStart:                 true,
					syncTransitions:           true,
					defaultTransitionDuration: 900,
					onSlideChange:             function(prevIndex, nextIndex) {
						// 'this' refers to the gallery, which is an extension of $('#thumbs')
						this.find('ul.thumbs').children()
						.eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
						.eq(nextIndex).fadeTo('fast', 1.0);

						// Update the photo index display
						this.$captionContainer.find('div.photo-index')
						.html('Photo '+ (nextIndex+1) +' of '+ this.data.length);
					},
					onPageTransitionOut:       function(callback) {
						this.fadeTo('fast', 0.0, callback);
					},
					onPageTransitionIn:        function() {
						var prevPageLink = this.find('a.prev').css('visibility', 'hidden');
						var nextPageLink = this.find('a.next').css('visibility', 'hidden');

						// Show appropriate next / prev page links
						if (this.displayedPage > 0)
							prevPageLink.css('visibility', 'visible');

						var lastPage = this.getNumPages() - 1;
						if (this.displayedPage < lastPage)
							nextPageLink.css('visibility', 'visible');

						this.fadeTo('fast', 1.0);
					}
				});

				/**************** Event handlers for custom next / prev page links **********************/

				gallery.find('a.prev').click(function(e) {
					gallery.previousPage();
					e.preventDefault();
				});

				gallery.find('a.next').click(function(e) {
					gallery.nextPage();
					e.preventDefault();
				});

				/****************************************************************************************/

				/**** Functions to support integration of galleriffic with the jquery.history plugin ****/

				// PageLoad function
				// This function is called when:
				// 1. after calling $.historyInit();
				// 2. after calling $.historyLoad();
				// 3. after pushing "Go Back" button of a browser
				function pageload(hash) {
					// alert("pageload: " + hash);
					// hash doesn't contain the first # character.
					if(hash) {
						$.galleriffic.gotoImage(hash);
					} else {
						gallery.gotoIndex(0);
					}
				}

				// Initialize history plugin.
				// The callback is called at once by present location.hash.
				$.historyInit(pageload, "advanced.html");

				// set onlick event for buttons using the jQuery 1.3 live method
				$("a[rel='history']").live('click', function(e) {
					if (e.button != 0) return true;

					var hash = this.href;
					hash = hash.replace(/^.*#/, '');

					// moves to a new page.
					// pageload is called at once.
					// hash don't contain "#", "?"
					$.historyLoad(hash);

					return false;
				});

				/****************************************************************************************/
			});
		</script>

		
    </body>
</html>
