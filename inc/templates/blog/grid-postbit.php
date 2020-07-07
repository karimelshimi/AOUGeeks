<?php

$blog_grid_columns = 'two';

if ( class_exists('Redux') ) {
	$blog_grid_columns = codebean_option('blog_grid_columns');
}

$categories = get_the_category();

?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-inner">

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail('studiare-image-420x294-croped'); ?>
				</a>
			</div>
		<?php endif; ?>

		<div class="post-content">
			<div class="post-meta post-category">
				<?php if ( ! empty( $categories ) ) {
					echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
				} ?>
			</div>
			<h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <?php if ( $blog_grid_columns == 'one' ) : ?>
	            <?php the_excerpt(); ?>
            <?php endif; ?>
			<div class="post-meta date">
                <i class="material-icons">access_time</i>
				<?php echo get_the_date(); ?>
			</div>
			<?php if ( $blog_grid_columns == 'one' ) : ?>
                <div class="post-meta author">
                    <i class="material-icons">perm_identity</i>
					<?php esc_html_e('Posted by', 'studiare'); ?>
                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo get_the_author(); ?></a>
                </div>
			<?php endif; ?>
		</div>
	</div>
</div>
