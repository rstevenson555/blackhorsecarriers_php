<?php
if ($_SERVER["HTTP_HOST"] == "blackhorsecarriers.com") {
    Header("HTTP/1.1 301 Moved Permanently");
    Header("Location: http://www.blackhorsecarriers.com");
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

        <meta name="generator" content=
              "HTML Tidy for Windows (vers 18 June 2008), see www.w3.org"
              />

        <title>Black Horse Carriers, Inc.</title>
        <meta content="text/html; charset=us-ascii"
              http-equiv="Content-Type" />
        <meta name="description" content=
              "Replace private truck fleets, of any size, for companies
              whose business requires specialized trucks and/or specialized
              transportation services." />
        Ø<meta name="keywords" content="logistics,truck
              leasing,fleet,trucking,private truck fleet,private fleet,private trucking fleet,
              Shared Services, Carrier Network, Parts Delivery, Scanning Services, Perishable Products, Retail Delivery, Auto Parts Delivery, Best Carrier, On-Time Delivery" />
        <meta name="Googlebot" content="index,follow" />
        <meta name="Robots" content="index,follow" />
        <link type="text/css" rel="stylesheet"
              href="css/style-mock2.css" />
        <link type="text/css" rel="stylesheet"
              href="css/highline_nav.css" />
        <link type="text/css" rel="stylesheet"
              href="css/nav.css" />
        <!--<link type="text/css" rel="stylesheet"
              href="images/imageMenu.css" /> -->
        <meta name="author" content="Robert Stevenson" />
        <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>-->
        <script type="text/javascript" src="scripts/hover.js"></script>
        <!--<script type="text/javascript" src="scripts/jquery.vticker-min.js"></script>-->


    </head>
    <?php include 'locations.php' ?>
    <body id="normalbody">
        <style>
            #news-container
            {
                width: 400px;
                margin: auto;
                margin-top: 30px;
                border: 5px solid #333333;
            }

            #news-container ul li div
            {
                border: 1px solid #aaaaaa;
                background: #ffffff;
            }
        </style>

        <!--<script language="javascript" type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-12682212-1']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ga);
            })();
            

        </script>-->
        
        
        <script language="javascript" type="text/javascript">
            $(function(){
                $('#news-container').vTicker({
                    speed: 500,
                    pause: 3000,
                    animation: 'fade',
                    mousePause: false,
                    showItems: 3
                });
            });
        </script>

        <div id="page_wrapper">
            <div id="main" >
                <?php include 'navigation.php' ?>

                <script type="text/javascript">
                    $(document).ready(function () {
                
                        $('.emplinks').show();
                        $('a#clickshow').click(function() {
                            $('.emplinks').toggle('slow');
                            return false;
                        })
                    });
                </script>
                <style  TYPE="text/css">
                    .bodyText {
                        background-color:transparent !important;
                    }
                    .quickLinkSection {
                        /*background-color:#7DA87D; */
                        background-image: url('images/green_background.png');
                    }
                    .quickLinkSection a{
                    }
                    .homeTableContainer .nestedText p {
                        margin-top:18px !important;
                        margin-bottom:18px !important;
                    }
                </style>
                <div class="bodyText articleText" style="height:600px;background-image: url(images/background.jpg);" >
                    <div class="homeTableContainer">
                        <div class="nestedText" style="width:597!important;background-color:transparent !important;">

                            <div>
                                <p style="float:left;">We design our transportation models around the
                                    flexible use of
                                    resources,allowing us to adjust fleet sizes and
                                    manpower to the
                                    ever-changing needs of our customers, eliminating
                                    rigid fleet sizes and
                                    significant fixed costs for resources that are
                                    not always
                                    required.</p>
                                <!--<div style="float:left;"> -->
                                <p style="float:left;">We can <a href="fleetreplacement.php">replace a private fleet</a>, or
                                    under-performing dedicated fleet
                                    with a transportation system that enhances and
                                    promotes the specialized
                                    functions that made the private truck fleet an
                                    absolute necessity in
                                    the first place; and, we absolutely execute these
                                    specialized functions
                                    efficiently and dependently so that your needs
                                    are met and your goals
                                    are achieved.</p>

                                <p style="float:left;">Organizing and <span class="double_underline">
                                        <a overlayShow="true" frameWidth="640"
                                           frameHeight="360" rel="fancyvideo" href="http://www.youtube.com/watch?v=lNuNMGUj0dc"> <img style="border:0;" align="top" src="/images/film.gif"/>operating efficient transportation
                                            and distribution
                                            systems</a></span> with effective fleet sizing, routing and
                                    scheduling, plus
                                    effective training, supervision and motivation of
                                    our work force are
                                    what we do best.</p>

                                <p style="float:left;">We have broad transportation experience across
                                    many industries,
                                    Contract Carriage / Logistics /Driver Leasing and
                                    Private Fleet
                                    Replacement.</p>

                            </div>


                        </div>
                        <div class="quickLinkSection" style="float:right;margin-right:20px;border: 3px solid #7DA87D;margin-top:30px !important;">
                            <div class="quickLinkHead">Quick Links</div>
                            <!--<a href="safetyfirst.php">Safety First</a> -->
                            <div class="quickLinkSectionImage">
                                <!--<a href="bhcnews.php"><img border="0" src="images/SchneiderSmall.jpg"/></a>-->
                                <a href="bhcnews.php"><img border="0" src="images/minookagoldsmall.jpg"/></a>
                                <div>
                                    <!--<a href="bhcnews.php">2009 Carrier of the Year</a>-->
                                    <a href="bhcnews.php">Minooka Gold Medal Winner</a>
                                </div>
                            </div>
                            <p><a target="_blank" href="http://www.blackhorsecarriers.com/community/phpbb3/">Resolution&nbsp;&&nbsp;Service&nbsp;Center&nbsp;</a></p>
                            <p><a href="https://www.blackhorsecarriers.com/application.php">Drivers Apply Here</a></p>
                            <p><div class="emplink"><a id="clickshow" href="">Employee Links</a></div>
                            <div class="emplinks">
                                <div ><a style="font-size:8pt!important;" href="https://ipay.adp.com">Payroll Statements</a></div>
                                <div ><a style="font-size:8pt!important;" href="https://home.eease.adp.com">Benefits</a></div>
                            </div></p>
                            <!--<div class="emplink" style=""><a href="illinoislocations.php?site=9120+W.+191st+Street,Mokena,Il+60448&locname=Mokena">Mokena, IL - NOW OPEN!</a></div>
                            <div style="font-size:8pt;margin-left:10px;">Shared Services, Crossdock, Warehouse</div>  -->

                            <div class="emplink"><a href="/presidentaward2010.php">2010 Presidents Award</a></div>
                            <div class="" style="margin-left:10px">
                                <div style="font-size:8pt;">Jose&nbsp;Morales&nbsp;-&nbsp;Batavia,&nbsp;IL</div>
                                <div style="font-size:8pt;">Jeff&nbsp;Aungst&nbsp;-&nbsp;Hinckley,&nbsp;OH</div>
                            </div>

                            <div class="emplink" style="margin-top:5px;">
                                <a href="/terminalmanager2010.php">Terminal Manager of&nbsp;the&nbsp;Year&nbsp;2010</a>
                            </div>
                            <div class="emplinks" style="margin-top:5px;">
                                <div style="font-size:8pt;">Suzzette&nbsp;Schroeder&nbsp;<br/>Batavia,&nbsp;IL</div>
                            </div>

                            <div class="emplink" style="margin-top:5px;">
                                <a href="/plymouthteam.php">Plymouth MI Team</a>
                            </div>


<!--<p><div class="emplink"><a href="/presidentaward2009.php">2009 Presidents Award</a></div>
<div class="emplinks">
    <div style="font-size:8pt;">Pedro&nbsp;Castillo&nbsp;-&nbsp;Hopkins,&nbsp;MN</div>
    <div style="font-size:8pt;">Noel&nbsp;Solano&nbsp;-&nbsp;Ctr Valley,&nbsp;PA</div>
</div></p>-->
                        </div>
                        <div style="float:right;width:210px;margin-top:70px;">
                            <div style="font-size:12px;">Copyright &nbsp;2006</div>
                            <div style="font-size:12px;">Blackhorsecarriers.com</div>
                            <div style="font-size:12px;">Privacy Policy - Terms of Use</div>
                            <div style="font-size:12px;">630-690-8900</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">

          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-12682212-1']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();

        </script>

    </body>
</html>