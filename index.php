<?php
	$baseUrl = "http://admindeals.booqwale.com/api/";
?>
<!doctype html>
<html>
<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>::~Bookwale~:</title>
    <!--favicon icon-->
    <link rel="icon" type="image/png" href="image/favicon.png" />
    <!--common style sheet -->

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <!-- main stylesheet -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
    <!-- <script src="https://use.fontawesome.com/9ba78cf137.js"></script>-->

    <!--[if lt IE 9]>
<script src="js/modernizr.custom.03515.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
    <!--[if lt IE 9]>
<script>
document.createElement('header');
document.createElement('nav');
document.createElement('section');
document.createElement('article');
document.createElement('aside');
document.createElement('footer');
document.createElement('hgroup');
</script>
<![endif]-->
</head>

<body>

    <header id="header" class="st-header">
        <div class="container clearfix">
            <div class="col-sm-8">
                <a href="javascript:void"><img src="assets/images/logo2.png" alt="ALT"></a>
                <div class="srch-icon"><i class="fa fa-search" aria-hidden="true"></i></div>
            </div>
            <div class="col-sm-4">
                <div class="srch-toggle">
                    <input type="text" placeholder="SEARCH..."><i class="fa fa-search" aria-hidden="true"></i></div>
            </div>

            <!-- <div class="col-sm-4 sm-container">
                <div class="sm-content">
                    <a class="fb" href="javascript:void(0)"></a>
                </div>
                <div class="sm-content">
                    <a class="twitter" href="javascript:void(0)"></a>
                </div>

            </div>-->

        </div>
    </header>
    <!-- /header -->


    <!-- /Follower list -->
    <main class="st-content">
        <div class="container">
            <div class="col-xs-12  banner">

			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				<?php
				$url = $baseUrl."getAllBanners";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, urldecode($url));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
				$response = curl_exec($ch);
				curl_close($ch);

				$banners = json_decode($response);
				$br = 0;
				foreach( $banners->items  as $banner)
				{
				$image  = $banner->basepath.$banner->image;
				$title  = $banner->title;
				if($banner->is_booqwale == 1 )
				{
				$link = 'http://booqwale.com/redirect.php?redirect='.$banner->custom_link;
				}
				else
				{
				$link   = $banner->custom_link;
				}

				$active = "";
				if($br == 0 )
				{
				$active = "active";
				}
				?>
				<div class="item <?php echo $active;?>">
					<a href="<?php echo $link;?>" target="_blank">
						<img src="<?php echo $image;?>" alt="<?php echo  $title;?>" title="<?php echo  $title;?>">
					</a>
				</div>
				<?php $br++; } ?>
			</div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <div class="deals-of-day col-xs-12">
                <h2>Deals of the day</h2>
                <div id="horizontalscroll" class="content horizontal-images">

                    <ul>
                    
                    	<?php
                    	$url = $baseUrl."getAllDailyDeals";
                    	$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, urldecode($url));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
				$response = curl_exec($ch);
				curl_close($ch);

				$dailyDeals = json_decode($response);
				
				$now = new DateTime();
				
				foreach($dailyDeals->items as $deal)
				{
				
				$future_date = new DateTime($deal->deal_end);
				
				$interval = $future_date->diff($now);
				
				
				
				
				
				$image  = $deal->basepath.$deal->image;
				$title  = $deal->title;
				if($deal->is_booqwale == 1 )
				{
				$link = 'http://booqwale.com/redirect.php?redirect='.$deal->custom_link;
				}
				else
				{
				$link   = $deal->custom_link;
				}
                    	?>
                        <li>
                            <a href="<?php echo $link;?>" class="deals-block" target="_blank">
                                <div class="product-thumb">
                                    <div class="brand-logo"><img class="img-responsive" src="<?php echo $deal->associate_image;?>"></div>
                                    <div class="product-header">
                                        <img src="<?php echo $image;?>" alt="<?php echo $title;?>" title="<?php echo $title;?>">
                                    </div>
                                    <div class="product-inner">
                                        <h5 class="product-title"><?php echo $title;?></h5>
                                        <p class="product-desciption"><?php echo $deal->small_title;?></p>
                                        <div class="product-meta"><span class="product-time"><i class="fa fa-clock-o"></i> <?php  echo $interval->format("%a days, %h hours, %i minutes, %s seconds");?> remaining</span>

                                        </div>

                                    </div>
                                </div>
                            </a>
                        </li>
                        
                        <?php } ?>
                        <li>
                            <a href="javascript:void(0)" class="deals-block">
                                <div class="product-thumb">
                                    <div class="brand-logo"><img class="img-responsive" src="assets/images/amazon.jpg"></div>
                                    <div class="product-header">
                                        <img src="assets/images/deals-img1.jpg" alt="Image Alternative text" title="Ana 29">
                                    </div>
                                    <div class="product-inner">
                                        <h5 class="product-title">Hot Summer Collection</h5>
                                        <p class="product-desciption">Vitae sodales senectus fames litora integer arcu laoreet</p>
                                        <div class="product-meta"><span class="product-time"><i class="fa fa-clock-o"></i> 1d 15h 10m 12s remaining</span>

                                        </div>

                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="deals-block">
                                <div class="product-thumb">
                                    <div class="brand-logo"><img class="img-responsive" src="assets/images/amazon.jpg"></div>
                                    <div class="product-header">
                                        <img src="assets/images/deals-img1.jpg" alt="Image Alternative text" title="Ana 29">
                                    </div>
                                    <div class="product-inner">
                                        <h5 class="product-title">Hot Summer Collection</h5>
                                        <p class="product-desciption">Vitae sodales senectus fames litora integer arcu laoreet</p>
                                        <div class="product-meta"><span class="product-time"><i class="fa fa-clock-o"></i> 1d 15h 10m 12s remaining</span>

                                        </div>

                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="deals-block">
                                <div class="product-thumb">
                                    <div class="brand-logo"><img class="img-responsive" src="assets/images/amazon.jpg"></div>
                                    <div class="product-header">
                                        <img src="assets/images/deals-img1.jpg" alt="Image Alternative text" title="Ana 29">
                                    </div>
                                    <div class="product-inner">
                                        <h5 class="product-title">Hot Summer Collection</h5>
                                        <p class="product-desciption">Vitae sodales senectus fames litora integer arcu laoreet</p>
                                        <div class="product-meta"><span class="product-time"><i class="fa fa-clock-o"></i> 1d 15h 10m 12s remaining</span>

                                        </div>

                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="deals-block">
                                <div class="product-thumb">
                                    <div class="brand-logo"><img class="img-responsive" src="assets/images/amazon.jpg"></div>
                                    <div class="product-header">
                                        <img src="assets/images/deals-img1.jpg" alt="Image Alternative text" title="Ana 29">
                                    </div>
                                    <div class="product-inner">
                                        <h5 class="product-title">Hot Summer Collection</h5>
                                        <p class="product-desciption">Vitae sodales senectus fames litora integer arcu laoreet</p>
                                        <div class="product-meta"><span class="product-time"><i class="fa fa-clock-o"></i> 1d 15h 10m 12s remaining</span>

                                        </div>

                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="deals-block">
                                <div class="product-thumb">
                                    <div class="brand-logo"><img class="img-responsive" src="assets/images/amazon.jpg"></div>
                                    <div class="product-header">
                                        <img src="assets/images/deals-img1.jpg" alt="Image Alternative text" title="Ana 29">
                                    </div>
                                    <div class="product-inner">
                                        <h5 class="product-title">Hot Summer Collection</h5>
                                        <p class="product-desciption">Vitae sodales senectus fames litora integer arcu laoreet</p>
                                        <div class="product-meta"><span class="product-time"><i class="fa fa-clock-o"></i> 1d 15h 10m 12s remaining</span>

                                        </div>

                                    </div>
                                </div>
                            </a>
                        </li>

                    </ul>

                </div>

            </div>

            <div class="col-xs-12 book-offer-container">
                <h2>Coupons and cashback offers</h2>
                <div class="col-xs-12 col-sm-3">
                    <div class="product-thumb">
                        <a href="#">
                            <div class="brand-logo"><img class="img-responsive" src="assets/images/amazon.jpg"></div>
                            <div class="offer-banner"><img src="assets/images/offer-banner.jpg"></div>
                            <div class="book-offer-desc">
                                <p>Set of three Deos-wild stone(150ml) + Axe provoke(150ml) + ks spark...</p>
                                <div class="book-offer-code">AJD89</div>
                                <span class="btn btn-primary btn-blue">Book your offer</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <div class="product-thumb">
                        <a href="#">
                            <div class="brand-logo"><img class="img-responsive" src="assets/images/amazon.jpg"></div>
                            <div class="offer-banner"><img src="assets/images/offer-banner.jpg"></div>
                            <div class="book-offer-desc">
                                <p>Set of three Deos-wild stone(150ml) + Axe provoke(150ml) + ks spark...</p>
                                <div class="book-offer-code">AJD89</div>
                                <span class="btn btn-primary btn-blue">Book your offer</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <div class="product-thumb">
                        <a href="#">
                            <div class="brand-logo"><img class="img-responsive" src="assets/images/amazon.jpg"></div>
                            <div class="offer-banner"><img src="assets/images/offer-banner.jpg"></div>
                            <div class="book-offer-desc">
                                <p>Set of three Deos-wild stone(150ml) + Axe provoke(150ml) + ks spark...</p>
                                <div class="book-offer-code">AJD89</div>
                                <span class="btn btn-primary btn-blue">Book your offer</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <div class="product-thumb">
                        <a href="#">
                            <div class="brand-logo"><img class="img-responsive" src="assets/images/amazon.jpg"></div>
                            <div class="offer-banner"><img src="assets/images/offer-banner.jpg"></div>
                            <div class="book-offer-desc">
                                <p>Set of three Deos-wild stone(150ml) + Axe provoke(150ml) + ks spark...</p>
                                <div class="book-offer-code">AJD89</div>
                                <span class="btn btn-primary btn-blue">Book your offer</span>
                            </div>
                        </a>
                    </div>
                </div>
               <div class="col-xs-12 col-sm-3">
                    <div class="product-thumb">
                        <a href="#">
                            <div class="brand-logo"><img class="img-responsive" src="assets/images/amazon.jpg"></div>
                            <div class="offer-banner"><img src="assets/images/offer-banner.jpg"></div>
                            <div class="book-offer-desc">
                                <p>Set of three Deos-wild stone(150ml) + Axe provoke(150ml) + ks spark...</p>
                                <div class="book-offer-code">AJD89</div>
                                <span class="btn btn-primary btn-blue">Book your offer</span>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
            <div class="clear"></div>
            <div class="loadmore">
                <img src="assets/images/103.gif" alt="">
            </div>
        </div>
    </main>
    <!-- / Main Content box -->
    <footer>
        <div class="container">
            <div class="col-xs-12 col-sm-8">
                <span class="copy">&copy;2016, booqwala</span>
            </div>
            <div class="col-xs-12 col-sm-4 social-media">
                keep in touch
                <ul>
                    <li><a href="javascript:void(0)"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
    </footer>
    <!-- /. footer -->

    <!-- script linking -->
    <script type="text/javascript" src="assets/js/jquery.1.12.4.js"></script>
    <script type="text/javascript" src="assets/js/modernizr-3.0.0.js" async defer></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js" async defer></script>
    <script type="text/javascript" src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="assets/js/global.js" charset="utf-8"></script>

</body>

</html>
