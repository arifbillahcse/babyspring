<?php
/**
 * Fallback template.
 *
 * WordPress uses front-page.php for the homepage. This file is the required
 * fallback for any other query (archives, search, blog index) so the theme
 * always renders inside the site's header/footer.
 *
 * @package BabySprings
 */

get_header();
?>

<main class="page-shell">
	<div class="wrap">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class(); ?>>
					<h1 class="sec-title"><?php the_title(); ?></h1>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
				</article>
			<?php endwhile; ?>

			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<h1 class="sec-title center"><?php esc_html_e( 'Nothing found', 'babyspring' ); ?></h1>
			<p class="center"><?php esc_html_e( 'Sorry, no content matched your request.', 'babyspring' ); ?></p>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
