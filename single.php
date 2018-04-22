<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @package Bootstrap 4.1
 * @subpackage  Timber
 * @since    Timber 0.1
 *
 */

    $argscf = array(
        'id_form'           => 'commentform',
        'title_reply'       => __('leave a thought', 'pwasite'),
        'title_reply_to'    => __('leave a thought to %s', 'pwasite'),
        'cancel_reply_link' => __('cancel thought', 'pwasite'),
        'label_submit'      => __('post thought', 'pwasite'),
        'comment_field' =>  '<p><textarea placeholder="Start typing..." id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
        'comment_notes_after' => '<p class="form-allowed-tags">' . __('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:', 'wp-bootstrap-starter') . '</p><div class="alert alert-info">' . allowed_tags() . '</div>',
        'class_submit' => 'submit btn btn-primary'
      );

//$content['form'] = $form;
$context = Timber::get_context();
$context['dynamic_sidebar1'] = Timber::get_widgets('footersidebar1');
$context['dynamic_sidebar2'] = Timber::get_widgets('footersidebar2');
$context['argscf'] = $argscf;
$post = Timber::query_post();
$context['post'] = $post;

//echo $form;
if (post_password_required($post->ID)) {
    Timber::render('single-password.twig', $context);
} else {
    Timber::render(array( 'single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig' ), $context);
}
