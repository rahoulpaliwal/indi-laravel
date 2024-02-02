<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function capture(Request $request)
    {
        $capturedString = $request->input('capturedString');

        // Assuming you want to store it in the session
        $concatenatedString = session('concatenatedString', '') . $capturedString.',';
        session(['concatenatedString' => $concatenatedString]);

        return response()->json(['result' => 'success']);
    }

    public function submit()
    {
        // Retrieve the concatenated string from the session
        $concatenatedString = session('concatenatedString', '');

        // Explode the string into an array, sort it, and implode it back
        $sortedStrings = implode(', ', collect(explode(',', $concatenatedString))->sort()->toArray());
        $sortedStrings = ltrim($sortedStrings,', ');
        return response()->json(['concatenatedString' => $concatenatedString, 'sortedStrings' => $sortedStrings]);
    }

    public function clearSession()
    {
        // Clear the session
        session(['concatenatedString' => '']);
        
        return redirect()->back();
    }
}
