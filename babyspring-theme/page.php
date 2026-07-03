<?php
/**
 * Generic page template (any WordPress Page other than the front page).
 *
 * @package BabySprings
 */

get_header();
?>

<main class="page-shell">
	<div class="wrap">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class(); ?>>
				<h1 class="sec-title center"><?php the_title(); ?></h1>
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
</main>

<?php
get_footer();
