<?php

namespace App\Http\Controllers;

use App\Models\Boarder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoarderController extends Controller
{
    public function index()
    {
        // Get all boarders and order them by most recent. Paginate the results
        // to 10 per page.
        $boarders = Boarder::orderByDesc('id')->paginate(10);
        return view('boarder.index', ['boarders' => $boarders]);
    }

    public function search(Request $request)
    {
        // Search for boarders where the name matches the search query
        // and order the results by most recent. Paginate the results
        // to 10 per page.
        $boarders = Boarder::where('name', 'like', '%' . $request->search . '%')
            ->orderByDesc('id')
            ->paginate(10);
        return view('boarder.index', ['boarders' => $boarders]);
    }

    public function create()
    {
        return view('boarder.create');
    }

    public function edit(Boarder $boarder) {
        // Show the form for editing the specified resource, passing the boarder
        // to the view.
        return view('boarder.edit', ['boarder' => $boarder]);
    }

    public function store(Request $request)
    {
        // Validate the input from the request, ensuring that the name, email, address, and
        // contact number are required and that the email is unique.
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:boarders',
            'address' => 'required',
            'contact_number' => 'required',
        ]);
        // Create a new Boarder instance and assign the validated input values to the
        // properties of the Boarder instance.
        $boarder = new Boarder($request->all());

        $boarder->save();
        return redirect('/boarders')->with('status', 'Boarder created');
    }

    public function update(Request $request, Boarder $boarder)
    {
        // Validate the input from the request, ensuring that the name, email, address,
        // contact number, and status are required.
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'contact_number' => 'required',
            'status' => 'required',
        ]);

        // Update the boarder with the validated input values.
        $boarder->update($request->all());

        // Redirect back to the previous page with a success message.
        return redirect($request->prev_url)->with('status', 'Boarder updated');
    }

    public function destroy(Boarder $boarder)
    {
        // Delete the boarder and redirect back to the previous page with a success message.
        $boarder->delete();
        return redirect()->back()->with('status', 'Boarder deleted');
    }
}
