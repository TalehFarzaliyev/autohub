    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <article class="content">
                    <div class="post-thumb">
                        <img src="{base_url('uploads/')}{$news.image}" class="img-responsive post-image" alt="{$news.name}">
                        <div class="social">
                            <ul>
                                <li><a href="#" class="facebook"><i class="fa  fa-facebook"></i><span>3987</span> </a></li>
                                <li><a href="#" class="twitter"><i class="fa  fa-twitter"></i><span>3987</span></a></li>
                                <li><a href="#" class="google"><i class="fa  fa-google-plus"></i><span>3987</span></a></li>
                            </ul>
                        </div>
                        <!-- /.social icon -->
                    </div>
                    <h1>{$news.name}</h1>
                    <div class="date">
                        <ul>
                            <li><a title="" href="#"><span>AutoHub Editor</span></a> --</li>
                            <li><a title="" href="#">{$news.created_at}</a> --</li>
                        </ul>
                    </div>
                    <p>{$news.description}</p>
                    <!-- tags -->
{*                    <div class="tags">*}
{*                        <ul>*}
{*                            <li> <a href="#">Education</a></li>*}
{*                            <li> <a href="#">Health &amp; Fitness</a></li>*}
{*                            <li><a href="#">Fashion</a></li>*}
{*                            <li><a href="#">Collage</a></li>*}
{*                            <li><a href="#">Business</a></li>*}
{*                            <li><a href="#">Music</a></li>*}
{*                            <li><a href="#">Blog</a></li>*}
{*                            <li><a href="#">Lifestyle</a></li>*}
{*                        </ul>*}
{*                    </div>*}
                    <!-- Related news area
                        ============================================ -->
{*                    <div class="related-news-inner">*}
{*                        <h3 class="category-headding ">Oxşar Xəbərlər</h3>*}
{*                        <div class="headding-border"></div>*}
{*                        <div class="row">*}
{*                            <div id="content-slide-5" class="owl-carousel">*}
{*                                <!-- item-1 -->*}
{*                                <div class="item">*}
{*                                    <div class="row rn_block">*}
{*                                        <div class="col-xs-12 col-md-4 col-sm-4 padd">*}
{*                                            <div class="post-wrapper wow fadeIn" data-wow-duration="2s">*}
{*                                                <!-- image -->*}
{*                                                <div class="post-thumb">*}
{*                                                    <a href="#">*}
{*                                                        <img class="img-responsive" src="images/articale.jpg" alt="">*}
{*                                                    </a>*}
{*                                                </div>*}
{*                                                <div class="post-info meta-info-rn">*}
{*                                                    <div class="slide">*}
{*                                                        <a target="_blank" href="#" class="post-badge btn_five">B</a>*}
{*                                                    </div>*}
{*                                                </div>*}
{*                                            </div>*}
{*                                            <div class="post-title-author-details">*}
{*                                                <h4><a href="#">World Econmy Changing and Affecting in 3rd ...</a></h4>*}
{*                                                <div class="post-editor-date">*}
{*                                                    <div class="post-date">*}
{*                                                        <i class="pe-7s-clock"></i> Oct 6, 2016*}
{*                                                    </div>*}
{*                                                    <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>*}
{*                                                </div>*}
{*                                            </div>*}
{*                                        </div>*}
{*                                        <div class="col-xs-6 col-md-4 col-sm-4 padd">*}
{*                                            <div class="post-wrapper wow fadeIn" data-wow-duration="2s" data-wow-delay="0.2s">*}
{*                                                <!-- image -->*}
{*                                                <div class="post-thumb">*}
{*                                                    <a href="#">*}
{*                                                        <img class="img-responsive" src="images/articale02.jpg" alt="">*}
{*                                                    </a>*}
{*                                                </div>*}
{*                                                <div class="post-info meta-info-rn">*}
{*                                                    <div class="slide">*}
{*                                                        <a target="_blank" href="#" class="post-badge btn_three">S</a>*}
{*                                                    </div>*}
{*                                                </div>*}
{*                                            </div>*}
{*                                            <div class="post-title-author-details">*}
{*                                                <h4><a href="#">World Econmy Changing and Affecting in 3rd ...</a></h4>*}
{*                                                <div class="post-editor-date">*}
{*                                                    <div class="post-date">*}
{*                                                        <i class="pe-7s-clock"></i> Oct 6, 2016*}
{*                                                    </div>*}
{*                                                    <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>*}
{*                                                </div>*}
{*                                            </div>*}
{*                                        </div>*}
{*                                        <div class="col-xs-6 col-md-4 col-sm-4 padd">*}
{*                                            <div class="post-wrapper wow fadeIn" data-wow-duration="2s" data-wow-delay="0.4s">*}
{*                                                <!-- image -->*}
{*                                                <div class="post-thumb">*}
{*                                                    <a href="#">*}
{*                                                        <img class="img-responsive" src="images/articale03.jpg" alt="">*}
{*                                                    </a>*}
{*                                                </div>*}
{*                                                <div class="post-info meta-info-rn">*}
{*                                                    <div class="slide">*}
{*                                                        <a target="_blank" href="#" class="post-badge btn_one">F</a>*}
{*                                                    </div>*}
{*                                                </div>*}
{*                                            </div>*}
{*                                            <div class="post-title-author-details">*}
{*                                                <h4><a href="#">World Econmy Changing and Affecting in 3rd ...</a></h4>*}
{*                                                <div class="post-editor-date">*}
{*                                                    <div class="post-date">*}
{*                                                        <i class="pe-7s-clock"></i> Oct 6, 2016*}
{*                                                    </div>*}
{*                                                    <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>*}
{*                                                </div>*}
{*                                            </div>*}
{*                                        </div>*}
{*                                    </div>*}
{*                                </div>*}
{*                                <!-- item-2 -->*}
{*                                <div class="item">*}
{*                                    <div class="row rn_block">*}
{*                                        <div class="col-xs-12 col-md-4 col-sm-4 padd">*}
{*                                            <div class="post-wrapper wow fadeIn" data-wow-duration="2s" data-wow-delay="0.6s">*}
{*                                                <!-- image -->*}
{*                                                <div class="post-thumb">*}
{*                                                    <a href="#">*}
{*                                                        <img class="img-responsive" src="images/articale04.jpg" alt="">*}
{*                                                    </a>*}
{*                                                </div>*}
{*                                                <div class="post-info meta-info-rn">*}
{*                                                    <div class="slide">*}
{*                                                        <a target="_blank" href="#" class="post-badge btn_eight">H</a>*}
{*                                                    </div>*}
{*                                                </div>*}
{*                                            </div>*}
{*                                            <div class="post-title-author-details">*}
{*                                                <h4><a href="#">World Econmy Changing and Affecting in 3rd ...</a></h4>*}
{*                                                <div class="post-editor-date">*}
{*                                                    <div class="post-date">*}
{*                                                        <i class="pe-7s-clock"></i> Oct 6, 2016*}
{*                                                    </div>*}
{*                                                    <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>*}
{*                                                </div>*}
{*                                            </div>*}
{*                                        </div>*}
{*                                        <div class="col-xs-6 col-md-4 col-sm-4 padd">*}
{*                                            <div class="post-wrapper wow fadeIn" data-wow-duration="2s" data-wow-delay="0.8s">*}
{*                                                <!-- image -->*}
{*                                                <div class="post-thumb">*}
{*                                                    <a href="#">*}
{*                                                        <img class="img-responsive" src="images/articale05.jpg" alt="">*}
{*                                                    </a>*}
{*                                                </div>*}
{*                                                <div class="post-info meta-info-rn">*}
{*                                                    <div class="slide">*}
{*                                                        <a target="_blank" href="#" class="post-badge btn_four">L</a>*}
{*                                                    </div>*}
{*                                                </div>*}
{*                                            </div>*}
{*                                            <div class="post-title-author-details">*}
{*                                                <h4><a href="#">World Econmy Changing and Affecting in 3rd ...</a></h4>*}
{*                                                <div class="post-editor-date">*}
{*                                                    <div class="post-date">*}
{*                                                        <i class="pe-7s-clock"></i> Oct 6, 2016*}
{*                                                    </div>*}
{*                                                    <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>*}
{*                                                </div>*}
{*                                            </div>*}
{*                                        </div>*}
{*                                        <div class="col-xs-6 col-md-4 col-sm-4 padd">*}
{*                                            <div class="post-wrapper wow fadeIn" data-wow-duration="2s" data-wow-delay="1s">*}
{*                                                <!-- image -->*}
{*                                                <div class="post-thumb">*}
{*                                                    <a href="#">*}
{*                                                        <img class="img-responsive" src="images/articale06.jpg" alt="">*}
{*                                                    </a>*}
{*                                                </div>*}
{*                                                <div class="post-info meta-info-rn">*}
{*                                                    <div class="slide">*}
{*                                                        <a target="_blank" href="#" class="post-badge btn_two">T</a>*}
{*                                                    </div>*}
{*                                                </div>*}
{*                                            </div>*}
{*                                            <div class="post-title-author-details">*}
{*                                                <h4><a href="#">World Econmy Changing and Affecting in 3rd ...</a></h4>*}
{*                                                <div class="post-editor-date">*}
{*                                                    <div class="post-date">*}
{*                                                        <i class="pe-7s-clock"></i> Oct 6, 2016*}
{*                                                    </div>*}
{*                                                    <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>*}
{*                                                </div>*}
{*                                            </div>*}
{*                                        </div>*}
{*                                    </div>*}
{*                                </div>*}
{*                            </div>*}
{*                        </div>*}
{*                    </div>*}
                </article>
            </div>
            <div class="col-sm-4 left-padding">
                <aside class="sidebar">

                    <!-- /.search area -->
                    <div class="banner-add">
                        <!-- add -->
                        <span class="add-title">- Advertisement -</span>
                        <a href="#"><img src="images/ad-banner.jpg" class="img-responsive center-block" alt=""></a>
                    </div>
                    <div class="tab-inner">
                        <ul class="tabs">
                            <li><a href="#">POPULAR</a></li>
                            <li><a href="#">MOST VIEWED</a></li>
                        </ul>
                        <hr>
                        <!-- tabs -->
                        <div class="tab_content">
                            <div class="tab-item-inner">
                                <div class="box-item wow fadeIn" data-wow-duration="1s">
                                    <div class="img-thumb">
                                        <a href="#" rel="bookmark"><img class="entry-thumb" src="images/popular_news_01.jpg" alt="" height="80" width="90"></a>
                                    </div>
                                    <div class="item-details">
                                        <h6 class="sub-category-title bg-color-1">
                                                <a href="#">SPORTS</a>
                                            </h6>
                                        <h3 class="td-module-title"><a href="#">It is a long established fact that a reader will</a></h3>
                                        <div class="post-editor-date">
                                            <!-- post date -->
                                            <div class="post-date">
                                                <i class="pe-7s-clock"></i> Oct 6, 2016
                                            </div>
                                            <!-- post comment -->
                                            <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
                                    <div class="img-thumb">
                                        <a href="#" rel="bookmark"><img class="entry-thumb" src="images/popular_news_02.jpg" alt="" height="80" width="90"></a>
                                    </div>
                                    <div class="item-details">
                                        <h6 class="sub-category-title bg-color-2">
                                                <a href="#">TECHNOLOGY </a>
                                            </h6>
                                        <h3 class="td-module-title"><a href="#">The generated Lorem Ipsum is therefore</a></h3>
                                        <div class="post-editor-date">
                                            <!-- post date -->
                                            <div class="post-date">
                                                <i class="pe-7s-clock"></i> Oct 6, 2016
                                            </div>
                                            <!-- post comment -->
                                            <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
                                    <div class="img-thumb">
                                        <a href="#" rel="bookmark"><img class="entry-thumb" src="images/popular_news_03.jpg" alt="" height="80" width="90"></a>
                                    </div>
                                    <div class="item-details">
                                        <h6 class="sub-category-title bg-color-3">
                                                <a href="#">HEALTH</a>
                                            </h6>
                                        <h3 class="td-module-title"><a href="#">The standard chunk of Lorem Ipsum used since</a></h3>
                                        <div class="post-editor-date">
                                            <!-- post date -->
                                            <div class="post-date">
                                                <i class="pe-7s-clock"></i> Oct 6, 2016
                                            </div>
                                            <!-- post comment -->
                                            <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">
                                    <div class="img-thumb">
                                        <a href="#" rel="bookmark"><img class="entry-thumb" src="images/popular_news_04.jpg" alt="" height="80" width="90"></a>
                                    </div>
                                    <div class="item-details">
                                        <h6 class="sub-category-title bg-color-4">
                                                <a href="#">FASHION</a>
                                            </h6>
                                        <h3 class="td-module-title"><a href="#">Lorem Ipum therefore always free from</a></h3>
                                        <div class="post-editor-date">
                                            <!-- post date -->
                                            <div class="post-date">
                                                <i class="pe-7s-clock"></i> Oct 6, 2016
                                            </div>
                                            <!-- post comment -->
                                            <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- / tab item -->
                            <div class="tab-item-inner">
                                <div class="box-item">
                                    <div class="img-thumb">
                                        <a href="#" rel="bookmark"><img class="entry-thumb" src="images/popular_news_01.jpg" alt="" height="80" width="90"></a>
                                    </div>
                                    <div class="item-details">
                                        <h6 class="sub-category-title bg-color-5">
                                                <a href="#">BUSINESS</a>
                                            </h6>
                                        <h3 class="td-module-title"><a href="#">It is a long established fact that a reader will</a></h3>
                                        <div class="post-editor-date">
                                            <!-- post date -->
                                            <div class="post-date">
                                                <i class="pe-7s-clock"></i> Oct 6, 2016
                                            </div>
                                            <!-- post comment -->
                                            <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-item">
                                    <div class="img-thumb">
                                        <a href="#" rel="bookmark"><img class="entry-thumb" src="images/popular_news_02.jpg" alt="" height="80" width="90"></a>
                                    </div>
                                    <div class="item-details">
                                        <h6 class="sub-category-title bg-color-2">
                                                <a href="#">TECHNOLOGY </a>
                                            </h6>
                                        <h3 class="td-module-title"><a href="#">The generated Lorem Ipsum is therefore</a></h3>
                                        <div class="post-editor-date">
                                            <!-- post date -->
                                            <div class="post-date">
                                                <i class="pe-7s-clock"></i> Oct 6, 2016
                                            </div>
                                            <!-- post comment -->
                                            <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-item">
                                    <div class="img-thumb">
                                        <a href="#" rel="bookmark"><img class="entry-thumb" src="images/popular_news_03.jpg" alt="" height="80" width="90"></a>
                                    </div>
                                    <div class="item-details">
                                        <h6 class="sub-category-title bg-color-3">
                                                <a href="#">HEALTH</a>
                                            </h6>
                                        <h3 class="td-module-title"><a href="#">The standard chunk of Lorem Ipsum used since</a></h3>
                                        <div class="post-editor-date">
                                            <!-- post date -->
                                            <div class="post-date">
                                                <i class="pe-7s-clock"></i> Oct 6, 2016
                                            </div>
                                            <!-- post comment -->
                                            <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-item">
                                    <div class="img-thumb">
                                        <a href="#" rel="bookmark"><img class="entry-thumb" src="images/popular_news_04.jpg" alt="" height="80" width="90"></a>
                                    </div>
                                    <div class="item-details">
                                        <h6 class="sub-category-title bg-color-4">
                                                <a href="#">FASHION</a>
                                            </h6>
                                        <h3 class="td-module-title"><a href="#">Lorem Ipum therefore always free from</a></h3>
                                        <div class="post-editor-date">
                                            <!-- post date -->
                                            <div class="post-date">
                                                <i class="pe-7s-clock"></i> Oct 6, 2016
                                            </div>
                                            <!-- post comment -->
                                            <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- / tab item -->
                        </div>
                        <!-- / tab_content -->
                    </div>
                    <!-- / tab -->

                    <!-- slider widget -->
                    <div class="widget-slider-inner">
                        <h3 class="category-headding ">Slider Widget</h3>
                        <div class="headding-border"></div>
                        <div id="widget-slider" class="owl-carousel owl-theme">
                            <!-- widget item -->
                            <div class="item">
                                <a href="#"><img src="images/slider-widget-1.jpg" alt=""></a>
                                <h4><a href="#">For good results must be make good plan</a></h4>
                                <div class="date">
                                    <ul>
                                        <li>By<a title="" href="#"><span>Jone Kilna</span></a> --</li>
                                        <li><a title="" href="#">11 Nov 2015</a></li>
                                    </ul>
                                </div>
                                <p>Dhaka: Dhaka Metropolitan Sessions a Judge Court on Wednesday issued warrants for the arrest of 29 BNP leaders, including some ina senior leaders...</p>
                            </div>
                            <!-- widget item -->
                            <div class="item">
                                <a href="#"><img src="images/slider-widget-2.jpg" alt=""></a>
                                <h4><a href="#">Dog invason sparks chaos at IPL match</a></h4>
                                <div class="date">
                                    <ul>
                                        <li>By<a title="" href="#"><span>Jone Kilna</span></a> --</li>
                                        <li><a title="" href="#">11 Nov 2015</a></li>
                                    </ul>
                                </div>
                                <p>Dhaka: Dhaka Metropolitan Sessions a Judge Court on Wednesday issued warrants for the arrest of 29 BNP leaders, including some ina senior leaders ...</p>
                            </div>
                            <!-- widget item -->
                            <div class="item">
                                <a href="#"><img src="images/slider-widget-3.jpg" alt=""></a>
                                <h4><a href="#">For good results must be make good plan</a></h4>
                                <div class="date">
                                    <ul>
                                        <li>By<a title="" href="#"><span>Jone Kilna</span></a> --</li>
                                        <li><a title="" href="#">11 Nov 2015</a></li>
                                    </ul>
                                </div>
                                <p>Dhaka: Dhaka Metropolitan Sessions a Judge Court on Wednesday issued warrants for the arrest of 29 BNP leaders, including some ina senior leaders ...</p>
                            </div>
                        </div>
                    </div>

                </aside>
            </div>
        </div>
    </div>



