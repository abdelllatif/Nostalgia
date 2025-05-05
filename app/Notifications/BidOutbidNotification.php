<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BidOutbidNotification extends Notification
{
    use Queueable;

    protected $product;
    protected $newBidAmount;

    public function __construct($product, $newBidAmount)
    {
        $this->product = $product;
        $this->newBidAmount = $newBidAmount;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Vous avez été surenchéri!')
            ->greeting('Bonjour ' . $notifiable->name)
            ->line('Quelqu\'un a placé une enchère plus élevée sur ' . $this->product->name)
            ->line('Nouvelle enchère: ' . $this->newBidAmount . ' €')
            ->action('Placer une nouvelle enchère', url('/products/' . $this->product->id))
            ->line('N\'oubliez pas que l\'enchère se termine le ' . $this->product->end_date->format('d/m/Y H:i'))
            ->salutation('Cordialement, Nostalgia');
    }
}