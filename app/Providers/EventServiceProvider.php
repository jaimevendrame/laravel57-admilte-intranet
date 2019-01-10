<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\PostViewed;
use App\Listeners\IncrementPostViewed;
use App\Events\CommentAnswered;
use App\Listeners\SendMailCommentAnswered;
use App\Listeners\ChangeStatusCommentAnswered;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

//        'App\Events\Event' => [
//            'App\Listeners\EventListener',
//        ],
        PostViewed::class => [
            IncrementPostViewed::class,
        ],
        CommentAnswered::class => [
            SendMailCommentAnswered::class,
            ChangeStatusCommentAnswered::class,
        ],

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
