                <footer id="footer" role="contentinfo" class="site-footer">

                    <div class="layout-container">
                        <div class="logo-headers row medium-collapse">

                            <div class="left-college medium-3 columns small-12">
                               <header class="site-footer__header">
                                    <h1><span><?php bloginfo('name') ?></span></h1>
                                </header>
                            </div>
                            <div class="right-college medium-2 columns offset-medium-7 small-12">
                                <?php get_search_form(); ?>
                            </div>
                        </div>
                        <div class="row medium-collapse">
                            <div class="footer__info medium-3 columns small-12">
                                <p><a href="http://maps.google.com/?q=1492+NE+Boat+St" title="Google Maps link">1492 NE Boat St., Seattle, WA 98105</a></p>
                                <p><a href="mailto:<?=antispambot("earthlab@uw.edu")?>" title="Send us an Email"><?php echo antispambot("earthlab@uw.edu") ?></a></p>
                            </div>

                            <nav class="footer-nav medium-2 columns offset-medium-7 small-12">
                                <ul class="links">
                                    <li><a href="">News and Events</a></li>
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
        
        <?php wp_footer() ?>
    </body>
</html>
