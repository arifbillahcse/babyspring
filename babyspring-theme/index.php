<?php
/**
 * Fallback template.
 *
 * WordPress uses front-page.php for the homepage. This file is the required
 * fallback for any other query (archives, search, blog index) so the theme
 * always renders inside the site's shared header/footer.
 *
 * @package BabySprings
 */

get_header();
?>

<div class="bs-page-shell">
	<style>
	.bs-page-shell { max-width: 48rem; margin: 0 auto; padding: 7rem 1.5rem 5rem; font-family: Arial, Helvetica, sans-serif; color: #2f2f2f; }
	.bs-page-shell h1 { font-family: 'Cormorant Garamond', serif; font-weight: 500; font-size: clamp(2rem, 4vw, 2.8rem); margin-bottom: 1rem; }
	.bs-page-shell article + article { margin-top: 3rem; padding-top: 3rem; border-top: 1px solid #e2dacb; }
	.bs-page-shell .entry-content > * + * { margin-top: 1.1rem; }
	.bs-page-shell.bs-center { text-align: center; }
	</style>
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class(); ?>>
				<h1><?php the_title(); ?></h1>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</article>
		<?php endwhile; ?>

		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<h1><?php esc_html_e( 'Nothing found', 'babyspring' ); ?></h1>
		<p><?php esc_html_e( 'Sorry, no content matched your request.', 'babyspring' ); ?></p>
	<?php endif; ?>
</div>

<?php
get_footer();
