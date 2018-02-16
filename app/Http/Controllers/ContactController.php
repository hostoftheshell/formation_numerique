<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Post;
use Illuminate\Http\Request;
use App\Notifications\InboxMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;

class ContactController extends Controller
{
    public function __construct()
    {   
            view()->composer(
                'partials.menu', function ($view) {
                    $types = Post::pluck('post_type', 'id')->unique(); 
                    $view->with('types', $types); 
                }
            );
    }
    public function show()
    {
        return view('front.contact');
    }

    public function mailToAdmin(ContactFormRequest $message, Admin $admin)
    {           
        //send the admin an notification
        $admin->notify(new InboxMessage($message));
        // redirect the user back
        return redirect()->back()->with('message', 'thanks for the message!');
    }

}
