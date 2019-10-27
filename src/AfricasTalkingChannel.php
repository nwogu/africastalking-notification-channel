<?php

namespace Nwogu\AfricasTalking;

use AfricasTalking\SDK\AfricasTalking;
use Illuminate\Notifications\Notification;
use Nwogu\AfricasTalking\AfricasTalkingMessage;

class AfricasTalkingChannel
{

    /**
     * @var AfricasTalking
     * 
     */
    protected $at;

    /**
     * @param AfricasTalking
     */
    public function construct(AfricasTalking $at)
    {
        $this->at = $at;
    }
    /**
     * Send the given notification as SMS via Africa's Talking.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toAfricasTalking($notifiable);

        $getPhoneNumber = "routeNotificationForAfricasTalking";

        $phoneNumber = method_exists($notifiable, $getPhoneNumber)
                ? $notifiable->$getPhoneNumber($notification) : $notifiable->phone_number;

        return $this->at->send([
            "to" => $phoneNumber,
            "message" => $message->getContent(),
            "from" => $message->getSender() ?? config("services.africastalking.from", null)
        ]);;
    }
}

