<header class="c-layout-header c-layout-header-4 c-layout-header-default-mobile" data-minimize-offset="80">
	<div class="c-navbar">
		<div class="container">
			<!-- BEGIN: BRAND -->
			<div class="c-navbar-wrapper clearfix">
				<div class="c-brand c-pull-left">
					<a href="<?=$url;?>" class="c-logo">
						<img src="<?=img_webp("images/".getcomp('logo_web'));?>" style="height:50px;" alt="<?=getcomp('companyname');?>" class="c-desktop-logo">
						<img src="<?=img_webp("images/".getcomp('logo_web'));?>" style="height:50px;margin-top: -16px;" alt="<?=getcomp('companyname');?>" class="c-desktop-logo-inverse">
						<img src="<?=img_webp("images/".getcomp('logo_web'));?>" style="height: 45px;margin-top: -11px;" alt="<?=getcomp('companyname');?>" class="c-mobile-logo">
					</a>
					<button class="c-hor-nav-toggler" type="button" data-target=".c-mega-menu">
						<span class="c-line"></span>
						<span class="c-line"></span>
						<span class="c-line"></span>
					</button>
					<button class="c-topbar-toggler" type="button">
						<i class="fa fa-ellipsis-v"></i>
					</button>
					<button class="c-search-toggler" type="button">
						<i class="fa fa-search"></i>
					</button>
					<button class="c-cart-toggler" type="button">
						<i class="icon-handbag"></i> <span class="c-cart-number c-theme-bg">0</span>
					</button>
				</div>
				<!-- END: BRAND -->
				<!-- BEGIN: QUICK SEARCH -->
				<form class="c-quick-search" action="#">
					<input type="text" name="query" placeholder="Type to search..." value="" class="form-control" autocomplete="off">
					<span class="c-theme-link">&times;</span>
				</form>
				<!-- END: QUICK SEARCH -->
				<!-- BEGIN: HOR NAV -->
				<!-- BEGIN: LAYOUT/HEADERS/MEGA-MENU -->
				<!-- BEGIN: MEGA MENU -->
				<!-- Dropdown menu toggle on mobile: c-toggler class can be applied to the link arrow or link itself depending on toggle mode -->
				<nav class="c-mega-menu c-pull-right c-mega-menu-dark c-mega-menu-dark-mobile c-fonts-uppercase c-fonts-bold">
					<ul class="nav navbar-nav c-theme-nav">
						<li class="c-active">
							<a href="javascript:;" class="c-link"><?=$word->wordvar('Home');?></a>
						</li>
						<li class="c-menu-type-classic">
							<a href="javascript:;" class="c-link dropdown-toggle">Features<span class="c-arrow c-toggler"></span></a>


							<ul class="dropdown-menu c-menu-type-classic c-pull-left">
								<li class="dropdown-submenu">
									<a href="javascript:;">Headers<span class="c-arrow c-toggler"></span></a>
									<ul class="dropdown-menu c-pull-right">
										<li>
											<a href="home-header-1.html">Home Header v1</a>
										</li>
										<li>
											<a href="home-header-1-ext.html">Home Header v1 - Extended</a>
										</li>
										<li>
											<a href="home-header-2.html">Home Header v2</a>
										</li>
										<li>
											<a href="home-header-2-ext.html">Home Header v2 - Extended</a>
										</li>
										<li>
											<a href="home-header-3.html">Home Header v3</a>
										</li>
										<li>
											<a href="home-header-4.html">Home Header v4</a>
										</li>
										<li>
											<a href="home-header-4-ext.html">Home Header v4 - Extended</a>
										</li>
										<li>
											<a href="home-header-5.html">Home Header v5</a>
										</li>
										<li>
											<a href="home-header-5-ext.html">Home Header v5 - Extended</a>
										</li>
										<li>
											<a href="home-header-6.html">Home Header v6</a>
										</li>
										<li>
											<a href="home-header-6-ext.html">Home Header v6 - Extended</a>
										</li>
										<li>
											<a href="home-header-7.html">Home Header v7</a>
										</li>
										<li>
											<a href="home-header-8.html">Home Header v8</a>
										</li>
										<li>
											<a href="inner-header-1.html">Inner Header v1</a>
										</li>
										<li>
											<a href="inner-header-1-ext.html">Inner Header v1 - Extended</a>
										</li>
										<li>
											<a href="inner-header-2.html">Inner Header v2</a>
										</li>
										<li>
											<a href="inner-header-2-ext.html">Inner Header v2 - Extended</a>
										</li>
										<li>
											<a href="inner-header-3.html">Inner Header v3</a>
										</li>
										<li>
											<a href="inner-header-4.html">Inner Header v4</a>
										</li>
										<li>
											<a href="inner-header-5.html">Inner Header v5</a>
										</li>
									</ul>
								</li>
								<li class="dropdown-submenu">
									<a href="#">Sidebar Menu<span class="c-arrow c-toggler"></span></a>
									<ul class="dropdown-menu c-pull-right">
										<li>
											<a href="sidebar-menu-1.html">Sidebar Menu v1</a>
										</li>
										<li>
											<a href="sidebar-menu-2.html">Sidebar Menu v2</a>
										</li>
										<li>
											<a href="sidebar-menu-static.html">Expanded Static Sidebar Menu</a>
										</li>
										<li>
											<a href="sidebar-menu-right.html">Right Sidebar Menu</a>
										</li>
										<li>
											<a href="sidebar-menu-fluid.html">Sidebar Menu In Fluid Layout</a>
										</li>
									</ul>
								</li>
								<li class="dropdown-submenu">
									<a href="javascript:;">Footers<span class="c-arrow c-toggler"></span></a>
									<ul class="dropdown-menu c-pull-right">
										<li>
											<a href="footer-1.html#footer">Footer 1</a>
										</li>
										<li>
											<a href="footer-2.html#footer">Footer 2</a>
										</li>
										<li>
											<a href="footer-3.html#footer">Footer 3</a>
										</li>
										<li>
											<a href="footer-4.html#footer">Footer 4</a>
										</li>
										<li>
											<a href="footer-5.html#footer">Footer 5</a>
										</li>
										<li>
											<a href="footer-6.html#footer">Footer 6</a>
										</li>
										<li>
											<a href="footer-7.html#footer">Footer 7</a>
										</li>
										<li>
											<a href="footer-8.html#footer">Footer 8</a>
										</li>
										<li>
											<a href="footer-9.html#footer">Footer 9</a>
										</li>
									</ul>
								</li>
								<li class="dropdown-submenu">
									<a href="#">Breadcrumbs<span class="c-arrow c-toggler"></span></a>
									<ul class="dropdown-menu c-pull-right">
										<li>
											<a href="breadcrumbs-default.html">Breadcrumbs - Default</a>
										</li>
										<li>
											<a href="breadcrumbs-subtitle.html">Breadcrumbs - Sub Title</a>
										</li>
										<li>
											<a href="breadcrumbs-bgimage-1.html">Breadcrumbs - Bg Image V1</a>
										</li>
										<li>
											<a href="breadcrumbs-bgimage-2.html">Breadcrumbs - Bg Image V2</a>
										</li>
										<li>
											<a href="breadcrumbs-bgimage-3.html">Breadcrumbs - Bg Image V3</a>
										</li>
										<li>
											<a href="breadcrumbs-bgimage-4.html">Breadcrumbs - Bg Image V4</a>
										</li>
										<li>
											<a href="breadcrumbs-bgimage-5.html">Breadcrumbs - Bg Image V5</a>
										</li>
										<li>
											<a href="breadcrumbs-bgimage-6.html">Breadcrumbs - Bg Image V6</a>
										</li>
										<li>
											<a href="breadcrumbs-bgimage-7.html">Breadcrumbs - Bg Image V7</a>
										</li>
										<li>
											<a href="breadcrumbs-bgimage-8.html">Breadcrumbs - Bg Image V8</a>
										</li>
										<li>
											<a href="breadcrumbs-bgimage-9.html">Breadcrumbs - Bg Image V9</a>
										</li>
										<li>
											<a href="breadcrumbs-bgimage-10.html">Breadcrumbs - Bg Image V10</a>
										</li>
									</ul>
								</li>
								<li class="dropdown-submenu">
									<a href="javascript:;">Cookies Notification Bar<span class="c-arrow c-toggler"></span></a>
									<ul class="dropdown-menu c-pull-right">
										<li>
											<a href="component-cookies-1.html">Full Width - Top</a>
										</li>
										<li>
											<a href="component-cookies-2.html">Full Width - Bottom</a>
										</li>
										<li>
											<a href="component-cookies-3.html">Boxed - Dark Square</a>
										</li>
										<li>
											<a href="component-cookies-4.html">Boxed - Theme Color Rounded</a>
										</li>
										<li>
											<a href="component-cookies-5.html">Boxed - Aligned Top Left</a>
										</li>
										<li>
											<a href="component-cookies-6.html">Boxed - Aligned Top Right</a>
										</li>
										<li>
											<a href="component-cookies-7.html">Boxed - Aligned Bottom Left</a>
										</li>
										<li>
											<a href="component-cookies-8.html">Boxed - Aligned Bottom Right</a>
										</li>
									</ul>
								</li>
								<li>
									<a href="component-smooth-scroll.html">Smooth Scroll Links</a>
								</li>
								<li class="dropdown-submenu">
									<a href="#">Mega Menu<span class="c-arrow c-toggler"></span></a>
									<ul class="dropdown-menu c-pull-right">
										<li>
											<a href="megamenu-light.html">Mega Menu - Light</a>
										</li>
										<li>
											<a href="megamenu-dark.html">Mega Menu - Dark</a>
										</li>
									</ul>
								</li>
								<li class="dropdown-submenu">
									<a href="page-extended-portfolio.html">Multi Level Menu<span class="c-arrow c-toggler"></span></a>
									<ul class="dropdown-menu c-pull-right">
										<li>
											<a href="#">Example Link</a>
										</li>
										<li>
											<a href="#">Example Link</a>
										</li>
										<li>
											<a href="#">Example Link</a>
										</li>
										<li class="dropdown-submenu">
											<a href="#">Example Sub Menu<span class="c-arrow c-toggler"></span></a>
											<ul class="dropdown-menu c-pull-left">
												<li>
													<a href="#">Example Link</a>
												</li>
												<li>
													<a href="#">Example Link</a>
												</li>
												<li>
													<a href="#">Example Link</a>
												</li>
												<li class="dropdown-submenu">
													<a href="#">Example Sub Menu<span class="c-arrow c-toggler"></span></a>
													<ul class="dropdown-menu c-pull-left">
														<li>
															<a href="#">Example Link</a>
														</li>
														<li>
															<a href="#">Example Link</a>
														</li>
														<li>
															<a href="#">Example Link</a>
														</li>
														<li>
															<a href="#">Example Link</a>
														</li>
													</ul>
												</li>
												<li>
													<a href="#">Example Link</a>
												</li>
											</ul>
										</li>
										<li>
											<a href="#">Example Link</a>
										</li>
										<li>
											<a href="#">Example Link</a>
										</li>
									</ul>
								</li>
							</ul>

						</li>
						<li>
							<a href="javascript:;" class="c-link dropdown-toggle">Pages<span class="c-arrow c-toggler"></span></a>



							<ul class="dropdown-menu c-menu-type-mega c-menu-type-fullwidth" style="min-width: auto">
								<li>
									<ul class="dropdown-menu c-menu-type-inline">
										<li>
											<h3>Page Samples 1</h3>
										</li>
										<li>
											<a href="page-about-1.html">About Us 1</a>
										</li>
										<li>
											<a href="page-about-2.html">About Us 2</a>
										</li>
										<li>
											<a href="page-about-3.html">About Us 3</a>
										</li>
										<li>
											<a href="page-about-4.html">About Us 4</a>
										</li>
										<li>
											<a href="page-team.html">Meet The Team</a>
										</li>
									</ul>
								</li>
								<li>
									<ul class="dropdown-menu c-menu-type-inline">
										<li>
											<h3>Page Samples 2</h3>
										</li>
										<li>
											<a href="page-contact-1.html">Contact Us 1</a>
										</li>
										<li>
											<a href="page-contact-2.html">Contact Us 2</a>
										</li>
										<li>
											<a href="page-contact-3.html">Contact Us 3</a>
										</li>
										<li>
											<a href="page-faq.html">FAQ</a>
										</li>
										<li>
											<a href="page-faq-2.html">FAQ 2</a>
										</li>
									</ul>
								</li>
								<li>
									<ul class="dropdown-menu c-menu-type-inline">
										<li>
											<h3>Gallery Pages</h3>
										</li>
										<li>
											<a href="page-product-launch.html">Product Launch</a>
										</li>
										<li>
											<a href="page-lightbox-gallery.html">Lightbox Gallery</a>
										</li>
										<li>
											<a href="page-fullwidth-gallery.html">Full Width Gallery</a>
										</li>
										<li>
											<a href="page-masonry-gallery.html">Masonry Gallery</a>
										</li>
										<li>
											<a href="page-index-gallery.html">Gallery Index</a>
										</li>
									</ul>
								</li>
								<li>
									<ul class="dropdown-menu c-menu-type-inline">
										<li>
											<h3>Portfolio Pages</h3>
										</li>
										<li>
											<a href="page-4col-portfolio.html">4 Columns Portfolio</a>
										</li>
										<li>
											<a href="page-2col-portfolio.html">2 Columns Portfolio</a>
										</li>
										<li>
											<a href="page-masonry-portfolio.html">Masonry Portfolio</a>
										</li>
										<li>
											<a href="page-extended-portfolio.html">Extended Portfolio</a>
										</li>
									</ul>
								</li>
								<li>
									<ul class="dropdown-menu c-menu-type-inline">
										<li>
											<h3>Blog Pages</h3>
										</li>
										<li>
											<a href="page-blog-list.html">Blog List View</a>
										</li>
										<li>
											<a href="page-blog-grid.html">Blog Grid View</a>
										</li>
										<li>
											<a href="page-blog-post.html">Blog Single Post</a>
										</li>
									</ul>
								</li>
							</ul>

						</li>
						<li>
							<a href="javascript:;" class="c-link dropdown-toggle">Shop<span class="c-arrow c-toggler"></span></a>



							<ul class="dropdown-menu c-menu-type-mega c-menu-type-fullwidth" style="min-width: auto">
								<li>
									<ul class="dropdown-menu c-menu-type-inline">
										<li>
											<h3>Shop Pages 1</h3>
										</li>
										<li>
											<a href="shop-home-1.html" target="_blank">Shop Home 1</a>
										</li>
										<li>
											<a href="shop-home-2.html">Shop Home 2</a>
										</li>
										<li>
											<a href="shop-home-3.html">Shop Home 3</a>
										</li>
										<li>
											<a href="shop-home-4.html">Shop Home 4</a>
										</li>
										<li>
											<a href="shop-home-5.html">Shop Home 5</a>
										</li>
										<li>
											<a href="shop-home-6.html">Shop Home 6</a>
										</li>
										<li>
											<a href="shop-home-7.html">Shop Home 7</a>
										</li>
										<li>
											<a href="shop-home-8.html" target="_blank">Shop Home 8</a>
										</li>
									</ul>
								</li>
								<li>
									<ul class="dropdown-menu c-menu-type-inline">
										<li>
											<h3>Shop Pages 2</h3>
										</li>
										<li>
											<a href="shop-product-list.html">Product List</a>
										</li>
										<li>
											<a href="shop-product-grid.html">Product Grid</a>
										</li>
										<li>
											<a href="shop-product-search.html">Product Search</a>
										</li>
										<li>
											<a href="shop-product-details.html">Product Details 1</a>
										</li>
										<li>
											<a href="shop-product-details-2.html">Product Details 2</a>
										</li>
										<li>
											<a href="shop-product-details-3.html">Product Details 3</a>
										</li>
										<li>
											<a href="shop-product-details-4.html">Product Details 4</a>
										</li>
										<li>
											<a href="shop-product-comparison.html">Product Comparison</a>
										</li>
									</ul>
								</li>
								<li>
									<ul class="dropdown-menu c-menu-type-inline">
										<li>
											<h3>Shop Pages 3</h3>
										</li>
										<li>
											<a href="shop-product-wishlist.html">Wish List</a>
										</li>
										<li>
											<a href="shop-customer-account.html">Customer Login/Register</a>
										</li>
										<li>
											<a href="shop-customer-dashboard.html">Customer Dashboard</a>
										</li>
										<li>
											<a href="shop-order-history.html">Order History</a>
										</li>
										<li>
											<a href="shop-order-history-2.html">Order History 2</a>
										</li>
										<li>
											<a href="shop-cart.html">Shopping Cart</a>
										</li>
										<li>
											<a href="shop-cart-empty.html">Shopping Cart(empty)</a>
										</li>
										<li>
											<a href="shop-checkout.html">Checkout</a>
										</li>
									</ul>
								</li>
								<li>
									<ul class="dropdown-menu c-menu-type-inline">
										<li>
											<h3>Shop Pages 4</h3>
										</li>
										<li>
											<a href="shop-checkout-complete.html">Checkout Complete</a>
										</li>
										<li>
											<a href="component-shop-1.html">Shop Components 1</a>
										</li>
										<li>
											<a href="component-shop-2.html">Shop Components 2</a>
										</li>
										<li>
											<a href="component-shop-3.html">Shop Components 3</a>
										</li>
										<li>
											<a href="component-shop-4.html">Shop Components 4</a>
										</li>
										<li>
											<a href="component-shop-5.html">Shop Components 5</a>
										</li>
										<li>
											<a href="component-shop-6.html">Shop Components 6</a>
										</li>
										<li>
											<a href="component-shop-7.html">Shop Components 7</a>
										</li>
									</ul>
								</li>
							</ul>

						</li>
						<li>
							<a href="javascript:;" class="c-link dropdown-toggle">Components<span class="c-arrow c-toggler"></span></a>


							<!-- BEGIN: DESKTOP VERSION OF THE TAB MEGA MENU -->
							<div class="dropdown-menu c-menu-type-mega c-visible-desktop c-pull-right c-menu-type-fullwidth" style="min-width: auto">
								<ul class="nav nav-tabs c-theme-nav">
									<li class="active">
										<a href="#megamenu_jango_components" data-toggle="tab">Jango Components</a>
									</li>
									<li>
										<a href="#megamenu_base_components" data-toggle="tab">Base Components</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="megamenu_jango_components">
										<div class="row">
											<div class="col-md-3">
												<ul class="dropdown-menu c-menu-type-inline">
													<li>
														<a href="component-tabbed-contents.html">Tabbed Contents</a>
													</li>
													<li>
														<a href="component-parallax-1.html">Parallax Blocks 1</a>
													</li>
													<li>
														<a href="component-parallax-2.html">Parallax Blocks 2</a>
													</li>
													<li>
														<a href="component-parallax-3.html">Parallax Blocks 3</a>
													</li>
													<li>
														<a href="component-features.html">Feature Blocks</a>
													</li>
													<li>
														<a href="component-features-2.html">Feature Blocks 2</a>
													</li>
													<li>
														<a href="component-features-3.html">Feature Blocks 3</a>
													</li>
													<li>
														<a href="component-latest-works.html">Latest Works</a>
													</li>
												</ul>
											</div>
											<div class="col-md-3">
												<ul class="dropdown-menu c-menu-type-inline">
													<li>
														<a href="component-latest-items.html">Latest Items</a>
													</li>
													<li>
														<a href="component-tiles.html">Tiles</a>
													</li>
													<li>
														<a href="component-services.html">Services</a>
													</li>
													<li>
														<a href="component-blog-elements.html">Blog Elements</a>
													</li>
													<li>
														<a href="component-counters.html">Counters</a>
													</li>
													<li>
														<a href="component-bars.html">Engage Bars</a>
													</li>
													<li>
														<a href="component-isotope.html">Isotope Gallery</a>
													</li>
													<li>
														<a href="component-isotope-grid.html">Isotope Grid</a>
													</li>
												</ul>
											</div>
											<div class="col-md-3">
												<ul class="dropdown-menu c-menu-type-inline">
													<li>
														<a href="component-pricing-tables-1.html">Pricing Tables 1</a>
													</li>
													<li>
														<a href="component-pricing-tables-2.html">Pricing Tables 2</a>
													</li>
													<li>
														<a href="component-testimonials.html">Testimonials</a>
													</li>
													<li>
														<a href="component-testimonials-2.html">Testimonials 2</a>
													</li>
													<li>
														<a href="component-clients.html">Clients</a>
													</li>
													<li>
														<a href="component-abouts.html">About Blocks</a>
													</li>
													<li>
														<a href="component-dividers.html">Dividers</a>
													</li>
												</ul>
											</div>
											<div class="col-md-3">
												<ul class="dropdown-menu c-menu-type-inline">
													<li>
														<a href="component-steps.html">Steps</a>
													</li>
													<li>
														<a href="component-app-showcase.html">App Showcase</a>
													</li>
													<li>
														<a href="component-team.html">Team</a>
													</li>
													<li>
														<a href="component-headings.html">Headings</a>
													</li>
													<li>
														<a href="component-accordions.html">Accordion Contents</a>
													</li>
													<li>
														<a href="component-progress-bars-2.html">Animated Progress Bars</a>
													</li>
													<li>
														<a href="component-subscribe-form-1.html">Subscribe Form Bars</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="megamenu_base_components">
										<div class="row">
											<div class="col-md-3">
												<ul class="dropdown-menu c-menu-type-inline">
													<li>
														<a href="component-lists.html">Lists</a>
													</li>
													<li>
														<a href="component-blockquotes.html">Blockquotes</a>
													</li>
													<li>
														<a href="component-navs.html">Navigations</a>
													</li>
													<li>
														<a href="component-fontawesome-icons.html">Fontawesome Icons</a>
													</li>
													<li>
														<a href="component-simpleline-icons.html">Simple Line Icons</a>
													</li>
													<li>
														<a href="component-glyphicons-icons.html">Glyphicons Icons</a>
													</li>
												</ul>
											</div>
											<div class="col-md-3">
												<ul class="dropdown-menu c-menu-type-inline">
													<li>
														<a href="component-custom-icons.html">Custom Icons</a>
													</li>
													<li>
														<a href="component-business-custom-icons.html">Custom Business Icons</a>
													</li>
													<li>
														<a href="component-social-icons.html">Social Icons</a>
													</li>
													<li>
														<a href="component-media-embeds.html">Media Embeds</a>
													</li>
													<li>
														<a href="component-labels-badges.html">Labels & Badges</a>
													</li>
												</ul>
											</div>
											<div class="col-md-3">
												<ul class="dropdown-menu c-menu-type-inline">
													<li>
														<a href="component-colors.html">UI Colors</a>
													</li>
													<li>
														<a href="component-buttons.html">Buttons</a>
													</li>
													<li>
														<a href="component-form-controls.html">Form Controls</a>
													</li>
													<li>
														<a href="component-tables.html">Tables</a>
													</li>
													<li>
														<a href="component-modals.html">Modals</a>
													</li>
												</ul>
											</div>
											<div class="col-md-3">
												<ul class="dropdown-menu c-menu-type-inline">
													<li>
														<a href="component-tabs.html">Tabs</a>
													</li>
													<li>
														<a href="component-paginations.html">Paginations</a>
													</li>
													<li>
														<a href="component-panels.html">Panels</a>
													</li>
													<li>
														<a href="component-progress-bars.html">Progress Bars</a>
													</li>
													<li>
														<a href="component-alerts.html">Alerts</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- BEGIN: DESKTOP VERSION OF THE TAB MEGA MENU -->
							<!-- BEGIN: MOBILE VERSION OF THE TAB MEGA MENU -->
							<ul class="dropdown-menu c-menu-type-mega c-visible-mobile">
								<li class="dropdown-submenu">
									<a href="javascript:;">Jango Components<span class="c-arrow c-toggler"></span></a>
									<div class="dropdown-menu">
										<div class="row">
											<div class="col-md-3">
												<ul class="dropdown-menu c-menu-type-inline">
													<li>
														<a href="component-tabbed-contents.html">Tabbed Contents</a>
													</li>
													<li>
														<a href="component-parallax-1.html">Parallax Blocks 1</a>
													</li>
													<li>
														<a href="component-parallax-2.html">Parallax Blocks 2</a>
													</li>
													<li>
														<a href="component-parallax-3.html">Parallax Blocks 3</a>
													</li>
													<li>
														<a href="component-features.html">Feature Blocks</a>
													</li>
													<li>
														<a href="component-features-2.html">Feature Blocks 2</a>
													</li>
													<li>
														<a href="component-features-3.html">Feature Blocks 3</a>
													</li>
													<li>
														<a href="component-latest-works.html">Latest Works</a>
													</li>
												</ul>
											</div>
											<div class="col-md-3">
												<ul class="dropdown-menu c-menu-type-inline">
													<li>
														<a href="component-latest-items.html">Latest Items</a>
													</li>
													<li>
														<a href="component-tiles.html">Tiles</a>
													</li>
													<li>
														<a href="component-services.html">Services</a>
													</li>
													<li>
														<a href="component-blog-elements.html">Blog Elements</a>
													</li>
													<li>
														<a href="component-counters.html">Counters</a>
													</li>
													<li>
														<a href="component-bars.html">Engage Bars</a>
													</li>
													<li>
														<a href="component-isotope.html">Isotope Gallery</a>
													</li>
													<li>
														<a href="component-isotope-grid.html">Isotope Grid</a>
													</li>
												</ul>
											</div>
											<div class="col-md-3">
												<ul class="dropdown-menu c-menu-type-inline">
													<li>
														<a href="component-pricing-tables-1.html">Pricing Tables 1</a>
													</li>
													<li>
														<a href="component-pricing-tables-2.html">Pricing Tables 2</a>
													</li>
													<li>
														<a href="component-testimonials.html">Testimonials</a>
													</li>
													<li>
														<a href="component-testimonials-2.html">Testimonials 2</a>
													</li>
													<li>
														<a href="component-clients.html">Clients</a>
													</li>
													<li>
														<a href="component-abouts.html">About Blocks</a>
													</li>
													<li>
														<a href="component-dividers.html">Dividers</a>
													</li>
												</ul>
											</div>
											<div class="col-md-3">
												<ul class="dropdown-menu c-menu-type-inline">
													<li>
														<a href="component-steps.html">Steps</a>
													</li>
													<li>
														<a href="component-app-showcase.html">App Showcase</a>
													</li>
													<li>
														<a href="component-team.html">Team</a>
													</li>
													<li>
														<a href="component-headings.html">Headings</a>
													</li>
													<li>
														<a href="component-accordions.html">Accordion Contents</a>
													</li>
													<li>
														<a href="component-progress-bars-2.html">Animated Progress Bars</a>
													</li>
													<li>
														<a href="component-subscribe-form-1.html">Subscribe Form Bars</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</li>
								<li class="dropdown-submenu">
									<a href="javascript:;">Base Components<span class="c-arrow c-toggler"></span></a>
									<div class="dropdown-menu">
										<div class="row">
											<div class="col-md-3">
												<ul class="dropdown-menu c-menu-type-inline">
													<li>
														<a href="component-lists.html">Lists</a>
													</li>
													<li>
														<a href="component-blockquotes.html">Blockquotes</a>
													</li>
													<li>
														<a href="component-navs.html">Navigations</a>
													</li>
													<li>
														<a href="component-fontawesome-icons.html">Fontawesome Icons</a>
													</li>
													<li>
														<a href="component-simpleline-icons.html">Simple Line Icons</a>
													</li>
													<li>
														<a href="component-glyphicons-icons.html">Glyphicons Icons</a>
													</li>
												</ul>
											</div>
											<div class="col-md-3">
												<ul class="dropdown-menu c-menu-type-inline">
													<li>
														<a href="component-custom-icons.html">Custom Icons</a>
													</li>
													<li>
														<a href="component-business-custom-icons.html">Custom Business Icons</a>
													</li>
													<li>
														<a href="component-social-icons.html">Social Icons</a>
													</li>
													<li>
														<a href="component-media-embeds.html">Media Embeds</a>
													</li>
													<li>
														<a href="component-labels-badges.html">Labels & Badges</a>
													</li>
												</ul>
											</div>
											<div class="col-md-3">
												<ul class="dropdown-menu c-menu-type-inline">
													<li>
														<a href="component-colors.html">UI Colors</a>
													</li>
													<li>
														<a href="component-buttons.html">Buttons</a>
													</li>
													<li>
														<a href="component-form-controls.html">Form Controls</a>
													</li>
													<li>
														<a href="component-tables.html">Tables</a>
													</li>
													<li>
														<a href="component-modals.html">Modals</a>
													</li>
												</ul>
											</div>
											<div class="col-md-3">
												<ul class="dropdown-menu c-menu-type-inline">
													<li>
														<a href="component-tabs.html">Tabs</a>
													</li>
													<li>
														<a href="component-paginations.html">Paginations</a>
													</li>
													<li>
														<a href="component-panels.html">Panels</a>
													</li>
													<li>
														<a href="component-progress-bars.html">Progress Bars</a>
													</li>
													<li>
														<a href="component-alerts.html">Alerts</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</li>
							</ul>
							<!-- END: MOBILE VERSION OF THE TAB MEGA MENU -->
						</li>
						<li class="c-search-toggler-wrapper">
							<a href="#" class="c-btn-icon c-search-toggler"><i class="fa fa-search"></i></a>
						</li>
						<li <?php if($_SESSION['lg']=="TH"){ echo "class='c-active hidden-xs hidden-sm'";}else{echo "class='hidden-xs hidden-sm'";}?>>
              <a href="<?=$url;?>/lg.php?lg=TH&uri=<?=$uri;?>" class="c-link" style="padding-left:0px;padding-right:0px;">
								<span style="padding: 5px;<?php echo ($_SESSION['lg']=="TH"?'color:#fff;background-color: #41515B;':'background-color: #677083;');?>">TH</span></a>
            </li>
            <li <?php if($_SESSION['lg']=="EN"){ echo "class='c-active hidden-xs hidden-sm'";}else{echo "class='hidden-xs hidden-sm'";}?>>
              <a href="<?=$url;?>/lg.php?lg=EN&uri=<?=$uri;?>" class="c-link" style="padding-left:0px;padding-right:0px;">
								<span style="padding: 5px;<?php echo ($_SESSION['lg']=="EN"?'color:#fff;background-color: #41515B;':'background-color: #677083;');?>">EN</span></a>
            </li>
					</ul>
					<div class="c-onepage-link visible-sm visible-xs" style="height:50px;padding-top: 25px;">
						<a href="<?=$url;?>/lg.php?lg=TH&uri=<?=$uri;?>" class=""><span class="<?php echo ($_SESSION['lg']=='TH'?'lang-active':'lang-normal');?>">TH</span></a>
						<a href="<?=$url;?>/lg.php?lg=EN&uri=<?=$uri;?>" class=""><span class="<?php echo ($_SESSION['lg']=='EN'?'lang-active':'lang-normal');?>">EN</span></a>
					</div>
				</nav>
			</div>
		</div>
	</div>
</header>