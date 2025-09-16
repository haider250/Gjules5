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
                        <p><em>(Favorite tools functionality will be implemented here.)</em></p>
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
