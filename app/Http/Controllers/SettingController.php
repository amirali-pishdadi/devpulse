<?php

namespace App\Http\Controllers;

use App\Helper\EmailSender;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function sendEmail(Request $request  )
    {
        $validatedData = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $subject = $request->input('subject');
        $message = $request->input('message');
        // Create the email content
        $emailBody = view('email.contact', compact('name', 'email', 'subject', 'message'))->render();

        // Send the email
        $sent = EmailSender::sendEmail('amirpishdadi4@gmail.com', $validatedData["subject"], $emailBody);


        if ($sent) {
            return redirect()->back()->with('message', 'پیام شما با موفقیت ارسال شد.');

        } else {
            // return redirect()->back()->with('message', 'ارسال پیام با خطا رو به رو شد!');
            return response()->json([$sent , $name , $message , $subject ,$email]);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
