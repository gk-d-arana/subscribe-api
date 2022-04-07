<?php

namespace App\Http\Controllers;

use App\Models\Subscribtion;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class WebsiteController extends Controller
{
    //function to subscribe to website
    public function subscribe(Request $request)
    {
        //validate request
        $request->validate([
            'email' => 'required|email',
            'website_id' => 'required|integer',
        ]);

        //get website
        $website = Website::find($request->website_id);

        //check if website exists
        if (!$website) {
            return response()->json([
                'message' => 'Website not found',
            ], 404);
        }

        //check if user is already subscribed

        $subscribtion = $website->subscribtions()->where('email', $request->email)->first();


        //if user is already subscribed
        if ($subscribtion) {
            return response()->json([
                'message' => 'User already subscribed',
            ], 400);
        }

        //create new subscribtion

        $subscribtion = Subscribtion::create($request->all());

        //send email to subscriber
        $name = $website->name;

        $this->sendEmail($subscribtion->email, $name);


        //return response
        return response()->json([
            'message' => 'User subscribed',
        ], 200);
    }


    //function to send email to subscriber
    public function sendEmail($email, $name)
    {
        $title = "Welcome To " . $name;
        $body = "You have been subscribed to " .$name . " successfully!";
        $details = [
            "title" => $title,
            "body" => $body
        ];
        //send email
        Mail::to($email)->send(new \App\Mail\SubscribeMail($details));

    }

    //function to get all posts of website
    public function getPosts($id)
    {

        $website = Website::findOrFail($id);
        //get posts
        $posts = cache()->remember('website-posts', 60*60*24, function () use($website) {
            return $website->posts()->get();
        });

        //return response
        return response()->json([
            'posts' => $posts,
        ], 200);
    }


}
