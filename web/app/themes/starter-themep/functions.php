<?php

/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @link https://github.com/timber/starter-theme
 */

namespace App;

use Timber\Timber;

// Load Composer dependencies.
require_once __DIR__ . '/vendor/autoload.php';

Timber::init();

new StarterSite();

require_once get_template_directory() . '/src/Acf/AcfServiceProvider.php';
add_action('acf/init', function () {
    (new \App\Acf\Blocks\MyBlock())->register();
});
