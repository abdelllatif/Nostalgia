<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\UpdateAuctionStatus;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('products:update-auctions', function () {
    // You can either call the handle method of the command or directly write the logic here
    (new UpdateAuctionStatus())->handle();
})->describe('Update auction statuses');
