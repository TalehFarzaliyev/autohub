{if !empty($category)}
<section class="block-inner">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>{$category.name}</h1>
                <div class="breadcrumbs">
                    <ul>
                        <li><i class="pe-7s-home"></i> <a href="{base_url()}" title="Əsas Səhifə">Əsas</a></li>
                        <li><a href="{$category.slug}" title="{$category.name}">{$category.name}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
{/if}
<div class="container">
    <div class="row">
        {if !empty($news_list)}
        <div class="col-sm-8">
            <!--Post list-->
            {foreach from=$news_list key=k item=post}
            <div class="post-style2 wow fadeIn" data-wow-duration="1s">
                <a href="{$post.slug}"><img src="{base_url('uploads/')}{$post.image}" alt="{$post.name}"></a>
                <div class="post-style2-detail">
                    <h3><a href="{$post.slug}" title="">{$post.name}</a></h3>
                    <div class="date">

                    </div>
                    <p>{$post.desc_text}</p>
                    <button type="button" class="btn btn-style">Ardını Oxu</button>
                </div>
            </div>
            {/foreach}
            <!--Post list-->
        </div>
        {/if}
{*        <aside class="col-sm-4 left-padding">*}
{*            <div class="input-group search-area">*}
{*                <!-- search area -->*}
{*                <input type="text" class="form-control" placeholder="Search articles here ..." name="q">*}
{*                <div class="input-group-btn">*}
{*                    <button class="btn btn-search" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>*}
{*                </div>*}
{*            </div>*}
{*            <!-- social icon -->*}
{*            <h3 class="category-headding ">SOCIAL PIXEL</h3>*}
{*            <div class="headding-border"></div>*}
{*            <div class="social">*}
{*                <ul>*}
{*                    <li><a href="#" class="facebook"><i class="fa  fa-facebook"></i><span>3987</span> </a></li>*}
{*                    <li><a href="#" class="twitter"><i class="fa  fa-twitter"></i><span>3987</span></a></li>*}
{*                    <li><a href="#" class="google"><i class="fa  fa-google-plus"></i><span>3987</span></a></li>*}
{*                    <li><a href="#" class="flickr"><i class="fa fa-flickr"></i><span>3987</span> </a></li>*}
{*                </ul>*}
{*            </div>*}
{*            <!-- /.social icon -->*}
{*            <div class="tab-inner">*}
{*                <ul class="tabs">*}
{*                    <li><a href="#">POPULAR</a></li>*}
{*                    <li><a href="#">MOST VIEWED</a></li>*}
{*                </ul>*}
{*                <hr>*}
{*                <!-- tabs -->*}
{*                <div class="tab_content">*}
{*                    <div class="tab-item-inner">*}
{*                        <div class="box-item wow fadeIn" data-wow-duration="1s">*}
{*                            <div class="img-thumb">*}
{*                                <a href="#" rel="bookmark"><img class="entry-thumb" src="images/popular_news_01.jpg" alt="" height="80" width="90"></a>*}
{*                            </div>*}
{*                            <div class="item-details">*}
{*                                <h6 class="sub-category-title bg-color-1">*}
{*                                    <a href="#">SPORTS</a>*}
{*                                </h6>*}
{*                                <h3 class="td-module-title"><a href="#">It is a long established fact that a reader will</a></h3>*}
{*                                <div class="post-editor-date">*}
{*                                    <!-- post date -->*}
{*                                    <div class="post-date">*}
{*                                        <i class="pe-7s-clock"></i> Oct 6, 2016*}
{*                                    </div>*}
{*                                    <!-- post comment -->*}
{*                                    <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>*}
{*                                </div>*}
{*                            </div>*}
{*                        </div>*}
{*                        <div class="box-item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">*}
{*                            <div class="img-thumb">*}
{*                                <a href="#" rel="bookmark"><img class="entry-thumb" src="images/popular_news_02.jpg" alt="" height="80" width="90"></a>*}
{*                            </div>*}
{*                            <div class="item-details">*}
{*                                <h6 class="sub-category-title bg-color-2">*}
{*                                    <a href="#">TECHNOLOGY </a>*}
{*                                </h6>*}
{*                                <h3 class="td-module-title"><a href="#">The generated Lorem Ipsum is therefore</a></h3>*}
{*                                <div class="post-editor-date">*}
{*                                    <!-- post date -->*}
{*                                    <div class="post-date">*}
{*                                        <i class="pe-7s-clock"></i> Oct 6, 2016*}
{*                                    </div>*}
{*                                    <!-- post comment -->*}
{*                                    <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>*}
{*                                </div>*}
{*                            </div>*}
{*                        </div>*}
{*                        <div class="box-item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">*}
{*                            <div class="img-thumb">*}
{*                                <a href="#" rel="bookmark"><img class="entry-thumb" src="images/popular_news_03.jpg" alt="" height="80" width="90"></a>*}
{*                            </div>*}
{*                            <div class="item-details">*}
{*                                <h6 class="sub-category-title bg-color-3">*}
{*                                    <a href="#">HEALTH</a>*}
{*                                </h6>*}
{*                                <h3 class="td-module-title"><a href="#">The standard chunk of Lorem Ipsum used since</a></h3>*}
{*                                <div class="post-editor-date">*}
{*                                    <!-- post date -->*}
{*                                    <div class="post-date">*}
{*                                        <i class="pe-7s-clock"></i> Oct 6, 2016*}
{*                                    </div>*}
{*                                    <!-- post comment -->*}
{*                                    <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>*}
{*                                </div>*}
{*                            </div>*}
{*                        </div>*}
{*                        <div class="box-item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">*}
{*                            <div class="img-thumb">*}
{*                                <a href="#" rel="bookmark"><img class="entry-thumb" src="images/popular_news_04.jpg" alt="" height="80" width="90"></a>*}
{*                            </div>*}
{*                            <div class="item-details">*}
{*                                <h6 class="sub-category-title bg-color-4">*}
{*                                    <a href="#">FASHION</a>*}
{*                                </h6>*}
{*                                <h3 class="td-module-title"><a href="#">Lorem Ipum therefore always free from</a></h3>*}
{*                                <div class="post-editor-date">*}
{*                                    <!-- post date -->*}
{*                                    <div class="post-date">*}
{*                                        <i class="pe-7s-clock"></i> Oct 6, 2016*}
{*                                    </div>*}
{*                                    <!-- post comment -->*}
{*                                    <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>*}
{*                                </div>*}
{*                            </div>*}
{*                        </div>*}
{*                    </div>*}
{*                    <!-- / tab item -->*}
{*                    <div class="tab-item-inner">*}
{*                        <div class="box-item">*}
{*                            <div class="img-thumb">*}
{*                                <a href="#" rel="bookmark"><img class="entry-thumb" src="images/popular_news_01.jpg" alt="" height="80" width="90"></a>*}
{*                            </div>*}
{*                            <div class="item-details">*}
{*                                <h6 class="sub-category-title bg-color-5">*}
{*                                    <a href="#">BUSINESS</a>*}
{*                                </h6>*}
{*                                <h3 class="td-module-title"><a href="#">It is a long established fact that a reader will</a></h3>*}
{*                                <div class="post-editor-date">*}
{*                                    <!-- post date -->*}
{*                                    <div class="post-date">*}
{*                                        <i class="pe-7s-clock"></i> Oct 6, 2016*}
{*                                    </div>*}
{*                                    <!-- post comment -->*}
{*                                    <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>*}
{*                                </div>*}
{*                            </div>*}
{*                        </div>*}
{*                        <div class="box-item">*}
{*                            <div class="img-thumb">*}
{*                                <a href="#" rel="bookmark"><img class="entry-thumb" src="images/popular_news_02.jpg" alt="" height="80" width="90"></a>*}
{*                            </div>*}
{*                            <div class="item-details">*}
{*                                <h6 class="sub-category-title bg-color-2">*}
{*                                    <a href="#">TECHNOLOGY </a>*}
{*                                </h6>*}
{*                                <h3 class="td-module-title"><a href="#">The generated Lorem Ipsum is therefore</a></h3>*}
{*                                <div class="post-editor-date">*}
{*                                    <!-- post date -->*}
{*                                    <div class="post-date">*}
{*                                        <i class="pe-7s-clock"></i> Oct 6, 2016*}
{*                                    </div>*}
{*                                    <!-- post comment -->*}
{*                                    <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>*}
{*                                </div>*}
{*                            </div>*}
{*                        </div>*}
{*                        <div class="box-item">*}
{*                            <div class="img-thumb">*}
{*                                <a href="#" rel="bookmark"><img class="entry-thumb" src="images/popular_news_03.jpg" alt="" height="80" width="90"></a>*}
{*                            </div>*}
{*                            <div class="item-details">*}
{*                                <h6 class="sub-category-title bg-color-3">*}
{*                                    <a href="#">HEALTH</a>*}
{*                                </h6>*}
{*                                <h3 class="td-module-title"><a href="#">The standard chunk of Lorem Ipsum used since</a></h3>*}
{*                                <div class="post-editor-date">*}
{*                                    <!-- post date -->*}
{*                                    <div class="post-date">*}
{*                                        <i class="pe-7s-clock"></i> Oct 6, 2016*}
{*                                    </div>*}
{*                                    <!-- post comment -->*}
{*                                    <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>*}
{*                                </div>*}
{*                            </div>*}
{*                        </div>*}
{*                        <div class="box-item">*}
{*                            <div class="img-thumb">*}
{*                                <a href="#" rel="bookmark"><img class="entry-thumb" src="images/popular_news_04.jpg" alt="" height="80" width="90"></a>*}
{*                            </div>*}
{*                            <div class="item-details">*}
{*                                <h6 class="sub-category-title bg-color-4">*}
{*                                    <a href="#">FASHION</a>*}
{*                                </h6>*}
{*                                <h3 class="td-module-title"><a href="#">Lorem Ipum therefore always free from</a></h3>*}
{*                                <div class="post-editor-date">*}
{*                                    <!-- post date -->*}
{*                                    <div class="post-date">*}
{*                                        <i class="pe-7s-clock"></i> Oct 6, 2016*}
{*                                    </div>*}
{*                                    <!-- post comment -->*}
{*                                    <div class="post-author-comment"><i class="pe-7s-comment"></i> 13 </div>*}
{*                                </div>*}
{*                            </div>*}
{*                        </div>*}
{*                    </div>*}
{*                    <!-- / tab item -->*}
{*                </div>*}
{*                <!-- / tab_content -->*}
{*            </div>*}
{*            <!-- / tab -->*}
{*            <div class="banner-add">*}
{*                <!-- add -->*}
{*                <span class="add-title">- Advertisement -</span>*}
{*                <a href="#"><img src="images/ad-banner.jpg" class="img-responsive center-block" alt=""></a>*}
{*            </div>*}
{*        </aside>*}
    </div>
    <!-- pagination -->
    <div class="container">
        <div class="row">
{*            <div class="col-sm-12">*}
{*                <ul class="pagination">*}
{*                    <li>*}
{*                        <a href="#" class="prev">*}
{*                            <i class="pe-7s-angle-left"></i>*}
{*                        </a>*}
{*                    </li>*}
{*                    <li> <a href="#">1</a></li>*}
{*                    <li> <a href="#" class="active">2</a></li>*}
{*                    <li> <a href="#">3</a></li>*}
{*                    <li> <a href="#">4</a></li>*}
{*                    <li> ... </li>*}
{*                    <li> <a href="#">15</a></li>*}
{*                    <li>*}
{*                        <a href="#" class="next"> <i class="pe-7s-angle-right"></i></a>*}
{*                    </li>*}
{*                </ul>*}
{*            </div>*}
            <div class="col-sm-12">
                <div class="banner">
                    <img src="{base_url('templates/default/assets/images/top-bannner2.jpg')}" class="img-responsive center-block" alt="">
                </div>
            </div>
        </div>
    </div>
</div>