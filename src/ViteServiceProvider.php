<?php

namespace Mountz\HypervelVite;

use Hypervel\Support\ServiceProvider;
use Hypervel\Support\Facades\Blade;

class ViteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Blade::directive('vite', function ($expression) {
            return "<?php echo \Mountz\HypervelVite\ViteHelper::render($expression); ?>";
        });
    }
}
