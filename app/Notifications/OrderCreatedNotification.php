<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Broadcast;

class OrderCreatedNotification extends Notification
{
    use Queueable;
    protected $order;
    protected $address;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order=$order;
        $this->address=$this->order->billingAddress;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
        $channels=['database'];
        if($notifiable->notification_preferences['order_created']['sms'] ?? false){
            $channels[]='vonage';
        }
        if($notifiable->notification_preferences['order_created']['mail'] ?? false){
            $channels[]='mail';
        }
        if($notifiable->notification_preferences['order_created']['broadcast'] ?? false){
            $channels[]='broadcast';
        }
        return $channels;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        return (new MailMessage)
                    ->subject("New Order (#{$this->order->number})")
                    ->greeting("Hi {$notifiable->name},")
                    ->line("{$this->address->name} has created a new order (#{$this->order->number}) from {$this->address->country_name}.")
                    ->action('View Order', url('/dashboard'))
                    ->line('Thank you for using our application!');
    }
    public function toDatabase($notifiable){

        return [
            'body'=>"{$this->address->name} has created a new order (#{$this->order->number}) from {$this->address->country_name}.",
            'icon'=>'fas fa-envelope',
            'url'=>route('dashboard'),
            'order_id'=>$this->order->id,
        ];
    }

    public function toBroadcast($notifiable){

        return new BroadcastMessage([
            'body'=>"{$this->address->name} has created a new order (#{$this->order->number}) from {$this->address->country_name}.",
            'icon'=>'fas fa-envelope',
            'url'=>route('dashboard'),
            'order_id'=>$this->order->id,
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
