                </section>
                <footer id="footer" role="contentinfo" class="site-footer">

                    <div id="footer-container" class="layout-container">
                        <div class="logo-headers row">
                            <div class="left-college medium-3 columns small-12">
                               <header class="site-footer__header">
                                    <h1><span><?php bloginfo('name') ?></span></h1>
                                    <?php get_search_form(); ?>
                                </header>
                                <?php if( have_rows('address', 'options') ): ?>
                                    <?php while( have_rows('address', 'options') ): the_row(); ?>
                                        <p><a href="<?php echo get_sub_field('maps_link'); ?>" title="Google Maps link"><?php echo get_sub_field('mail_address'); ?></a></p>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                                <p><a href="mailto:<?=antispambot(get_field('email', 'options'))?>" title="Send us an Email"><?php echo antispambot(get_field('email', 'options')) ?></a></p>
                                <p><a href="tel:<?=antispambot(get_field('phone_number', 'options'))?>" title="Call us"><?php echo antispambot(get_field('phone_number', 'options')) ?></a></p>
                                <div class="social-icon-box right"><a class="social-icon" href="https://www.facebook.com/UWEarthLab/"><i class="fa fa-facebook"></i></a> <a class="social-icon" href="https://twitter.com/uwearthlab"><i class="fa fa-twitter"></i></a><a class="social-icon" href="https://www.linkedin.com/company/uwearthlab"><i class="fa fa-linkedin"></i></a></div>
                                <?php if (is_user_logged_in()) { ?>
                                  <a href="<?php echo wp_logout_url( home_url() ); ?>" title="Logout">Log out</a>
                                <?php } else { ?>
                                  <a href="<?php echo wp_login_url(); ?>" title="Staff Login">Staff login</a>
                                <?php } ?>
                            </div>
                            <div class="right-college medium-6 columns offset-medium-3 large-4 large-offset-5 small-12">
                                <a href="https://earthlab.uw.edu/">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 195.89 30.37"><defs><style>.cls-1,.cls-2{fill:#fff;}.cls-2{stroke:#fff;stroke-width:0.5px;}</style></defs><title>earthlab-uw</title><g id="Division"><path class="cls-1" d="M36.4,32.82" transform="translate(-1.76 -5.89)"/><path class="cls-1" d="M193,33.25V27.91l3.71,6H197V27.35l.61-.61h-1.86l.62.61v4.53l-3.22-5.14h-1.47l.6.61v5.9l-.6.62h1.86Zm-5.5.23c-1.43,0-1.93-1.7-1.93-3.18s.5-3.18,1.93-3.18,1.93,1.71,1.93,3.18-.5,3.18-1.93,3.18m-2.86-3.18c0,1.81,1,3.72,2.86,3.72s2.86-1.91,2.86-3.72-1-3.72-2.86-3.72-2.86,1.91-2.86,3.72m-3.22,3v-6h1.35l.76.76V26.74h-5V28l.77-.76h1.34v6l-.55.57h1.91Zm-5.28-2.67v2.29a1.54,1.54,0,0,1-1.17.51c-1.58,0-2.38-1.6-2.38-3.13s1-3.13,2.38-3.13a1.1,1.1,0,0,1,.87.34l.79.77V27.05a3.2,3.2,0,0,0-1.66-.41,3.49,3.49,0,0,0-3.31,3.66A3.51,3.51,0,0,0,174.92,34a3.09,3.09,0,0,0,2-.52V30.63l.55-.57h-1.91Zm-10.57,2.62V27.91l3.75,6h.32V27.35l.62-.61h-1.86l.62.61v4.53l-3.22-5.14h-1.47l.6.61v5.9l-.6.62h1.86Zm-5.11-6.51.57.56v6l-.57.57h1.92l-.57-.57v-6l.57-.56Zm-6.33,3.55h3v3l-.57.57h1.92l-.57-.57v-6l.57-.56h-1.92l.57.56v2.46h-3V27.3l.57-.56h-1.91l.55.56v6l-.55.57h1.91l-.57-.57Zm-3.21,1.59a1.57,1.57,0,0,0-.67-1.36l-1.45-1.05a1.7,1.7,0,0,1-.79-1.22,1,1,0,0,1,1-1,3.72,3.72,0,0,1,.46.09l.63.67.66-1-1.41-.26a1,1,0,0,0-.34,0,1.79,1.79,0,0,0-1.81,1.75,2.05,2.05,0,0,0,.92,1.63l1.46,1.05a1.21,1.21,0,0,1,.51,1,1.18,1.18,0,0,1-1.19,1.26,1,1,0,0,1-.49-.1l-.68-.79-.61,1.11,1.36.26a2.36,2.36,0,0,0,.42.05,2,2,0,0,0,2-2.08m-8-3.56,1,2.95h-2Zm-1.72,5,.52-1.51h2.36l.49,1.51-.55.56h2l-.57-.58-2.22-6.55h-.37l-2.26,6.55-.58.58h1.72Zm-7.58.56,1.63-5.16,1.59,5.16h.36l2.07-6.57.58-.56H138.1l.56.55-1.51,4.93-1.47-4.93.56-.55h-2l.57.56.14.48-1.36,4.44-1.46-4.93.55-.55h-2l.57.56,2,6.57ZM123,29.59l-.27.26,0,.1h.83c-.13.91-.25,1.69-.44,3-.27,1.87-.5,2.53-.69,2.7a.37.37,0,0,1-.25.09,1.33,1.33,0,0,1-.45-.15.22.22,0,0,0-.28.07.61.61,0,0,0-.17.34c0,.2.26.3.43.3a1.68,1.68,0,0,0,1.11-.7,8.41,8.41,0,0,0,1.19-3.66c.07-.42.15-.84.32-1.95l1-.1.22-.26h-1.19c.3-1.85.56-2.42,1-2.42a1.08,1.08,0,0,1,.77.33.2.2,0,0,0,.28,0,.59.59,0,0,0,.2-.37c0-.2-.26-.42-.6-.42a2.26,2.26,0,0,0-1.62.84,4.61,4.61,0,0,0-.79,2.05Zm-4.52,2.63a2.7,2.7,0,0,1,1.07-2.42.94.94,0,0,1,.33-.08c.5,0,.79.38.79,1.16a3.15,3.15,0,0,1-1.09,2.63,1,1,0,0,1-.31.07c-.56,0-.79-.6-.79-1.36m1.72-2.87a2.45,2.45,0,0,0-1.09.36,3.15,3.15,0,0,0-1.44,2.75c0,.71.33,1.49,1.26,1.49a2.59,2.59,0,0,0,1.5-.67,3.62,3.62,0,0,0,1.05-2.53,1.23,1.23,0,0,0-1.28-1.4M108.6,27.3l1.8,3.25V33.3l-.57.57h1.92l-.57-.57V30.55L113,27.32l.59-.58h-1.76l.55.55L110.9,30l-1.42-2.67.55-.55h-2Zm-3.76,6v-6h1.35L107,28V26.74h-5V28l.77-.76h1.34v6l-.55.57h1.91Zm-6.47-6.56.57.56v6l-.57.57h1.92l-.56-.57v-6l.56-.56Zm-2.06,5.14a1.57,1.57,0,0,0-.67-1.36l-1.45-1.05a1.68,1.68,0,0,1-.78-1.22,1,1,0,0,1,1-1,3.72,3.72,0,0,1,.46.09l.63.67.67-1-1.42-.26a.91.91,0,0,0-.34,0,1.79,1.79,0,0,0-1.81,1.75,2.05,2.05,0,0,0,.92,1.63L95,31.13a1.21,1.21,0,0,1,.51,1,1.18,1.18,0,0,1-1.18,1.26,1.06,1.06,0,0,1-.5-.1l-.68-.79-.61,1.11,1.36.26a2.39,2.39,0,0,0,.43.05,2,2,0,0,0,2-2.08m-9.16-4.61H88a1.39,1.39,0,0,1,1.36,1.42A1.33,1.33,0,0,1,88,30h-.87Zm0,6V30.54h1.07L90,33.87h1.19l-.56-.57L89,30.37a1.88,1.88,0,0,0,1.34-1.66,2.14,2.14,0,0,0-2.31-2H85.81l.55.56v6l-.55.57h1.91Zm-3.2.57V32.56l-.76.77H81v-3h1.61l.57.56V29.24l-.57.57H81V27.27h2.17L84,28V26.74H79.68l.56.56v6l-.56.57ZM74.7,26.74h-2l.58.56,2,6.57h.36L77.7,27.3l.58-.56H76.56l.56.55-1.51,4.93-1.46-4.93Zm-5.53,0,.57.56v6l-.57.57h1.92l-.57-.57v-6l.57-.56Zm-6.63,6.51V27.91l3.82,6h.25V27.35l.61-.61H65.36l.62.61v4.53l-3.21-5.14H61.29l.6.61v5.9l-.6.62h1.86Zm-8-1.29A2.12,2.12,0,0,0,56.72,34,2.22,2.22,0,0,0,59,32V27.35l.61-.61H57.78l.61.61V32a1.46,1.46,0,0,1-1.47,1.47A1.53,1.53,0,0,1,55.35,32V27.35l.61-.61H53.9l.61.61Z" transform="translate(-1.76 -5.89)"/><text x="-1.76" y="-5.89"></text><line class="cls-2" x1="51.88" y1="15.02" x2="195.63" y2="15.02"/><path class="cls-1" d="M32.21,5.94v5h3.54L31.8,25.67S27,6.21,26.9,5.94H21.79c-.08.26-5.3,19.73-5.3,19.73L12.85,11h3.68v-5H1.76v5H5l5.72,22.87h7.93l3.78-14.39,3.6,14.39H34L40,11h3.25v-5Z" transform="translate(-1.76 -5.89)"/><path class="cls-1" d="M54.37,15.5l.83-.83V6.72l-.83-.83h6V7.78L59.3,6.68H56.66V10h1.89l.83-.82v2.44l-.83-.83H56.66v4H59.3l1.09-1.1V15.5Z" transform="translate(-1.76 -5.89)"/><path class="cls-1" d="M66.63,15.5l.82-.82-.61-1.89H63.68L63,14.68l.81.82H61.27l.85-.84,3.05-8.77h.89l3,8.77.84.84ZM65.29,8.09,64,12h2.62Z" transform="translate(-1.76 -5.89)"/><path class="cls-1" d="M76.77,15.5l-2.3-4.41H73.2v3.58l.83.83H70.91l.82-.83V6.72l-.82-.83h3.45c1.63,0,3.32.84,3.32,2.64a2.48,2.48,0,0,1-1.8,2.27L78,14.67l.83.83ZM74.36,6.68H73.2V10.3h1.16A1.65,1.65,0,0,0,76,8.53,1.69,1.69,0,0,0,74.36,6.68Z" transform="translate(-1.76 -5.89)"/><path class="cls-1" d="M85.38,6.68H83.76v8l.83.83H81.47l.83-.83v-8H80.68l-1.09,1.1V5.89h6.89V7.78Z" transform="translate(-1.76 -5.89)"/><path class="cls-1" d="M93,15.5l.83-.83V10.75H90.19v3.92l.83.83H87.9l.83-.83V6.72l-.83-.83H91l-.83.83V10h3.63V6.72L93,5.89h3.12l-.83.83v8l.83.83Z" transform="translate(-1.76 -5.89)"/><path class="cls-1" d="M97.73,15.5l.83-.83V6.72l-.83-.83h3.12l-.82.83v8h2.29l1.1-1.1V15.5Z" transform="translate(-1.76 -5.89)"/><path class="cls-1" d="M109.4,15.5l.81-.82-.61-1.89h-3.16l-.64,1.89.82.82H104l.84-.84,3.05-8.77h.9l3,8.77.85.84Zm-1.34-7.41L106.71,12h2.62Z" transform="translate(-1.76 -5.89)"/><path class="cls-1" d="M117.27,15.5h-3.6l.83-.83V6.72l-.83-.83h3.26c1.87,0,3.17.93,3.17,2.36a2.47,2.47,0,0,1-1.68,2.28,2.77,2.77,0,0,1,2.16,2.4C120.58,14.89,118.85,15.5,117.27,15.5Zm-.34-8.82h-1V10.3h1a1.6,1.6,0,0,0,1.64-1.77A1.62,1.62,0,0,0,116.93,6.68Zm.34,4.41H116v3.62h1.31A1.66,1.66,0,0,0,119,13,1.72,1.72,0,0,0,117.27,11.09Z" transform="translate(-1.76 -5.89)"/></g></svg>
                                </a>
                                <p class="member-org-title">Member Organizations</p>
                                <ul class="links">
                                    <li><a href="https://cig.uw.edu/">Climate Impacts Group</a></li>
                                    <li><a href="http://uwconservationscholars.org/">Doris Duke Conservation Scholars</a></li>
                                    <li><a href="https://earthlab.uw.edu/members-and-affiliates/future-rivers">Future Rivers</a></li>   
                                    <li><a href="https://natureandhealth.uw.edu/">Nature and Health</a></li>
                                    <li><a href="https://nwcasc.uw.edu/">Northwest Climate Adaptation Science Center</a></li>
                                    <li><a href="https://earthlab.uw.edu/members-and-affiliates/ocean-nexus/">Ocean Nexus Center</a></li>   
                                    <li><a href="https://environment.uw.edu/oacenter/">Washington Ocean Acidification Center</a></li>         
                                </ul>
                            </div>
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
