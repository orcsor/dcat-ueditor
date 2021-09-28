<?php

namespace Orcsor\DcatUeditor;

use Dcat\Admin\Extend\ServiceProvider;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Orcsor\DcatUeditor\Events\Uploading;

class DcatUeditorServiceProvider extends ServiceProvider
{


    public function register()
    {
        //
    }

    public function init()
    {
        parent::init();

        $this->loadViewsFrom(__DIR__ . '/../resources/views', Ueditor::NAME);

        if ($this->app->runningInConsole() || request()->getMethod() == 'POST') {
            $this->publishes([__DIR__ . '/../config' => config_path()]);
        }

        Admin::booting(function () {
            Form::extend('ueditor', \Orcsor\DcatUeditor\Form\Ueditor::class);
        });

    }

}
