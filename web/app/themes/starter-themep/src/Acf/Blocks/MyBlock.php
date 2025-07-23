<?php
// src/Acf/Blocks/MyBlock.php

namespace App\Acf\Blocks;

use StoutLogic\AcfBuilder\FieldsBuilder;

class MyBlock
{
    /**
     * Register block and fields on acf/init hook
     */
    public function register(): void
    {
        acf_register_block_type([
            'name'            => 'my-block',
            'title'           => __('My Block'),
            'render_callback' => [$this, 'render'],
            'category'        => 'formatting',
            'icon'            => 'admin-post',
            'keywords'        => ['custom'],
            'mode'            => 'preview',
            'supports'        => [
                'align' => false,
                'mode'  => true,
            ],
        ]);

        add_action('acf/init', [$this, 'registerFields']);
    }

    /**
     * Register ACF fields attached to the block
     */
    public function registerFields(): void
    {
        $fields = new FieldsBuilder('block_my_block');

        $fields
            ->addText('title')
            ->addTextarea('content');

        acf_add_local_field_group(
            $fields
                ->setLocation('block', '==', 'acf/my-block')
                ->build()
        );
    }

    /**
     * Render the block via Timber
     */
    public function render(array $block, $content = '', bool $is_preview = false, $post_id = 0): void
    {
        $context = \Timber\Timber::context();
        $context['block'] = $block;
        $context['fields'] = get_fields();

        \Timber\Timber::render('blocks/my-block/my-block.twig', $context);
    }
}
