<?php

namespace CAP\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;

use Bootstrapper\Facades\Carousel;
use Bootstrapper\Facades\Accordion;
use Bootstrapper\Facades\Alert;
use Bootstrapper\Facades\Badge;
use Bootstrapper\Facades\Breadcrumb;
use Bootstrapper\Facades\Button;
use Bootstrapper\Facades\ButtonGroup;
use Bootstrapper\Facades\Icon;
use Bootstrapper\Facades\Image;
use Bootstrapper\Facades\InputGroup;
use Bootstrapper\Facades\Label;
use Bootstrapper\Facades\MediaObject;
use Bootstrapper\Facades\Modal;
use Bootstrapper\Facades\Navbar;
use Bootstrapper\Facades\Navigation;
use Bootstrapper\Facades\Panel;
use Bootstrapper\Facades\ProgressBar;
use Bootstrapper\Facades\Tabbable;
use Bootstrapper\Facades\Table;
use Bootstrapper\Facades\Thumbnail;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);
}
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Accordion', Accordion::class);
        $loader->alias('Alert', Alert::class);
        $loader->alias('Badge', Badge::class);
        $loader->alias('Breadcrumb', Breadcrumb::class);
        $loader->alias('Button', Button::class);
        $loader->alias('ButtonGroup', ButtonGroup::class);
        $loader->alias('Carousel', Carousel::class);
        $loader->alias('ControlGroup', ControlGroup::class);
        $loader->alias('DropdownButton', DropdownButton::class);
        $loader->alias('Helpers', Helpers::class);
        $loader->alias('Icon', Icon::class);
        $loader->alias('InputGroup', InputGroup::class);
        $loader->alias('Image', Image::class);
        $loader->alias('Label', Label::class);
        $loader->alias('MediaObject', MediaObject::class);
        $loader->alias('Modal', Modal::class);
        $loader->alias('Navbar', Navbar::class);
        $loader->alias('Navigation', Navigation::class);
        $loader->alias('Panel', Panel::class);
        $loader->alias('ProgressBar', ProgressBar::class);
        $loader->alias('Tabbable', Tabbable::class);
        $loader->alias('Table', Table::class);
        $loader->alias('Thumbnail', Thumbnail::class);
//        $loader->alias('Form', \Bootstrapper\Facades\Form::class);

        if ($this->app->environment() !== 'production') {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }
}
