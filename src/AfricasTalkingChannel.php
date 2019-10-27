<?php

namespace Nwogu\AfricasTalking;

use Illuminate\Notifications\Notification;

class AfricasTalkingChannel
{
    /**
     * Route Notification Method
     */
    protected static $getPhoneNumber = "routeNotificationForAfricasTalking";

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

        $phoneNumber = method_exists($notifiable, static::$getPhoneNumber)
                ? $notifiable->{static::$getPhoneNumber}($notification) 
                : $notifiable->phone_number;

        return app("at")->send([
            "to" => $phoneNumber,
            "message" => $message->getContent(),
            "from" => $message->getSender() ?? 
                config("services.africastalking.from", null) ]);
    }
}

