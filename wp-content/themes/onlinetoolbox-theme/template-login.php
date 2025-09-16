<?php
/**
 * Template Name: User Login
 *
 * @package OnlineToolbox
 */

// Handle the form submission
if ( isset( $_POST['wp-submit'] ) ) { // Note: wp_login_form uses 'wp-submit' as the name for the submit button
    $username = $_POST['log'];
    $password = $_POST['pwd'];

    $creds = array(
        'user_login'    => $username,
        'user_password' => $password,
        'remember'      => isset( $_POST['rememberme'] ),
    );

    $user = wp_signon( $creds, false );

    if ( is_wp_error( $user ) ) {
        $error = $user->get_error_message();
    } else {
        wp_redirect( home_url( '/profile/' ) ); // Redirect to profile page on success
        exit;
    }
}

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <article>
            <header class="entry-header">
                <h1 class="entry-title">Login</h1>
            </header>

            <div class="entry-content">
                <?php if ( ! empty( $error ) ) : ?>
                    <p class="login-error"><?php echo esc_html( $error ); ?></p>
                <?php endif; ?>

                <?php
                // Display login form
                wp_login_form( array(
                    'redirect'       => home_url( '/profile/' ),
                    'label_username' => __( 'Username or Email Address' ),
                    'label_password' => __( 'Password' ),
                    'label_remember' => __( 'Remember Me' ),
                    'label_log_in'   => __( 'Log In' ),
                ) );
                ?>
            </div>
        </article>
    </main>
</div>

<?php get_footer(); ?>
