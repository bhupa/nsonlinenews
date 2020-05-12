<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class DataViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['backend.app','include.sidebar',
             'backend.permission.index','backend.permission.add',
             'backend.role.index','backend.role.add',
            'backend.category.index','backend.category.add','backend.category.edit','backend.category.sortable',
            'backend.subcategory.index','backend.subcategory.add','backend.subcategory.edit',
            'backend.news.index','backend.news.add','backend.news.edit',
            'backend.gallery.index','backend.gallery.add','backend.gallery.edit','backend.gallery.uploadimage','backend.gallery.image',
            'backend.user.index','backend.user.add','backend.user.edit','backend.user.assignrole','backend.user.assigncategory',
            'backend.video.index','backend.video.create','backend.video.edit',
            'backend.advertising.index','backend.advertising.create','backend.advertising.edit',
            'backend.popup.index','backend.popup.create','backend.popup.edit',

        ], function($view){

            $view->with('user', Auth::user());
        });
        view()->composer(['layouts.frontend.app'],
            'App\Http\ViewComposers\NavbarComposer'
        );
        view()->composer(['layouts.frontend.app'],
            'App\Http\ViewComposers\FooterComposer'
        );
        view()->composer(['home'],
            'App\Http\ViewComposers\HomeComposer'
        );
    }
}
