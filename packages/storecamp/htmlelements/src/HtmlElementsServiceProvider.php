<?php

namespace storecamp\htmlelements;

use Illuminate\Support\ServiceProvider;
use Collective\Html\HtmlBuilder;
use storecamp\htmlelements\Bridges\Config\Laravel5Config;
use storecamp\htmlelements\Facades\Menu;

class HtmlElementsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'elements');
//        $this->publishes([
//            __DIR__.'/views' => resource_path('views/vendor/htmlelements'),
//        ]);
//        $this->loadViewsFrom(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views', MenuManager::PLUGIN_NAME);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes(
            [
                __DIR__ . '/config/config.php' => config_path(
                    'htmlelements.php'
                )
            ]
        );
        $this->mergeConfigFrom(
            __DIR__ . '/config/htmlelements.php',
            'htmlelements'
        );
        $this->registerMenu();
        $this->registerAccordion();
        $this->registerAlert();
        $this->registerBadge();
        $this->registerBreadcrumb();
        $this->registerButtonGroup();
        $this->registerButton();
        $this->registerCarousel();
        $this->registerConfig();
        $this->registerControlGroup();
        $this->registerDropdownButton();
        $this->registerFormBuilder();
        $this->registerIcon();
        $this->registerImage();
        $this->registerInputGroup();
        $this->registerHelpers();
        $this->registerLabel();
        $this->registerMediaObject();
        $this->registerModal();
        $this->registerNavbar();
        $this->registerNavigation();
        $this->registerPanel();
        $this->registerProgressBar();
        $this->registerTabbable();
        $this->registerTable();
        $this->registerThumbnail();

    }

    private function registerMenu() {
        $this->app->singleton('elements.menu.manager', function ($app) {
            return new MenuManager($app['view'], $app['url']);
        });
        $this->app->bind(
            'menu',
            function () {
                return new Menu();
            }
        );
    }
    /**
     * Registers the Accordion class in the IoC
     */
    private function registerAccordion()
    {
        $this->app->bind(
            'htmlelements::accordion',
            function () {
                return new Accordion();
            }
        );
    }

    /**
     * Registers the Alert class in the IoC
     */
    private function registerAlert()
    {
        $this->app->bind(
            'htmlelements::alert',
            function () {
                return new Alert();
            }
        );
    }

    /**
     * Registers the Badge class into the IoC
     */
    private function registerBadge()
    {
        $this->app->bind(
            'htmlelements::badge',
            function () {
                return new Badge;
            }
        );
    }

    /**
     * Registers the Breadcrumb class into the IoC
     */
    private function registerBreadcrumb()
    {
        $this->app->bind(
            'htmlelements::breadcrumb',
            function () {
                return new Breadcrumb;
            }
        );
    }

    /**
     * Registers the ButtonGroup class into the IoC
     */
    private function registerButtonGroup()
    {
        $this->app->bind(
            'htmlelements::buttongroup',
            function () {
                return new ButtonGroup;
            }
        );
    }

    /**
     * Registers the Button class into the IoC
     */
    private function registerButton()
    {
        $this->app->bind(
            'htmlelements::button',
            function () {
                return new Button;
            }
        );
    }

    /**
     * Registers the Carousel class into the IoC
     */
    private function registerCarousel()
    {
        $this->app->bind(
            'htmlelements::carousel',
            function () {
                return new Carousel;
            }
        );
    }

    private function registerConfig()
    {
        $this->app->bind(
            'htmlelements::config',
            function ($app) {
                return new Laravel5Config($app->make('config'));
            }
        );
    }

    /**
     * Registers the ControlGroup class into the IoC
     */
    private function registerControlGroup()
    {
        $this->app->bind(
            'htmlelements::controlgroup',
            function ($app) {
                return new ControlGroup($app['htmlelements::form']);
            }
        );
    }

    /**
     * Registers the DropdownButton class into the IoC
     */
    private function registerDropdownButton()
    {
        $this->app->bind(
            'htmlelements::dropdownbutton',
            function () {
                return new DropdownButton;
            }
        );
    }

    /**
     * Registers the FormBuilder class into the IoC
     */
    private function registerFormBuilder()
    {
        $this->app->bind(
            'collective::html',
            function ($app) {
                return new HtmlBuilder($app->make('url'), $app->make('view'));
            }
        );
        $this->app->bind(
            'htmlelements::form',
            function ($app) {
                $form = new Form(
                    $app->make('collective::html'),
                    $app->make('url'),
                    $app->make('view'),
                    $app['session.store']->getToken()
                );

                return $form->setSessionStore($app['session.store']);
            },
            true
        );
    }

    /**
     * Registers the Icon class into the IoC
     */
    private function registerIcon()
    {
        $this->app->bind(
            'htmlelements::icon',
            function ($app) {
                return new Icon($app['htmlelements::config']);
            }
        );
    }

    /**
     * Registers the Image class into the IoC
     */
    private function registerImage()
    {
        $this->app->bind(
            'htmlelements::image',
            function () {
                return new Image;
            }
        );
    }

    /**
     * Registers the InputGroup class into the IoC
     */
    private function registerInputGroup()
    {
        $this->app->bind(
            'htmlelements::inputgroup',
            function () {
                return new InputGroup;
            }
        );
    }

    /**
     * Registers the Label class into the IoC
     */
    private function registerLabel()
    {
        $this->app->bind(
            'htmlelements::label',
            function () {
                return new Label;
            }
        );
    }

    /**
     * Registers the Helpers class into the IoC
     */
    private function registerHelpers()
    {
        $this->app->bind(
            'htmlelements::helpers',
            function ($app) {
                return new Helpers($app['htmlelements::config']);
            }
        );
    }

    /**
     * Registers the MediaObject class into the IoC
     */
    private function registerMediaObject()
    {
        $this->app->bind(
            'htmlelements::mediaobject',
            function () {
                return new MediaObject;
            }
        );
    }

    /**
     * Registers the Modal class into the IoC
     */
    private function registerModal()
    {
        $this->app->bind(
            'htmlelements::modal',
            function () {
                return new Modal;
            }
        );
    }

    /**
     * Registers the Navbar class into the IoC
     */
    private function registerNavbar()
    {
        $this->app->bind(
            'htmlelements::navbar',
            function ($app) {
                return new Navbar($app->make('url'));
            }
        );
    }

    /**
     * Registers the Navigation class into the IoC
     */
    private function registerNavigation()
    {
        $this->app->bind(
            'htmlelements::navigation',
            function ($app) {
                return new Navigation($app->make('url'));
            }
        );
    }

    /**
     * Registers the Panel class into the IoC
     */
    private function registerPanel()
    {
        $this->app->bind(
            'htmlelements::panel',
            function () {
                return new Panel;
            }
        );
    }

    /**
     * Registers the ProgressBar class into the IoC
     */
    private function registerProgressBar()
    {
        $this->app->bind(
            'htmlelements::progressbar',
            function () {
                return new ProgressBar;
            }
        );
    }

    /**
     * Registers the Tabbable class into the IoC
     */
    private function registerTabbable()
    {
        $this->app->bind(
            'htmlelements::tabbable',
            function ($app) {
                return new Tabbable($app['htmlelements::navigation']);
            }
        );
    }

    /**
     * Registers the Table class into the IoC
     */
    private function registerTable()
    {
        $this->app->bind(
            'htmlelements::table',
            function () {
                return new Table;
            }
        );
    }

    /**
     * Registers the Thumbnail class into the IoC
     */
    private function registerThumbnail()
    {
        $this->app->bind(
            'htmlelements::thumbnail',
            function () {
                return new Thumbnail;
            }
        );

    }

}