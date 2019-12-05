<?php

/**
 * Hero Info Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'hero-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$className = 'hero';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$title = get_field('title');
$subtitle = get_field('sub_title');
$place = get_field('place');
$bg = get_field('background');

?>
<section id="<?php echo esc_attr($id); ?>" class="hero-info <?php echo esc_attr($className); ?>" style=" background-image: url('<?php echo $bg; ?>'); ">
<div class="hero-info__inner">
    <h2>
        <?php echo $title ?: __('Title here'); ?>
    </h2>
    <h3>
        <?php echo $subtitle ?: __('Sub Title here'); ?>
    </h3>
    <h5>
        <span><?php echo $place ?: __('Sub Title here'); ?></span>
    </h5>
</div>


</section>
