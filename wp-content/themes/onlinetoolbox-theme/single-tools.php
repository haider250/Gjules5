<?php
/**
 * The template for displaying a single tool.
 *
 * @package OnlineToolbox
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        while ( have_posts() ) :
            the_post();
        ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <?php
                        the_content();
                    ?>
                </div><!-- .entry-content -->

                <footer class="entry-footer">
                    <?php
                    if ( is_user_logged_in() ) {
                        $user_id = get_current_user_id();
                        $tool_id = get_the_ID();
                        $favorites = get_user_meta( $user_id, '_favorite_tools', true );
                        if ( ! is_array( $favorites ) ) {
                            $favorites = array();
                        }

                        $is_favorite = in_array( $tool_id, $favorites );
                        $button_text = $is_favorite ? 'Remove from Favorites' : 'Add to Favorites';
                        ?>
                        <button id="favorite-toggle-btn" data-tool-id="<?php echo esc_attr( $tool_id ); ?>">
                            <?php echo esc_html( $button_text ); ?>
                        </button>
                        <?php
                    }
                    ?>
                </footer><!-- .entry-footer -->
            </article><!-- #post-<?php the_ID(); ?> -->

        <?php
        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
