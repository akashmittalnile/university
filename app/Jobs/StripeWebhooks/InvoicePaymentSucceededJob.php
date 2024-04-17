<?php

namespace App\Jobs\StripeWebhooks;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\WebhookClient\Models\WebhookCall;
use App\Models\Webhookpayment;
use App\Models\User;

class InvoicePaymentSucceededJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var \Spatie\WebhookClient\Models\WebhookCall */
    public $webhookCall;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    public function handle()
    {
        $charge = $this->webhookCall->payload['data']['object'] ;
        // do your work here
        echo "<pre>";
        print_r($charge);
        echo "</pre>";
        die();
        $user = User::where('stripe_id',$charge['customer'])->first();
        if($user)
        {
            $payment = new Webhookpayment();
            $payment->amount = ($charge['amount_paid'] / 100) ;
            $payment->userid = $user->id;
            $payment->stripe_price = $this->webhookCall->payload['data']['object']['lines']['data'][0]['plan']['id'];
            $payment->subscription = $this->webhookCall->payload['data']['object']['lines']['data'][0]['subscription'];
            $payment->subscriptionitem = $this->webhookCall->payload['data']['object']['lines']['data'][0]['subscription_item'];
            $payment->created_at = date('Y-m-d H:i:s');
            $payment->updated_at = date('Y-m-d H:i:s');
            $payment->save();
        }
        
        
        // you can access the payload of the webhook call with `$this->webhookCall->payload`
    }
}
