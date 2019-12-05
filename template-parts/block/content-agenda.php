<?php

/**
 * Agenda Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'agenda-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$className = 'agenda';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$title = get_field('title_agenda_block');

?>
<section id="agenda" class="<?php echo esc_attr($className); ?>">
    <h2>
        <?php echo $title ?: __('Title here'); ?>
    </h2>

    <div class="agenda__inner">

    <?php if( have_rows('info_blocks') ): ?>

            <?php while( have_rows('info_blocks') ): the_row();

                $info_blocks_title = get_sub_field('info_blocks_title');
                $info_blocks_content = get_sub_field('content');
                 ?>
                <div class="agenda-one-info">
                    <h5><?php echo $info_blocks_title; ?></h5>
                    <?php echo $info_blocks_content; ?>
                </div>

            <?php endwhile; ?>

    <?php endif; ?>

</div>


</section>
