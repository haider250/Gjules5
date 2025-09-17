<?php
/**
 * Template Name: Workflow Builder
 *
 * @package OnlineToolbox
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <header class="entry-header">
            <h1 class="entry-title">Tool Workflow Builder</h1>
        </header>

        <div class="workflow-container">
            <div class="workflow-input-area">
                <label for="workflow-input">Starting Input:</label>
                <textarea id="workflow-input" rows="10"></textarea>
            </div>

            <div class="workflow-steps-area">
                <h3>Workflow Steps:</h3>
                <div id="workflow-steps-container">
                    <!-- Workflow steps will be added here dynamically -->
                </div>
                <button id="add-step-btn">+ Add Step</button>
            </div>

            <div class="workflow-run-area">
                <button id="run-workflow-btn">Run Workflow</button>
            </div>

            <?php if ( is_user_logged_in() ) : ?>
            <div class="workflow-save-load-area">
                <hr>
                <h3>Save & Load Workflows</h3>
                <div class="save-workflow-form">
                    <label for="workflow-name">Workflow Name:</label>
                    <input type="text" id="workflow-name" placeholder="My Awesome Workflow">
                    <button id="save-workflow-btn">Save Current Workflow</button>
                </div>

                <h4>Your Saved Workflows:</h4>
                <div id="saved-workflows-list">
                    <?php
                    $args = array(
                        'post_type' => 'workflow',
                        'author'    => get_current_user_id(),
                        'posts_per_page' => -1,
                    );
                    $saved_workflows = new WP_Query( $args );
                    if ( $saved_workflows->have_posts() ) :
                        echo '<ul>';
                        while ( $saved_workflows->have_posts() ) : $saved_workflows->the_post();
                            ?>
                            <li>
                                <?php the_title(); ?>
                                <button class="load-workflow-btn" data-workflow-id="<?php echo get_the_ID(); ?>">Load</button>
                            </li>
                            <?php
                        endwhile;
                        echo '</ul>';
                        wp_reset_postdata();
                    else :
                        echo '<p>You have no saved workflows.</p>';
                    endif;
                    ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="workflow-output-area">
                <label for="workflow-output">Final Output:</label>
                <textarea id="workflow-output" rows="10" readonly></textarea>
            </div>
        </div>
    </main>
</div>

<?php get_footer(); ?>
