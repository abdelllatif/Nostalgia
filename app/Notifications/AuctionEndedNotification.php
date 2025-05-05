<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AuctionEndedNotification extends Notification
{
    use Queueable;

    protected $product;
    protected $winner;

    public function __construct($product, $winner = null)
    {
        $this->product = $product;
        $this->winner = $winner;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $message = (new MailMessage)
            ->subject('Votre enchère est terminée')
            ->greeting('Bonjour ' . $notifiable->name);

        if ($this->winner) {
            $message->line('Votre enchère pour ' . $this->product->name . ' est terminée.')
                   ->line('Le gagnant est: ' . $this->winner->name)
                   ->action('Voir le profil du gagnant', url('/users/' . $this->winner->id))
                   ->line('Montant gagnant: ' . $this->product->current_price . ' €');
        } else {
            $message->line('Votre enchère pour ' . $this->product->name . ' est terminée.')
                   ->line('Malheureusement, aucune enchère n\'a été placée sur votre produit.')
                   ->action('Relancer l\'enchère', url('/products/' . $this->product->id . '/relist'));
        }

        return $message->salutation('Cordialement, Nostalgia');
    }
}
