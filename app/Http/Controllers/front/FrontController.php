<?php

namespace App\Http\Controllers\front;


use App\Blogpost;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class FrontController extends Controller
{

    public function index()
    {

        return view('front.index');
    }

    public function presentation()
    {
        return view('front.presentation');
    }

    public function info_telecom()
    {
        return view('front.info_telecom');
    }

    public function securite_electronique()
    {
        return view('front.securite_electronique');
    }

    public function electricite_batiment()
    {
        return view('front.electricite_batiment');
    }

    public function fibre_optique()
    {
        return view('front.fibre_optique');
    }

    public function etude_assistance()
    {
        return view('front.etude_assistance');
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function blog()
    {

        $mypost = Blogpost::where('status', 1)->get();
        return view("front.blog", compact('mypost'));
    }

    public function article($id)
    {
        $post=Blogpost::find($id);

        return view("front.article", compact('post'));
    }

    public function send_contact(Request $request)

    {
        //dd($request);
        $toEmail = 'chiheb@1waycom.com';
        $emailTitle = $request['subject'];
        $source = $request['email'];

        Mail::send('mail.contact', ['request' => $request], function ($message) use ($toEmail, $emailTitle, $source) {
            $message->from($source);
            $message->to($toEmail, '')->subject($emailTitle);
        });


        return redirect()->route('contact');


    }
}
