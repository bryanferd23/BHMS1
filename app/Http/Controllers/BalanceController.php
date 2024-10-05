<?php

namespace App\Http\Controllers;

use App\Models\Boarder;
use App\Models\Payment;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all boarders and order them by most recent. Paginate the results
        // to 10 per page.
        $boarders = Boarder::query()->orderByDesc('id')->paginate(10);

        // Iterate over the boarders and for each one, calculate the total
        // payments made and the balance based on the payment history.
        foreach ($boarders as $boarder) {
            $boarder->total = $boarder->payments->sum('amount');

            // Calculate the balance based on the difference in days between the creation date and now
            $daysDifference = $boarder->created_at->diffInDays(now());
            $boarder->balance = $daysDifference * 100 - $boarder->total;
        }

        return view('balance.index', ['boarders' => $boarders]);
    }

    public function search(Request $request)
    {
        // Search for boarders where the name or email matches the search query
        // and order the results by most recent. Paginate the results
        // to 10 per page.
        $boarders = Boarder::query()
        ->where(function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->search}%")
                    ->orWhere('email', 'like', "%{$request->search}%");
        })
        ->orderBy('id')
        ->paginate(10);
        
        // Iterate over the boarders and for each one, calculate the total
        // payments made and the balance based on the payment history.
        foreach ($boarders as $boarder) {
            $boarder->total = $boarder->payments->sum('amount');
            // Calculate the balance based on the difference in days between the creation date and now
            $boarder->balance = (int)($boarder->created_at->diffInDays(now()) * 100) - $boarder->total;
        }
        // Pass the boarders to the view
        return view('balance.index', ['boarders' => $boarders]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
