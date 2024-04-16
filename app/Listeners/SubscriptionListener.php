<?php

namespace App\Listeners;

use App\Mail\WelcomeClientMail;
use App\Models\Subscription;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SubscriptionListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $dateEnd = '';

        switch($event->plan) {
            case 'day':
                $dateEnd = $this->addTime('+1 day');
                break;
            case 'weekly':
                $dateEnd = $this->addTime('+7 days');
                break;
            case 'monthly':
                $dateEnd = $this->addTime('+1 month');
                break;
            case 'quarterly':
                $dateEnd = $this->addTime('+3 months');
                break;
            case 'semiannually':
                $dateEnd = $this->addTime('+6 months');
                break;
            case 'annually':
                $dateEnd = $this->addTime('+1 year');
                break;
        }

        $subscription = new Subscription();
        $subscription->client_id = $event->client->id;
        $subscription->membership_end = $dateEnd;
        $subscription->plan = $event->plan;
        $subscription->save();

        Mail::send(new WelcomeClientMail(
            $event->client->email,
            $event->client->name,
            date('Y-m-d H:i:s'),
            $subscription->membership_end,
            $subscription->plan
        ));
    }

    private function addTime(string $period)
    {
        return date('Y-m-d H:i:s', strtotime($period, strtotime(date('Y-m-d H:i:s'))));
    }
}
