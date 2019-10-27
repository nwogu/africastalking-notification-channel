# Laravel Notification Channel For Africa's Talking 
Send SMS Notifications Via Africa's Talking API.   

## Installation.

Install via composer: 

```composer require nwogu/africastalking-notification-channel```

## Set Up:

Add  your ```username``` and ```api_key``` in your services config file.  
```
'africastalking' => [
        'username' => 'YOUR_AT_USERNAME_HERE',
        'key' => 'YOUR_AT_API_KEY_HERE',
        'from' => null  //Your registered short code or alphanumeric, defaults to AFRICASTKNG.
    ],
```  
You can generate your api key from your AT dashboard, if you don't have it.

Add the ```routeNotifcationForAfricasTalking``` method on your notifiable Model. If this is not added,
the ```phone_number``` field will be automatically used.  

```
<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Route notifications for the Africas Talking channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForAfricasTalking($notification)
    {
        return $this->phone;
    }
}
```

## Usage:  

Create your notification and define a ```toAfricasTalking``` method on the notification class.  

This method will receive a $notifiable entity and should return a   
```Nwogu\AfricasTalking\AfricasTalkingMessage``` instance:

```

    ...

    use Nwogu\AfricasTalking\AfricasTalkingChannel;
    use Nwogu\AfricasTalking\AfricasTalkingMessage;

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [AfricasTalkingChannel::class];
    }


    /**
    * Get the AfricasTalking / SMS representation of the notification.
    *
    * @param  mixed  $notifiable
    * @return AfricasTalkingMessage
    */
    public function toAfricasTalking($notifiable)
    {
        return (new AfricasTalkingMessage)
                    ->content('Your SMS message content');
    }
```  

