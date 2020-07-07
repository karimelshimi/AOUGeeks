<?php

add_filter( 'excerpt_length', 'studiare_short_excerpt_length', 999 );

$vars = $wp_query->query_vars;

$categories = get_the_category();

?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-inner">

        <?php if ( has_post_thumbnail() ) : ?>
            <div class="post-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php echo get_the_post_thumbnail( get_the_ID(), 'studiare-image-370x250-croped', array('class' => 'img-fluid') ); ?>
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
	        <div class="the-excerpt">
		        <?php the_excerpt(); ?>
            </div>
            <div class="post-meta date">
                <span>
                    <i class="material-icons">access_time</i>
                    <a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
                </span>
            </div>
            <div class="post-meta author">
                <i class="material-icons">perm_identity</i>
	            <?php esc_html_e('Posted by', 'studiare'); ?>
                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo get_the_author(); ?></a>
            </div>
        </div>
    </div>
</div>