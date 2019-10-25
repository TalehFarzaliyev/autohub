<!-- Main sidebar -->
			<div class="sidebar sidebar-main sidebar-fixed">
				<div class="sidebar-content">
					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<!-- Main -->
								<li {if $controller eq 'dashboard'}class="active"{/if}><a href="{site_url_multi('admin/dashboard')}"><i class="icon-home4"></i> <span>{$text.common.common_sidebar_menu_dashboard}</span></a></li>
								
								<li {if $controller eq 'menu'}class="active"{/if}>
									<a href="#"><i class="icon-menu7"></i> <span>{$text.common.common_sidebar_menu_menu}</span></a>
									<ul>
										<li><a href="{site_url_multi('admin/menu')}">{$text.common.common_sidebar_menu_block} </a></li>
										<li><a href="{site_url_multi('admin/menu_items/')}">{$text.common.common_sidebar_menu_items} </a></li>
									</ul>
								</li>
								<li {if $controller eq 'page'}class="active"{/if}><a href="{site_url_multi('admin/page')}"><i class="icon-files-empty2"></i> <span>{$text.common.common_sidebar_menu_page}</span></a></li>
								<li {if $controller eq 'faq'}class="active"{/if}><a href="{site_url_multi('admin/faq')}"><i class="icon-files-empty2"></i> <span>{$text.common.common_sidebar_menu_faq}</span></a></li>
								<li {if $controller eq 'slider'}class="active"{/if}><a href="{site_url_multi('admin/slider')}"><i class="icon-files-empty2"></i> <span>{$text.common.common_sidebar_menu_slider}</span></a></li>
								<li {if $controller eq 'hotel'}class="active"{/if}>
									<a href="#"><i class="icon-menu7"></i> <span>{$text.common.common_sidebar_menu_hotel_managment}</span></a>
									<ul>
										<li><a href="{site_url_multi('admin/hotel')}">{$text.common.common_sidebar_menu_hotel} </a></li>
										<li><a href="{site_url_multi('admin/attribute')}">{$text.common.common_sidebar_menu_attribute} </a></li>
									</ul>
								</li>
								<li>
									<a href="#"><i class="icon-menu7"></i> <span>{$text.common.common_sidebar_menu_tour_managment}</span></a>
									<ul>
										<li {if $controller eq 'tour'}class="active"{/if}><a href="{site_url_multi('admin/tour')}">{$text.common.common_sidebar_menu_tours}</a></li>
										<li><a href="{site_url_multi('admin/tour_attribute')}">{$text.common.common_sidebar_menu_attribute} </a></li>
										<li {if $controller eq 'tour_category'}class="active"{/if}><a href="{site_url_multi('admin/tour_category')}">{$text.common.common_sidebar_menu_tour_category}</a></li>
										<li {if $controller eq 'country'}class="active"{/if}><a href="{site_url_multi('admin/country')}">{$text.common.common_sidebar_menu_tour_country}</a></li>										
									</ul>
								</li>
								<li>
									<a href="#"><i class="icon-menu7"></i> <span>{$text.common.common_sidebar_menu_booking_managment}</span></a>
									<ul>
										<li {if $controller eq 'booking'}class="active"{/if}><a href="{site_url_multi('admin/booking/tour_booking')}">{$text.common.common_sidebar_menu_tour_booking}</a></li>
										<!-- <li {if $controller eq 'booking'}class="active"{/if}><a href="{site_url_multi('admin/booking/hotel_booking')}">{$text.common.common_sidebar_menu_hotel_booking}</a></li> -->									
									</ul>
								</li>
								<li {if $controller eq 'service'}class="active"{/if}><a href="{site_url_multi('admin/service')}"><i class="icon-files-empty2"></i> <span>{$text.common.common_sidebar_menu_service}</span></a></li>
								<li {if $controller eq 'azerbaijan'}class="active"{/if}><a href="{site_url_multi('admin/azerbaijan')}"><i class="icon-files-empty2"></i> <span>{$text.common.common_sidebar_menu_azerbaijan}</span></a></li>

								<li>
									<a href="#"><i class="icon-magazine"></i> <span>{$text.common.common_sidebar_menu_news_management}</span></a>
									<ul>
										<li {if $controller eq 'news'}class="active"{/if}><a href="{site_url_multi('admin/news')}">{$text.common.common_sidebar_menu_news}</a></li>
										<li {if $controller eq 'category'}class="active"{/if}><a href="{site_url_multi('admin/category')}">{$text.common.common_sidebar_menu_category}</a></li>
									</ul>
								</li>
								<li {if $controller eq 'filemanager'}class="active"{/if}><a href="{site_url_multi('admin/filemanager')}"><i class="icon-box"></i> <span>{$text.common.common_sidebar_menu_filemanager}</span></a></li>							
								<li>
									<a href="#"><i class="icon-users"></i> <span>{$text.common.common_sidebar_menu_user_management}</span></a>
									<ul>
										<li {if $controller eq 'user'}class="active"{/if}><a href="{site_url_multi('admin/user')}">{$text.common.common_sidebar_menu_users}</a></li>
										<li {if $controller eq 'group'}class="active"{/if}><a href="{site_url_multi('admin/group')}">{$text.common.common_sidebar_menu_group}</a></li>
									</ul>
								</li>
								<li {if $controller eq 'setting'}class="active"{/if}><a href="{site_url_multi('admin/setting')}"><i class="icon-cog"></i> <span>{$text.common.common_sidebar_menu_setting}</span></a></li>

								<!-- /main -->

							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->
