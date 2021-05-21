<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Mail\ContactUs;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    // Create Contact Form
    public function createForm() {
        return view('contact');
      }
  
      // Store Contact Form data
      public function ContactUsForm(Request $request) {
  
          // Form validation
          $this->validate($request, [
              'name' => 'required',
              'email' => 'required|email',
              'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
              'subject'=>'required',
              'message' => 'required'
           ]);
  
          //  Store data in database
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();
  
        //  Send mail to admin
        Mail::to(env('MAIL_TO_ADDRESS'))->send(new ContactUs($contact));
        toast('The message has been sent, expect a response soon','success','top-right')->showCloseButton();
        return back();
      }
}
