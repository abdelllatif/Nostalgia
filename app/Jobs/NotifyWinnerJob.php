<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Product;
use App\Mail\WinnerNotification;
use Illuminate\Support\Facades\Mail;

class NotifyWinnerJob extends Job
{
    protected $userId;
    protected $productId;

    public function __construct($userId, $productId)
    {
        $this->userId = $userId;
        $this->productId = $productId;
    }

    public function handle()
    {
        $user = User::find($this->userId);
        $product = Product::find($this->productId);

        Mail::to($user->email)->send(new WinnerNotification($product));
    }
}
