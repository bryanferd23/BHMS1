<?php

namespace App\Http\Controllers;

use to;
use App\Models\Boarder;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all payments with their associated boarder and
        // order them by most recent. Paginate the results
        // to 10 per page.
        $payments = Payment::with('boarder')->orderByDesc('created_at')->paginate(10);
        // Pass the payments to the view
        return view('payment.index', ['payments' => $payments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('payment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input from the request
        // Ensure the email exists in the boarders table
        // and the amount is a valid number
        $request->validate([
            'email' => 'required|exists:boarders,email',
            'amount' => 'required|gt:0',
        ]);

        // Create a new Payment instance
        $payment = new Payment([
            'boarder_id' => Boarder::where('email', $request->email)->first()->id,
            'amount' => $request->amount,
        ]);

        // Save the payment to the database
        $payment->save();

        // Redirect back to the previous page with a success message
        return redirect($request->prev_url)->with('status', 'Payment created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        return view('payment.edit', ['payment' => $payment, 'boarder' => $payment->boarder]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        // Validate the input, then update the payment's amount and boarder_id
        // Save the changes and redirect back to the payments list with a success message
        $request->validate([
            'email' => 'required|exists:boarders,email',
            'amount' => 'required|gt:0',
        ]);
        // Update the payment's amount and boarder_id
        // Find the boarder id associated with the given email
        // and save the changes to the payment
        $payment->amount = $request->amount;
        $payment->boarder_id = Boarder::where('email', $request->email)->first()->id;
        $payment->save();
        return redirect('/payments')->with('status', 'Payment updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Payment $payment)
    {
        // Delete the payment and redirect back to the previous page
        // with a success message
        $payment->delete();
        return redirect()->back()->with('status', 'Payment deleted');
    }

    public function search(Request $request)
    {
        // Search for payments where the boarder's name or email
        // matches the search query. Paginate the results.
        // Pass the payments to the view.
        $payments = Payment::with('boarder')
        ->whereHas('boarder', function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->search}%")
                    ->orWhere('email', 'like', "%{$request->search}%");
        })
        ->orderByDesc('created_at')
        ->paginate(10);

        return view('payment.index', ['payments' => $payments]);
    }
}
