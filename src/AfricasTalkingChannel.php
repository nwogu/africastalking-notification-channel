<?php

namespace Nwogu\AfricasTalking;

use AfricasTalking\SDK\AfricasTalking;
use Illuminate\Notifications\Notification;
use Nwogu\AfricasTalking\AfricasTalkingMessage;

class AfricasTalkingChannel
{
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

        return $this->sendNotification($message, $phoneNumber);
    }

    /**
     * Send Notification Via Africa's Talking
     * 
     * @param string|array $message
     * @param string $phoneNumber
     * 
     * @return void
     */
    private function sendNotification(AfricasTalkingMessage $message, $phoneNumber)
    {
        $at = new AfricasTalking(
            config("services.africastalking.username"),
            config("services.africastalking.key")
        );

        $at->sms()->send([
            "to" => $phoneNumber,
            "message" => $message->getContent(),
            "from" => $message->getSender() ?? config("services.africastalking.from", null)
        ]);
    }
}

