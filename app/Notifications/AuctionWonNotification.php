<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AuctionWonNotification extends Notification
{
    use Queueable;

    protected $product;
    protected $winningAmount;

    public function __construct($product, $winningAmount)
    {
        $this->product = $product;
        $this->winningAmount = $winningAmount;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Félicitations! Vous avez remporté l\'enchère!')
            ->greeting('Félicitations ' . $notifiable->name . '!')
            ->line('Vous avez remporté l\'enchère pour ' . $this->product->name)
            ->line('Montant gagnant: ' . $this->winningAmount . ' €')
            ->action('Voir les détails', url('/products/' . $this->product->id))
            ->line('Nous vous contacterons bientôt pour finaliser la transaction.')
            ->salutation('Cordialement, Nostalgia');
    }
}
