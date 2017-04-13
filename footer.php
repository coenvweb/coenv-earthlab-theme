                </section>
                <footer id="footer" role="contentinfo" class="site-footer">

                    <div id="footer-container" class="layout-container">
                        <div class="logo-headers row">
                            <div class="left-college medium-3 columns small-12">
                               <header class="site-footer__header">
                                    <h1><span><?php bloginfo('name') ?></span></h1>
                                    <?php get_search_form(); ?>
                                </header>
                            </div>
                            <div class="right-college medium-6 columns offset-medium-3 large-4 large-offset-5 small-12">
								<svg id="desktop-logo" width="108" height="73" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 108 73" enable-background="new 0 0 108 73" xml:space="preserve" role="img" aria-label="Wlogo">
								  <title>UW W Logo</title>
								  <path d="M79.343,0.112c0,0.858,0,12.238,0,13.098c0.856,0,9.206,0,9.206,0L78.271,51.461
									c0,0-12.577-50.636-12.756-51.349c-0.687,0-12.626,0-13.303,0c-0.188,0.696-13.796,51.352-13.796,51.352L28.95,13.21
									c0,0,8.726,0,9.585,0c0-0.859,0-12.239,0-13.098c-0.919,0-37.532,0-38.451,0c0,0.858,0,12.238,0,13.098c0.851,0,8.52,0,8.52,0
									s14.703,58.809,14.88,59.522c0.708,0,19.942,0,20.639,0c0.183-0.697,9.852-37.454,9.852-37.454s9.188,36.747,9.364,37.454
									c0.707,0,19.941,0,20.639,0C84.164,72.03,99.635,13.21,99.635,13.21s7.6,0,8.449,0c0-0.859,0-12.239,0-13.098
									C107.176,0.112,80.251,0.112,79.343,0.112z"></path>
								</svg>
                                <?php include('assets/images/college-of-the-environment.svg'); ?>
								<br>
                                <?php include('assets/images/university-of-washington-02.svg'); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="footer__info medium-3 columns small-12">
                                <?php if( have_rows('address', 'options') ): ?>
                                    <?php while( have_rows('address', 'options') ): the_row(); ?>
                                        <p><a href="<?php echo get_sub_field('maps_link'); ?>" title="Google Maps link"><?php echo get_sub_field('mail_address'); ?></a></p>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                                <p><a href="mailto:<?=antispambot(get_field('email', 'options'))?>" title="Send us an Email"><?php echo antispambot(get_field('email', 'options')) ?></a></p>
                                <p><a href="tel:<?=antispambot(get_field('phone_number', 'options'))?>" title="Call us"><?php echo antispambot(get_field('phone_number', 'options')) ?></a></p>
                            </div>

                            <nav class="footer-nav medium-2 columns offset-medium-7 small-12">
                                <ul class="links">
                                    <li><a href="/about/news-and-events/">News and Events</a></li>
                                    <li>
										<?php if (is_user_logged_in()) { ?>
											<a href="<?php echo wp_logout_url( home_url() ); ?>" title="Logout">Log out</a>
										<?php } else { ?>
											<a href="<?php echo wp_login_url(); ?>" title="Staff Login">Staff login</a>
										<?php } ?>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                </footer><!-- #footer -->

                    <div class="uw-footer">
                        <div class="layout-container row medium-collapse">
                            
                            <div class="be-boundless">
                                <a href="http://washington.edu/" rel="home" title="University of Washington" target="_blank"><?php include('assets/images/university-of-washington.svg'); ?><span class="hide">University of Washington</span></a><br />
                                <a href="http://www.washington.edu/boundless/" rel="home" title="University of Washington - Be Boundless" target="_blank"><img class="boundless-logo" src='<?= get_template_directory_uri() ?>/assets/images/boundless_logo.png' alt="University of Washington - Be Boundless for Washington for the World" /><span class="hide">Be Boundless - For Washington For the World</span></a>
                            </div>
                            
                            <div class="copyright columns medium-3 small-12"><p>&copy; <?php echo date('Y') ?> <a href="http://washington.edu/" target="_blank">University of Washington</a></p></div>
                            
                            <ul id="menu-footer-links" class="small-12 medium-3 columns medium-offset-6 menu-footer-links">
                                <li class="menu-item menu-item-type-custom menu-item-object-custom"><a target="_blank" href="http://www.washington.edu/admin/hr/jobs/" class="external" rel="nofollow">Jobs</a></li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom"><a target="_blank" href="http://myuw.washington.edu/" class="external" rel="nofollow">My UW</a></li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom"><a target="_blank" href="http://www.washington.edu/online/privacy/" class="external" rel="nofollow">Privacy</a></li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom"><a target="_blank" href="http://www.washington.edu/online/terms/" class="external" rel="nofollow">Terms</a></li>
                            </ul>
                        </div>
                    </div>
                    
            </div><!-- #wrapper -->

        </div><!-- #outer -->

        <!--[if lt IE 8]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
		<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
				</div><!-- Close off-canvas wrapper inner -->
			</div><!-- Close off-canvas wrapper -->
		</div><!-- Close off-canvas content wrapper -->
		<?php endif; ?>
        <?php wp_footer() ?>
    </body>
</html>
