{if !empty($news_list.slider)}
<section class="headding-news">
    <div class="container">
        <div class="row row-margin">
            <div class="col-sm-3 col-padding">
                <div class="post-wrapper post-grid-1 wow fadeIn" data-wow-duration="2s">
                    <div class="post-thumb img-zoom-in">
                        <a href="{base_url('xeber/')}{$news_list.slider.0.slug}">
                            <img class="entry-thumb" src="{base_url('uploads/')}{$news_list.slider.0.image}" alt="">
                        </a>
                    </div>
                    <div class="post-info">
                        <h3 class="post-title post-title-size"><a href="{base_url('xeber/')}{$news_list.slider.0.slug}" rel="bookmark"> {$news_list.slider.0.name} </a></h3>
                        <div class="post-editor-date">
                            <!-- post date -->
                            <div class="post-date">
                                <i class="pe-7s-clock"></i> Oct 6, 2016
                            </div>
                            <!-- post comment -->
                            <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>
                            <!-- read more -->
                            <a class="readmore pull-right" href="{base_url('xeber/')}{$news_list.slider.0.slug}"><i class="pe-7s-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="post-wrapper post-grid-2 wow fadeIn" data-wow-duration="2s">
                    <div class="post-thumb img-zoom-in">
                        <a href="{base_url('xeber/')}{$news_list.slider.1.slug}">
                            <img class="entry-thumb" src="{base_url('uploads/')}{$news_list.slider.1.image}" alt="">
                        </a>
                    </div>
                    <div class="post-info">
                        <h3 class="post-title post-title-size"><a href="{base_url('xeber/')}{$news_list.slider.1.slug}" rel="bookmark">{$news_list.slider.1.name} </a></h3>
                        <div class="post-editor-date">
                            <!-- post date -->
                            <div class="post-date">
                                <i class="pe-7s-clock"></i> Oct 6, 2016
                            </div>
                            <!-- read more -->
                            <a class="readmore pull-right" href="{base_url('xeber/')}{$news_list.slider.1.slug}"><i class="pe-7s-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-padding">
                <div class="post-wrapper post-grid-3 wow fadeIn" data-wow-duration="2s">
                    <div class="post-thumb img-zoom-in">
                        <a href="{base_url('xeber/')}{$news_list.slider.2.slug}">
                            <img class="entry-thumb-middle" src="{base_url('uploads/')}{$news_list.slider.2.image}" alt="">
                        </a>
                    </div>
                    <div class="post-info">
                        <h3 class="post-title"><a href="{base_url('xeber/')}{$news_list.slider.2.slug}" rel="bookmark">{$news_list.slider.2.name} </a></h3>
                        <div class="post-editor-date">
                            <!-- post date -->
                            <div class="post-date">
                                <i class="pe-7s-clock"></i> Oct 6, 2016
                            </div>
                            <!-- read more -->
                            <a class="readmore pull-right" href="{base_url('xeber/')}{$news_list.slider.2.slug}"><i class="pe-7s-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-padding">
                <div class="post-wrapper post-grid-4 wow fadeIn" data-wow-duration="2s">
                    <div class="post-thumb img-zoom-in">
                        <a href="{base_url('xeber/')}{$news_list.slider.3.slug}">
                            <img class="entry-thumb" src="{base_url('uploads/')}{$news_list.slider.3.image}" alt="">
                        </a>
                    </div>
                    <div class="post-info">
                        <h3 class="post-title post-title-size"><a href="{base_url('xeber/')}{$news_list.slider.3.slug}" rel="bookmark">{$news_list.slider.3.name}</a></h3>
                        <div class="post-editor-date">
                            <!-- post date -->
                            <div class="post-date">
                                <i class="pe-7s-clock"></i> Oct 6, 2016
                            </div>
                            <!-- read more -->
                            <a class="readmore pull-right" href="{base_url('xeber/')}{$news_list.slider.3.slug}"><i class="pe-7s-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="post-wrapper post-grid-5 wow fadeIn" data-wow-duration="2s">
                    <div class="post-thumb img-zoom-in">
                        <a href="{base_url('xeber/')}{$news_list.slider.4.slug}">
                            <img class="entry-thumb" src="{base_url('uploads/')}{$news_list.slider.4.image}" alt="">
                        </a>
                    </div>
                    <div class="post-info">

                        <h3 class="post-title post-title-size"><a href="{base_url('xeber/')}{$news_list.slider.4.slug}" rel="bookmark">{$news_list.slider.4.name} </a></h3>
                        <div class="post-editor-date">
                            <!-- post date -->
                            <div class="post-date">
                                <i class="pe-7s-clock"></i> Oct 6, 2016
                            </div>
                            <!-- read more -->
                            <a class="readmore pull-right" href="{base_url('xeber/')}{$news_list.slider.4.slug}"><i class="pe-7s-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{/if}

<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-8">
            <!-- left content inner -->
            {if !empty($news_list.recent)}
            <section class="recent_news_inner">
                <h3 class="category-headding ">Son Xəbərlər</h3>
                <div class="headding-border"></div>

                <div class="row rn_block">
                    {foreach from=$news_list.recent key=k item=post}
                    {if $k < 4}
                    <div class="col-md-3 col-sm-3 padd">
                        <div class="home2-post">
                            <div class="post-wrapper wow fadeIn" data-wow-duration="1s">
                                <!-- image -->
                                <div class="post-thumb">
                                    <a href="{base_url('xeber/')}{$post.slug}">
                                        <img class="img-responsive" src="{base_url('uploads/')}{$post.image}" alt="{$post.name}">
                                    </a>
                                </div>
                            </div>
                            <div class="post-title-author-details">
                                <h4><a href="{base_url('xeber/')}{$post.slug}">{$post.name}</a></h4>
                            </div>
                        </div>
                    </div>
                    {/if}
                    {/foreach}
                </div>
            </section>
            {/if}
            {if !empty($news_list.next)}
            <section class="politics_wrapper">
                <h3 class="category-headding ">Qarışıq</h3>
                <div class="headding-border"></div>
                <div class="row">
                    <div id="content-slide-2" class="owl-carousel">
                        <!-- item-2 -->
                        <div class="item">
                            <div class="row">
                                <!-- main post -->
                                <!-- right side post -->
                                <div class="col-sm-12 col-md-12">
                                    <div class="row rn_block">
                                        {foreach from=$news_list.next key=k item=post}
                                            {if $k < 4}
                                        <div class="col-xs-6 col-md-6 col-sm-6 post-padding">
                                            <div class="home2-post">
                                                <!-- post image -->
                                                <div class="post-thumb wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
                                                    <a href="{base_url('xeber/')}{$post.slug}">
                                                        <img src="{base_url('uploads/')}{$post.image}" class="img-responsive" alt="{$post.name}">
                                                    </a>
                                                </div>
                                                <div class="post-title-author-details">
                                                    <!-- post image -->
                                                    <h5><a href="{base_url('xeber/')}{$post.slug}">{$post.name}</a></h5>
                                                </div>
                                            </div>
                                        </div>
                                            {/if}
                                        {/foreach}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </section>
            {/if}
            <!-- /.Politics -->
            <div class="ads">
                <a href="#"><img src="{base_url('templates/default/assets/')}images/top-bannner2.jpg" class="img-responsive center-block" alt=""></a>
            </div>
        </div>
        <!-- /.left content inner -->
        <div class="col-md-4 col-sm-4 left-padding">
            <!-- right content wrapper -->
            <div class="input-group search-area">
                <!-- search area -->
                <input type="text" class="form-control" placeholder="Axtar...." name="q">
                <div class="input-group-btn">
                    <button class="btn btn-search" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </div>
            <!-- /.search area -->
            <!-- social icon -->
            <h3 class="category-headding ">Sosial Hesablar</h3>
            <div class="headding-border"></div>
            <div class="social">
                <ul>
                    <li><a href="#" class="facebook"><i class="fa  fa-facebook"></i><span>3987</span> </a></li>
                    <li><a href="#" class="twitter"><i class="fa  fa-twitter"></i><span>3987</span></a></li>
                    <li><a href="#" class="google"><i class="fa  fa-google-plus"></i><span>3987</span></a></li>
                    <li><a href="#" class="flickr"><i class="fa fa-flickr"></i><span>3987</span> </a></li>
                </ul>
            </div>
            <!-- /.social icon -->
            <div class="banner-add">
                <!-- add -->
                <span class="add-title">- Advertisement -</span>
                <a href="#"><img src="{base_url('templates/default/assets/')}images/ad-banner.jpg" class="img-responsive center-block" alt=""></a>
            </div>
            <div class="tab-inner">
                <ul class="tabs">
                    <li><a href="#">Populyar</a></li>
                    <li><a href="#">Ən Çox Baxılan</a></li>
                </ul>
                <hr>
                <!-- tabs -->
                <div class="tab_content">
                    {if !empty($news_list.most)}
                    <div class="tab-item-inner">
                        {foreach from=$news_list.most item=post}
                        <div class="box-item wow fadeIn" data-wow-duration="1s">
                            <div class="img-thumb">
                                <a href="{base_url('xeber/')}{$post.slug}" rel="bookmark"><img class="entry-thumb" src="{base_url('uploads/')}{$post.image}" alt="{$post.name}" height="80" width="90"></a>
                            </div>
                            <div class="item-details">
                                <h3 class="td-module-title"><a href="{base_url('xeber/')}{$post.slug}">{$post.name}</a></h3>
                            </div>
                        </div>
                        {/foreach}
                    </div>
                    {/if}
                    <!-- / tab item -->
                    {if !empty($news_list.last_news)}
                    <div class="tab-item-inner">
                        {foreach from=$news_list.last_news item=post}
                        <div class="box-item">
                            <div class="img-thumb">
                                <a href="{base_url('xeber/')}{$post.slug}" rel="bookmark"><img class="entry-thumb" src="{base_url('uploads/')}{$post.image}" alt="{$post.name}" height="80" width="90"></a>
                            </div>
                            <div class="item-details">
                                <h3 class="td-module-title"><a href="#">{$post.name}</a></h3>
                            </div>
                        </div>
                        {/foreach}
                    </div>
                    {/if}
                    <!-- / tab item -->
                </div>
                <!-- / tab_content -->
            </div>
            <!-- / tab -->
        </div>
        <!-- side content end -->
    </div>
    <!-- row end -->
</div>
<!-- container end -->
<!-- Article Post
    ============================================ -->
<section class="article-post-inner">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
{*                <div class="articale-list">*}
{*                    <h3 class="category-headding ">Latest News</h3>*}
{*                    <div class="headding-border"></div>*}
{*                    <!--Post list-->*}
{*                    <div class="post-style2 wow fadeIn" data-wow-duration="1s">*}
{*                        <a href="#"><img src="{base_url('templates/default/assets/')}images/category/category-post-11.jpg" alt=""></a>*}
{*                        <div class="post-style2-detail">*}
{*                            <h3><a href="#" title="">It uses a dictionary of over 200 Latin words, combined with</a></h3>*}
{*                            <div class="date">*}
{*                                <ul>*}
{*                                    <li><img src="{base_url('templates/default/assets/')}images/comment-01.jpg" class="img-responsive" alt=""></li>*}
{*                                    <li>By <a title="" href="#"><span>Naeem Khan</span></a> --</li>*}
{*                                    <li><a title="" href="#">Oct 6, 2016</a> --</li>*}
{*                                    <li><a title="" href="#"><span>275 Comments</span></a></li>*}
{*                                </ul>*}
{*                            </div>*}
{*                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh.</p>*}
{*                            <button type="button" class="btn btn-style">Reade more</button>*}
{*                        </div>*}
{*                    </div>*}
{*                    <!--Post list-->*}
{*                    <div class="post-style2 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">*}
{*                        <a href="#"><img src="{base_url('templates/default/assets/')}images/category/category-post-12.jpg" alt=""></a>*}
{*                        <div class="post-style2-detail">*}
{*                            <h3><a href="#" title="">Lorem Ipsum is simply dummy text of the printing .</a></h3>*}
{*                            <div class="date">*}
{*                                <ul>*}
{*                                    <li><img src="{base_url('templates/default/assets/')}images/comment-02.jpg" class="img-responsive" alt=""></li>*}
{*                                    <li>By <a title="" href="#"><span>Naeem Khan</span></a> --</li>*}
{*                                    <li><a title="" href="#">Oct 6, 2016</a> --</li>*}
{*                                    <li><a title="" href="#"><span>275 Comments</span></a></li>*}
{*                                </ul>*}
{*                            </div>*}
{*                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh.</p>*}
{*                            <button type="button" class="btn btn-style">Reade more</button>*}
{*                        </div>*}
{*                    </div>*}
{*                    <!-- Post list -->*}
{*                    <div class="post-style2 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">*}
{*                        <a href="#"><img src="{base_url('templates/default/assets/')}images/category/category-post-13.jpg" alt=""></a>*}
{*                        <div class="post-style2-detail">*}
{*                            <h3><a href="#" title="">If you are going to use a passage of Lorem Ipsum .</a></h3>*}
{*                            <div class="date">*}
{*                                <ul>*}
{*                                    <li><img src="{base_url('templates/default/assets/')}images/comment-01.jpg" class="img-responsive" alt=""></li>*}
{*                                    <li>By <a title="" href="#"><span>Naeem Khan</span></a> --</li>*}
{*                                    <li><a title="" href="#">Oct 6, 2016</a> --</li>*}
{*                                    <li><a title="" href="#"><span>275 Comments</span></a></li>*}
{*                                </ul>*}
{*                            </div>*}
{*                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh.</p>*}
{*                            <button type="button" class="btn btn-style">Reade more</button>*}
{*                        </div>*}
{*                    </div>*}
{*                    <!-- Post list -->*}
{*                    <div class="post-style2 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">*}
{*                        <a href="#"><img src="{base_url('templates/default/assets/')}images/category/category-post-14.jpg" alt=""></a>*}
{*                        <div class="post-style2-detail">*}
{*                            <h3><a href="#" title="">Check Out the Amazing Photos of Lauren Conradâ€™s Trip</a></h3>*}
{*                            <div class="date">*}
{*                                <ul>*}
{*                                    <li><img src="{base_url('templates/default/assets/')}images/comment-02.jpg" class="img-responsive" alt=""></li>*}
{*                                    <li>By <a title="" href="#"><span>Naeem Khan</span></a> --</li>*}
{*                                    <li><a title="" href="#">Oct 6, 2016</a> --</li>*}
{*                                    <li><a title="" href="#"><span>275 Comments</span></a></li>*}
{*                                </ul>*}
{*                            </div>*}
{*                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh.</p>*}
{*                            <button type="button" class="btn btn-style">Reade more</button>*}
{*                        </div>*}
{*                    </div>*}
{*                    <!-- Post list -->*}
{*                    <div class="post-style2 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.4s">*}
{*                        <a href="#"><img src="{base_url('templates/default/assets/')}images/category/category-post-15.jpg" alt=""></a>*}
{*                        <div class="post-style2-detail">*}
{*                            <h3><a href="#" title="">Many desktop publishing packages and web page.</a></h3>*}
{*                            <div class="date">*}
{*                                <ul>*}
{*                                    <li><img src="{base_url('templates/default/assets/')}images/comment-01.jpg" class="img-responsive" alt=""></li>*}
{*                                    <li>By <a title="" href="#"><span>Naeem Khan</span></a> --</li>*}
{*                                    <li><a title="" href="#">Oct 6, 2016</a> --</li>*}
{*                                    <li><a title="" href="#"><span>275 Comments</span></a></li>*}
{*                                </ul>*}
{*                            </div>*}
{*                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh.</p>*}
{*                            <button type="button" class="btn btn-style">Reade more</button>*}
{*                        </div>*}
{*                    </div>*}
{*                </div>*}
            </div>
            <div class="col-sm-4 left-padding">
                <!-- online vote -->
                <div class="online-vote">
                    <h3 class="category-headding ">Onlayn Səsvermə</h3>
                    <div class="headding-border"></div>
                    <div class="vote-inner">
                        <p>All the Lorem Ipsum generators the Internet tend repeat predefined chunks as necessary, making this the . </p>
                        <div class="radio-btn">
                            <label class="radio-inline">
                                <input type="radio" name="optradio">Bəli</label>
                            <label class="radio-inline">
                                <input type="radio" name="optradio">Xeyr</label>
                            <label class="radio-inline">
                                <input type="radio" name="optradio">Bilmirəm</label>
                        </div>
                        <button type="button" class="btn btn-style">Göndər</button>
                    </div>
                </div>
                <!-- /.online vote -->
                <!-- slider widget -->
            </div>
        </div>
    </div>
</section>