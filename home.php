<?php
get_header(); ?>

<div id="page" role="main">
	<article class="main-content">
        <?php dynamic_sidebar( 'homepage-widgets' ); ?>
	</article>
	<?php get_sidebar(); ?>

</div>

<?php get_footer();
