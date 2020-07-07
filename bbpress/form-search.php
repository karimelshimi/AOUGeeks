<?php
/**
 * Search
 *
 * @package bbPress
 * @subpackage Theme
 */
?>

<form role="search" method="get" id="bbp-search-form" class="search-form" action="<?php bbp_search_url(); ?>">
    <div>
        <label class="screen-reader-text hidden" for="bbp_search"><?php esc_html_e( 'Search for:', 'studiare' ); ?></label>
        <input type="hidden" name="action" value="bbp-search-request" />
        <input  type="text" placeholder="<?php echo esc_attr__( 'Search for:', 'studiare' ) ?>" value="<?php echo esc_attr( bbp_get_search_terms() ); ?>" name="bbp_search" id="bbp_search" />
        <button type="submit" class="search-submit" id="bbp_search_submit"><?php get_template_part('/assets/images/search-icon.svg'); ?></button>
    </div>
</form>