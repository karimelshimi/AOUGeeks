<?php
/**
 * The template for displaying inner content on single posts
 */

$separate_meta = esc_html__( ', ', 'studiare' );

// Get Categories for posts.
$categories_list = get_the_category_list( $separate_meta );

// Get Tags for posts.
$tags_list = get_the_tag_list( '' );

$blog_post_share = false;
$article_author = true;

if ( class_exists('Redux') ) {
	$blog_post_share = codebean_option('blog_share_story');
	$article_author = codebean_option('article_author');
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
	<?php while ( have_posts() ) : the_post(); ?>

		<div class="post-inner">

			<header class="entry-header">
				<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
				<div class="post-meta date"><i class="material-icons">access_time</i><?php echo get_the_date(); ?></div>
				<div class="post-meta author">
                    <i class="material-icons">perm_identity</i>
					<?php esc_html_e('Posted by', 'studiare'); ?>
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo get_the_author(); ?></a>
				</div>
				<div class="post-meta category">
                    <i class="material-icons">folder_open</i>
					<?php echo wp_kses_post( $categories_list ); ?>
				</div>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="post-thumbnail">
					<?php echo the_post_thumbnail( 'full' ); ?>
				</div>
			<?php endif; ?>

			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages(array(
					'before' => '<div class="page-pagination"><div class="page-links-title">' . esc_html__('Pages:', 'studiare') . '</div>',
					'after' => '</div>',
					'link_before' => '<span>', 'link_after' => '</span>'
				)); ?>
			</div>

			<div class="entry-tag-share">
				<?php if ( $tags_list && ! is_wp_error( $tags_list ) ) : ?>
					<div class="post-tags">
						<span><?php esc_html_e( 'Tags:', 'studiare' ); ?></span>
						<?php echo wp_kses_post( $tags_list ); ?>
					</div>
				<?php endif; ?>
			</div>

			<?php if ( $article_author == '1' && get_the_author_meta( 'description') !== '' ) : ?>
                <div class="post-author-box">
					<?php
					$author_bio_avatar_size = apply_filters( 'goseowp_author_bio_avatar_size', 130 );

					echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
					?>
                    <div class="author-content">
                        <h5 class="author-title"><?php printf( esc_html__( 'About %s', 'studiare' ), get_the_author() ); ?></h5>
                        <p class="author-bio">
							<?php the_author_meta( 'description' ); ?>
                        </p>
                        <a class="author-link btn btn-border btn-small" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
							<?php printf( esc_html__( 'More Posts by %s', 'studiare' ), get_the_author() ); ?>
                        </a>
                    </div>
                </div>
            <?php endif; ?>

		</div>

	<?php endwhile; ?>
</article>
