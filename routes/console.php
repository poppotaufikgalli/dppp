<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\VisitedCron;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('visited:cron', function () {
    $command = new VisitedCron();
    $command->handle();
})->describe('Tesst');

Schedule::command('visited:cron')->daily();