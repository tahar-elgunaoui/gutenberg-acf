<?php 
namespace App\Acf;

use App\Acf\Blocks\MyBlock;

class AcfServiceProvider
{
    public static function register(): void
    {
        add_action('acf/init', [self::class, 'registerBlocks']);
    }

    public static function registerBlocks(): void
    {
        (new MyBlock())->register();
    }
}
