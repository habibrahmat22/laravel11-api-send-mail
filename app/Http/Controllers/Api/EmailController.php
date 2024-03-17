<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Email;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $details = [
            'to' => $request->to,
            'subject' => $request->subject,
            'body' => $request->body
        ];
    
        try {
            // Mengirim email ke mailtrap
            Mail::send('emails.simpleEmail', ['to' => $details['to'],'body' => $details['body']], function ($message) use ($details) {
                $message->to($details['to'])
                        ->subject($details['subject']);
            });
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to send email.', 'error' => $e->getMessage()], 500);
        }
    
        // Menyimpan detail email ke database
        Email::create($details);
    
        return response()->json(['message' => 'Email sent successfully.']);
    }
}
