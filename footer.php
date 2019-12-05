<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Beetroot
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
        <p><?php the_field('copyright', 'option'); ?></p>
	</footer><!-- #colophon -->
</div><!-- #page -->

<script>
    jQuery(document).ready(function($) {
        $(window).bind("scroll", function() {
            if ($(this).scrollTop() > 320) {
                $(".agenda-one-info").addClass('show')
            } else {
                $(".agenda-one-info").removeClass('show')
            }
        });
    });
</script>
<?php wp_footer(); ?>

</body>
</html>
