<?php
/**
 * The template for displaying the homepage.
 *
 * @package OnlineToolbox
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <header class="page-header">
            <h1 class="page-title"><?php esc_html_e( 'Online Tools', 'onlinetoolbox' ); ?></h1>
            <p><?php esc_html_e( 'A collection of free and easy-to-use online tools.', 'onlinetoolbox' ); ?></p>
        </header>

        <div class="tool-categories-grid">
            <?php
            $tool_categories = get_terms( array(
                'taxonomy'   => 'tool_category',
                'hide_empty' => false,
            ) );

            if ( ! empty( $tool_categories ) && ! is_wp_error( $tool_categories ) ) :
                foreach ( $tool_categories as $category ) :
            ?>
                    <div class="category-card">
                        <a href="<?php echo esc_url( get_term_link( $category ) ); ?>">
                            <h2><?php echo esc_html( $category->name ); ?></h2>
                            <p><?php echo esc_html( $category->description ); ?></p>
                        </a>
                    </div>
            <?php
                endforeach;
            else :
            ?>
                <p><?php esc_html_e( 'No tool categories found.', 'onlinetoolbox' ); ?></p>
            <?php
            endif;
            ?>
        </div><!-- .tool-categories-grid -->

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
