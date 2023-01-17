<?php

namespace App\Http\Controllers;

use App\Models\mails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



use Mail;
class MailController extends Controller
{
    public function txt_mail()
    {        
        $data = array('name' => "pofitesting");
        Mail::send(['text' => 'mail'], $data, function ($message)
        {
            $message->to('mubarak@pofitec.com', 'Mubarak')
                ->subject('testing purpose of email');
            $message->from('pofitesting2022@gmail.com', 'pofitesting');
        });
        echo "Successfully sent the email";             
    } 

    public function html_mail()
    {
        $info = array(
            'name' => "pofitesting"
        );
        Mail::send('mail', $info, function ($message)
        {           
            $message->to('mubarak@pofitec.com', 'Mubarak')
                ->subject('testing purpose of email');
            $message->from('pofitesting2022@gmail.com', 'pofitesting');
        });
        echo "Successfully sent the email";
    }

    public function attached_mail()
    {  
        
        $info = array('name' => "pofitesting");
        Mail::send('mail', $info, function ($message)
        {
            $message->to('mubarak@pofitec.com', 'Mubarak')
            ->subject('testing purpose of email');

            $message->attach('mubarak/LARAVEL/blogs/public/blog/images/no_image.jpeg');
           
            $message->from('pofitesting2022@gmail.com', 'pofitesting');
        });
        echo "Successfully sent the email";
    }
   
}



// $message -> subject('Laravel Tutorial');
// $message ->from('testuser@example.com', 'anyname');
// $message ->to('alex@example.com', 'Alex');

// Other commonly used methods are:

// $message ->sender('testuser@example.com', 'anyname');
// $message ->returnPath('testuser@example.com');
// $message ->cc('testuser@example.com', 'anyname');
// $message ->bcc('neha@example.com', 'Neha');
// $message ->replyTo('testuser@example.com', 'anyname');
// $message ->priority(4);
