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
								<li {if $controller eq 'faq'}class="active"{/if}><a href="{site_url_multi('admin/faq')}"><i class="icon-eject"></i> <span>{$text.common.common_sidebar_menu_faq}</span></a></li>
								<li {if $controller eq 'slider'}class="active"{/if}><a href="{site_url_multi('admin/slider')}"><i class="icon-terminal"></i> <span>{$text.common.common_sidebar_menu_slider}</span></a></li>

								<li>
									<a href="#"><i class="icon-magazine"></i> <span>{$text.common.common_sidebar_menu_news_management}</span></a>
									<ul>
										<li {if $controller eq 'news'}class="active"{/if}><a href="{site_url_multi('admin/news')}"><i class="icon-blog"></i>{$text.common.common_sidebar_menu_news}</a></li>
										<li {if $controller eq 'category'}class="active"{/if}><a href="{site_url_multi('admin/category')}"><i class="icon-pencil"></i>{$text.common.common_sidebar_menu_category}</a></li>
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
{*								<li {if $controller eq 'language'}class="active"{/if}><a href="{site_url_multi('admin/language')}"><i class="icon-chrome"></i> <span>{$text.common.common_sidebar_menu_language}</span></a></li>*}

								<!-- /main -->

							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->
