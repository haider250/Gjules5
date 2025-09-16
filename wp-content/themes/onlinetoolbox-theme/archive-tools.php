<?php
/**
 * The template for displaying archive pages for the 'tools' custom post type.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OnlineToolbox
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php if ( have_posts() ) : ?>

            <header class="page-header">
                <?php
                    the_archive_title( '<h1 class="page-title">', '</h1>' );
                    the_archive_description( '<div class="archive-description">', '</div>' );
                ?>
            </header><!-- .page-header -->

            <div class="tools-grid">
                <?php
                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();
                ?>
                    <div class="tool-card">
                        <a href="<?php the_permalink(); ?>">
                            <h2><?php the_title(); ?></h2>
                        </a>
                    </div>
                <?php
                endwhile;
                ?>
            </div><!-- .tools-grid -->

            <?php
            the_posts_navigation();

        else :
            ?>
            <p><?php esc_html_e( 'No tools found in this category.', 'onlinetoolbox' ); ?></p>
            <?php
        endif; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
