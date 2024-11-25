<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.3.0
 */

defined('ABSPATH') || exit;

global $product;

if (!comments_open()) {
    return;
}

?>
<div id="reviews" class="woocommerce-Reviews">
    <div id="comments">
        <?php if (have_comments()) : ?>
            <ol class="commentlist">
                <?php
                $comments = get_comments(array(
                    'post_id' => get_the_ID(), // Отримуємо ідентифікатор поточного запису
                    'status' => 'approve' // Відображаємо тільки схвалені коментарі
                ));

                foreach ($comments as $comment) :
                    ?>
                    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                        <div class="meta d-flex justify-content-between">
                            <span class="comment-author">
                                <?php echo esc_html(get_comment_author()); ?>
                            </span>
                            <time class="comment-date" datetime="<?php echo esc_attr( get_comment_date( 'c', $comment ) ); ?>">
                                <?php
                                printf( __( '%1$s' ), date_i18n( 'd.m.Y', strtotime( get_comment_date( '', $comment ) ) ) );
                                ?>
                            </time>

                        </div>

                        <?php comment_text(); ?>

                        <div class="star-rating d-flex gap-2">
                            <?php
                            // Output the rating if available
                            $rating = get_comment_meta($comment->comment_ID, 'rating', true);
                            if (!empty($rating)) {
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $rating) {
                                        echo '<span class="star star-filled d-inline-block"></span>';
                                    } else {
                                        echo '<span class="star star-empty d-inline-block"></span>';
                                    }
                                }
                            }
                            ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ol>

            <?php
            if (get_comment_pages_count() > 1 && get_option('page_comments')) :
                echo '<nav class="woocommerce-pagination">';
                paginate_comments_links(
                    apply_filters(
                        'woocommerce_comment_pagination_args',
                        array(
                            'prev_text' => is_rtl() ? '&rarr;' : '&larr;',
                            'next_text' => is_rtl() ? '&larr;' : '&rarr;',
                            'type' => 'list',
                        )
                    )
                );
                echo '</nav>';
            endif;
            ?>
        <?php else : ?>
            <p class="woocommerce-noreviews"><?= translate_and_output('no_reviews'); ?></p>
        <?php endif; ?>
    </div>

    <?php if (get_option('woocommerce_review_rating_verification_required') === 'no' || wc_customer_bought_product('', get_current_user_id(), $product->get_id())) : ?>
        <div id="review_form_wrapper">
            <div id="review_form">
                <?php
                $commenter = wp_get_current_commenter();
                $comment_form = array(
                    /* translators: %s is product title */
                    'title_reply' => translate_and_output('leave_review'),
                    /* translators: %s is product title */
                    'title_reply_to' => esc_html__('Leave a Reply', 'woocommerce'),
                    'title_reply_before' => '<span id="reply-title" class="comment-reply-title">',
                    'title_reply_after' => '</span>',
                    'comment_notes_after' => '',
                    'label_submit' => translate_and_output('send_review'),
                    'logged_in_as' => '',
                    'comment_field' => '',
                );


                $name_email_required = (bool)get_option('require_name_email', 1);
                $fields = array(
                    'author' => array(
                        'label' => translate_and_output('name'),
                        'type' => 'text',
                        'value' => $commenter['comment_author'],
                        'required' => $name_email_required,
                        'placeholder' => translate_and_output('write_your_name')
                    ),
                    'email' => array(
                        'label' => __('Email', 'woocommerce'),
                        'type' => 'email',
                        'value' => $commenter['comment_author_email'],
                        'required' => $name_email_required,
                        'placeholder' => translate_and_output('write_your_mail')
                    ),
                );

                $comment_form['fields'] = array();

                foreach ($fields as $key => $field) {
                    $field_html = '<p class="comment-form-' . esc_attr($key) . '">';
                    $field_html .= '<label for="' . esc_attr($key) . '">' . esc_html($field['label']);

                    if ($field['required']) {
                        $field_html .= '&nbsp;<span class="required">*</span>';
                    }

                    $field_html .= '</label><input id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" placeholder="' . esc_attr($field['placeholder']) . '" type="' . esc_attr($field['type']) . '" value="' . esc_attr($field['value']) . '" size="30" ' . ($field['required'] ? 'required' : '') . ' /></p>';

                    $comment_form['fields'][$key] = $field_html;
                }

                $account_page_url = wc_get_page_permalink('myaccount');
                if ($account_page_url) {
                    /* translators: %s opening and closing link tags respectively */
                    $comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf(esc_html__('You must be %1$slogged in%2$s to post a review.', 'woocommerce'), '<a href="' . esc_url($account_page_url) . '">', '</a>') . '</p>';
                }

                $comment_form['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . translate_and_output('you\'r_review') . '&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" required placeholder="' . translate_and_output('write_review') . '"></textarea></p>';

                if (wc_review_ratings_enabled()) {
                    $comment_form['comment_field'] .= '<div class="comment-form-rating"><label for="rating">' . translate_and_output('rating') . '&nbsp;<span class="required">*</span></label><select name="rating" id="rating" required>
                    <option value="">' . esc_html__('Rate&hellip;', 'woocommerce') . '</option>
                    <option value="5">' . esc_html__('Perfect', 'woocommerce') . '</option>
                    <option value="4">' . esc_html__('Good', 'woocommerce') . '</option>
                    <option value="3">' . esc_html__('Average', 'woocommerce') . '</option>
                    <option value="2">' . esc_html__('Not that bad', 'woocommerce') . '</option>
                    <option value="1">' . esc_html__('Very poor', 'woocommerce') . '</option>
                </select></div>';
                }

                comment_form(apply_filters('woocommerce_product_review_comment_form_args', $comment_form));
                ?>
            </div>
        </div>
    <?php else : ?>
        <p class="woocommerce-verification-required"><?php esc_html_e('Only logged in customers who have purchased this product may leave a review.', 'woocommerce'); ?></p>
    <?php endif; ?>

    <div class="clear"></div>
</div>
