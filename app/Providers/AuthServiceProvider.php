<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('view_user_block', function ($user) {

            return in_array('view_user_block', session()->get('access_permissions'));
        });
        Gate::define('view-user', function($user){
            return in_array('view-user', session()->get('access_permissions'));
        });
        Gate::define('add-user', function(){
            return in_array('add-user', session()->get('access_permissions'));
        });
        Gate::define('edit-user', function(){
            return in_array('edit-user', session()->get('access_permissions'));
        });
        Gate::define('delete-user', function(){
            return in_array('delete-user', session()->get('access_permissions'));
        });
        Gate::define('view-role', function($user){
            return in_array('view-role', session()->get('access_permissions'));
        });
        Gate::define('add-role', function(){
            return in_array('add-role', session()->get('access_permissions'));
        });
        Gate::define('edit-role', function(){
            return in_array('edit-role', session()->get('access_permissions'));
        });
        Gate::define('delete-role', function(){

            return in_array('delete-role', session()->get('access_permissions'));
        });
        Gate::define('view-permission', function($user){
            return in_array('view-permission', session()->get('access_permissions'));
        });
        Gate::define('add-permission', function(){
            return in_array('add-permission', session()->get('access_permissions'));
        });
        Gate::define('edit-permission', function(){
            return in_array('edit-permission', session()->get('access_permissions'));
        });
        Gate::define('delete-permission', function(){
            return in_array('delete-permission', session()->get('access_permissions'));
        });
        Gate::define('view-category', function($user){
            return in_array('view-category', session()->get('access_permissions'));
        });
        Gate::define('add-category', function(){
            return in_array('add-category', session()->get('access_permissions'));
        });
        Gate::define('edit-category', function(){
            return in_array('edit-category', session()->get('access_permissions'));
        });
        Gate::define('delete-category', function(){
            return in_array('delete-category', session()->get('access_permissions'));
        });
        Gate::define('publish-category', function(){
            return in_array('publish-category', session()->get('access_permissions'));
        });
        Gate::define('view-subcategory', function($user){
            return in_array('view-subcategory', session()->get('access_permissions'));
        });
        Gate::define('add-subcategory', function(){
            return in_array('add-subcategory', session()->get('access_permissions'));
        });
        Gate::define('edit-subcategory', function(){
            return in_array('edit-subcategory', session()->get('access_permissions'));
        });
        Gate::define('delete-subcategory', function(){
            return in_array('delete-subcategory', session()->get('access_permissions'));
        });
        Gate::define('view-news', function($user){
            return in_array('view-news', session()->get('access_permissions'));
        });
        Gate::define('add-news', function(){
            return in_array('add-news', session()->get('access_permissions'));
        });
        Gate::define('edit-news', function(){
            return in_array('edit-news', session()->get('access_permissions'));
        });
        Gate::define('delete-news', function(){
            return in_array('delete-news', session()->get('access_permissions'));
        });
        Gate::define('publish-news', function(){
            return in_array('publish-news', session()->get('access_permissions'));
        });
        Gate::define('view-gallery', function($user){
            return in_array('view-gallery', session()->get('access_permissions'));
        });
        Gate::define('add-gallery', function(){
            return in_array('add-gallery', session()->get('access_permissions'));
        });
        Gate::define('edit-gallery', function(){
            return in_array('edit-gallery', session()->get('access_permissions'));
        });
        Gate::define('delete-gallery', function(){
            return in_array('delete-gallery', session()->get('access_permissions'));
        });
        Gate::define('publish-gallery', function(){
            return in_array('publish-gallery', session()->get('access_permissions'));
        });
        Gate::define('view-media', function($user){
            return in_array('view-media', session()->get('access_permissions'));
        });
        Gate::define('add-media', function(){
            return in_array('add-media', session()->get('access_permissions'));
        });
        Gate::define('edit-media', function(){
            return in_array('edit-media', session()->get('access_permissions'));
        });
        Gate::define('delete-media', function(){
            return in_array('delete-media', session()->get('access_permissions'));
        });
        Gate::define('view-user', function($user){
            return in_array('view-user', session()->get('access_permissions'));
        });
        Gate::define('add-user', function(){
            return in_array('add-user', session()->get('access_permissions'));
        });
        Gate::define('edit-user', function(){
            return in_array('edit-user', session()->get('access_permissions'));
        });
        Gate::define('delete-user', function(){
            return in_array('delete-user', session()->get('access_permissions'));
        });
        Gate::define('approve-user', function(){
            return in_array('approve-user', session()->get('access_permissions'));
        });
        Gate::define('assign-role', function(){
            return in_array('assign-role', session()->get('access_permissions'));
        });
        Gate::define('assign-category', function(){
            return in_array('assign-category', session()->get('access_permissions'));
        });
        Gate::define('add-video', function(){
            return in_array('add-video', session()->get('access_permissions'));
        });
        Gate::define('edit-video', function(){
            return in_array('edit-video', session()->get('access_permissions'));
        });
        Gate::define('delete-video', function(){
            return in_array('delete-video', session()->get('access_permissions'));
        });
        Gate::define('view-video', function($user){
            return in_array('view-video', session()->get('access_permissions'));
        });
        Gate::define('publish-video', function(){
            return in_array('publish-video', session()->get('access_permissions'));
        });
        Gate::define('add-advertising', function(){
            return in_array('add-advertising', session()->get('access_permissions'));
        });
        Gate::define('edit-advertising', function(){
            return in_array('edit-advertising', session()->get('access_permissions'));
        });
        Gate::define('delete-advertising', function(){
            return in_array('delete-advertising', session()->get('access_permissions'));
        });
        Gate::define('view-advertising', function($user){
            return in_array('view-advertising', session()->get('access_permissions'));
        });
        Gate::define('publish-advertising', function(){
            return in_array('publish-advertising', session()->get('access_permissions'));
        });
        Gate::define('add-popup', function(){
            return in_array('add-popup', session()->get('access_permissions'));
        });
        Gate::define('edit-popup', function(){
            return in_array('edit-popup', session()->get('access_permissions'));
        });
        Gate::define('delete-popup', function(){
            return in_array('delete-popup', session()->get('access_permissions'));
        });
        Gate::define('view-popup', function($user){
            return in_array('view-popup', session()->get('access_permissions'));
        });
        Gate::define('publish-popup', function(){
            return in_array('publish-popup', session()->get('access_permissions'));
        });

    }
}
