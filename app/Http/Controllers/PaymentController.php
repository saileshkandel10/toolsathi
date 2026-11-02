<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function checkout(Request $request, Plan $plan)
    {
        $gateway = $request->input('gateway', 'esewa');
        
        // Create pending payment & redirect to gateway simulation or actual SDK
        $payment = Payment::create([
            'user_id' => auth()->id(),
            'plan_id' => $plan->id,
            'amount' => $plan->price,
            'gateway' => $gateway,
            'transaction_id' => 'TXN-' . Str::upper(Str::random(10)),
            'status' => 'pending'
        ]);

        return view('payments.checkout', compact('plan', 'payment', 'gateway'));
    }

    public function verify(Request $request, Payment $payment)
    {
        // Server-side verification simulation
        $payment->update(['status' => 'completed']);

        // Activate subscription
        Subscription::updateOrCreate(
            ['user_id' => $payment->user_id],
            [
                'plan_id' => $payment->plan_id,
                'status' => 'active',
                'expires_at' => now()->addDays($payment->plan->duration_days ?? 30)
            ]
        );

        return redirect()->route('user.dashboard')->with('success', 'Payment verified! Premium subscription activated successfully.');
    }
}
