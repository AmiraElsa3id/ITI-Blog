<?php

use Illuminate\Foundation\Inspiring;
use App\Jobs\PruneOldPostsJob;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule::job(new PruneOldPostsJob)->dailyAt('00:00');
Schedule::job(new PruneOldPostsJob)->everyMinute();