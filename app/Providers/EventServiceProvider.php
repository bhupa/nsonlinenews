<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        'Unisharp\Laravelfilemanager\Events\ImageIsDeleting' => [
            'App\Listeners\DeleteImageListener'
        ],
        'Unisharp\Laravelfilemanager\Events\ImageIsRenaming' => [
            'App\Listeners\RenameImageListener'
        ],
        'Unisharp\Laravelfilemanager\Events\ImageIsUploading' => [
            'App\Listeners\IsUploadingImageListener'
        ],
        'Unisharp\Laravelfilemanager\Events\ImageWasUploaded' => [
            'App\Listeners\HasUploadedImageListener'
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
