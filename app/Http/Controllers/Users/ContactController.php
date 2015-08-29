<?php

namespace App\Http\Controllers\Users;

use Lang;
use Mail;
use App\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        
        return view('contact.index');
    }
    
    public function impressum() {
        $post = Post::where('name', 'contact')->first();
        return view('contact.about', compact('post'));
    }

    public function send(ContactRequest $request) {

        $email = \Auth::user()->email;
        $subject = $request->subject;
        $text = $request->text;
        $name = \Auth::user()->name . ' ' . \Auth::user()->last_name;;
        // send mail
        Mail::send('emails.contact', ['text' => $text, 'name' => $name], function($message) use ($email, $subject) {
            $message->from($email, 'Energien Plant Contact Form');
            $message->to('verwaltung@solar9580.de');
            $message->subject($subject);
        });

        return back()->with('success', Lang::get('admin/modal.mail.contact'));
    }

}
