<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Carbon\Carbon;
use App\Mail\SendMail;
class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = array(
            "category"=>$request->category,
            "name"=>$request->name,
            "email"=>$request->email,
            "subject"=>$request->subject,
            "content"=>$request->content,
        );
        if($data['category'] == 'General Inquiries') {
            Mail::send('emails.confirm', $data, function($message) use ($data) {
                $message->from($data['email']);
                $message->to('info@brackets-tech.com');
                $message->subject($data['subject']);
            });
        }
        else{
            Mail::send('emails.confirm', $data, function($message) use ($data) {
                $message->from($data['email']);
                $message->to('support@brackets-tech.com');
                $message->subject($data['subject']);
            });
        }
        return back();
    }
}
