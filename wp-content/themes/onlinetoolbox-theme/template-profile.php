<?php
/**
 * Template Name: User Profile
 *
 * @package OnlineToolbox
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <article>
            <header class="entry-header">
                <h1 class="entry-title">Your Profile</h1>
            </header>

            <div class="entry-content">
                <?php if ( is_user_logged_in() ) : ?>
                    <?php $current_user = wp_get_current_user(); ?>
                    <p>
                        Hello, <strong><?php echo esc_html( $current_user->user_login ); ?></strong>!
                    </p>
                    <p>
                        Your email address is: <?php echo esc_html( $current_user->user_email ); ?>
                    </p>

                    <hr>

                    <h2>Your Favorite Tools</h2>
                    <div class="favorite-tools-list">
                        <?php
                        $user_id = get_current_user_id();
                        $favorites = get_user_meta( $user_id, '_favorite_tools', true );

                        if ( ! empty( $favorites ) && is_array( $favorites ) ) {
                            $args = array(
                                'post_type' => 'tools',
                                'post__in'  => $favorites,
                                'orderby'   => 'post__in',
                                'posts_per_page' => -1, // Show all favorites
                            );
                            $favorite_tools_query = new WP_Query( $args );

                            if ( $favorite_tools_query->have_posts() ) :
                                echo '<ul>';
                                while ( $favorite_tools_query->have_posts() ) : $favorite_tools_query->the_post();
                                    ?>
                                    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                    <?php
                                endwhile;
                                echo '</ul>';
                                wp_reset_postdata();
                            else :
                                echo '<p>You have not favorited any tools yet.</p>';
                            endif;
                        } else {
                            echo '<p>You have not favorited any tools yet.</p>';
                        }
                        ?>
                    </div>

                    <hr>

                    <a href="<?php echo wp_logout_url( home_url() ); ?>">Log Out</a>

                <?php else : ?>

                    <p>You must be logged in to view your profile.</p>
                    <a href="<?php echo esc_url( home_url( '/login/' ) ); ?>">Log In</a>

                <?php endif; ?>
            </div>
        </article>
    </main>
</div>

<?php get_footer(); ?>
