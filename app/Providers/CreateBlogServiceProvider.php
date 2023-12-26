<?php

namespace App\Providers;

use App\Models\Blog;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\ServiceProvider;

class CreateBlogServiceProvider extends ServiceProvider
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Verified  $event
     * @return void
     */
    public function handle(Verified $event)
    {
        $blog = new Blog();
        $blog->user_id = auth()
            ->user()
            ->id;
        $blog->save();

        auth()->user()
            ->blog()
            ->save($blog);
    }
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
