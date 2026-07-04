<?php
/**
 * Generic page template (any WordPress Page other than the front page and
 * the "Thank You" template).
 *
 * @package BabySprings
 */

get_header();
?>

<div class="bs-page-shell bs-center">
	<style>
	.bs-page-shell { max-width: 48rem; margin: 0 auto; padding: 7rem 1.5rem 5rem; font-family: Arial, Helvetica, sans-serif; color: #2f2f2f; }
	.bs-page-shell h1 { font-family: 'Cormorant Garamond', serif; font-weight: 500; font-size: clamp(2rem, 4vw, 2.8rem); margin-bottom: 1rem; }
	.bs-page-shell .entry-content { text-align: left; }
	.bs-page-shell .entry-content > * + * { margin-top: 1.1rem; }
	</style>
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article <?php post_class(); ?>>
			<h1><?php the_title(); ?></h1>
			<div class="entry-content">
				<?php
				the_content();

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'babyspring' ),
						'after'  => '</div>',
					)
				);
				?>
			</div>
		</article>
		<?php
	endwhile;
	?>
</div>

<?php
get_footer();
