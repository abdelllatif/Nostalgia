<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Product;
use App\Models\User;

class BidNotification extends Notification
{
    use Queueable;

    protected $type;
    protected $product;
    protected $bidAmount;
    protected $winner;

    public function __construct($type, Product $product, $bidAmount = null, User $winner = null)
    {
        $this->type = $type;
        $this->product = $product;
        $this->bidAmount = $bidAmount;
        $this->winner = $winner;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        switch ($this->type) {
            case 'outbid':
                return $this->outbidMail($notifiable);
            case 'auction_ended':
                return $this->auctionEndedMail($notifiable);
            case 'auction_ended_no_bids':
                return $this->auctionEndedNoBidsMail($notifiable);
            case 'bid_won':
                return $this->bidWonMail($notifiable);
            default:
                return null;
        }
    }

    protected function outbidMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Vous avez été surenchéri!')
            ->greeting('Bonjour ' . $notifiable->name)
            ->line('Quelqu\'un a placé une enchère plus élevée sur ' . $this->product->title)
            ->line('Nouvelle enchère: ' . $this->bidAmount . '€')
            ->action('Voir le produit', url('/products/' . $this->product->id))
            ->line('L\'enchère se termine le ' . $this->product->auction_end_date->format('d/m/Y H:i'))
            ->line('Ne manquez pas cette opportunité!');
    }

    protected function auctionEndedMail($notifiable)
    {
        $message = (new MailMessage)
            ->subject('Enchère terminée')
            ->greeting('Bonjour ' . $notifiable->name)
            ->line('L\'enchère pour ' . $this->product->title . ' est terminée.');

        if ($this->winner) {
            $message->line('Le gagnant est: ' . $this->winner->name)
                   ->action('Voir le profil du gagnant', url('/users/' . $this->winner->id));
        }

        return $message;
    }

    protected function auctionEndedNoBidsMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Enchère terminée sans enchères')
            ->greeting('Bonjour ' . $notifiable->name)
            ->line('Malheureusement, l\'enchère pour ' . $this->product->title . ' est terminée sans aucune enchère.')
            ->line('Vous pouvez relancer une nouvelle enchère si vous le souhaitez.')
            ->action('Voir le produit', url('/products/' . $this->product->id));
    }

    protected function bidWonMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Félicitations! Vous avez gagné l\'enchère!')
            ->greeting('Félicitations ' . $notifiable->name . '!')
            ->line('Vous avez gagné l\'enchère pour ' . $this->product->title)
            ->line('Montant de votre enchère: ' . $this->bidAmount . '€')
            ->action('Voir le produit', url('/products/' . $this->product->id))
            ->line('Contactez le vendeur pour finaliser la transaction.');
    }
}
