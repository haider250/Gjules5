<?php
/**
 * Template Name: User Registration
 *
 * @package OnlineToolbox
 */

// Handle the form submission
if ( isset( $_POST['submit_registration'] ) ) {
    $username = sanitize_user( $_POST['username'] );
    $email    = sanitize_email( $_POST['email'] );
    $password = $_POST['password'];

    $error = '';

    if ( username_exists( $username ) ) {
        $error = 'Username already exists.';
    } elseif ( ! validate_username( $username ) ) {
        $error = 'Invalid username.';
    } elseif ( email_exists( $email ) ) {
        $error = 'Email already in use.';
    } elseif ( ! is_email( $email ) ) {
        $error = 'Invalid email.';
    } elseif ( empty( $password ) ) {
        $error = 'Password cannot be empty.';
    }

    if ( empty( $error ) ) {
        $user_id = wp_create_user( $username, $password, $email );
        if ( ! is_wp_error( $user_id ) ) {
            // Log the user in
            $creds = array(
                'user_login'    => $username,
                'user_password' => $password,
                'remember'      => true,
            );
            $user = wp_signon( $creds, false );
            wp_redirect( home_url('/profile/') ); // Redirect to a profile page
            exit;
        } else {
            $error = $user_id->get_error_message();
        }
    }
}

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <article>
            <header class="entry-header">
                <h1 class="entry-title">Register</h1>
            </header>

            <div class="entry-content">
                <?php if ( ! empty( $error ) ) : ?>
                    <p class="registration-error"><?php echo esc_html( $error ); ?></p>
                <?php endif; ?>

                <form method="post">
                    <p>
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" required>
                    </p>
                    <p>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required>
                    </p>
                    <p>
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required>
                    </p>
                    <p>
                        <input type="submit" name="submit_registration" value="Register">
                    </p>
                </form>
            </div>
        </article>
    </main>
</div>

<?php get_footer(); ?>
