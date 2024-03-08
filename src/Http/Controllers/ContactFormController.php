<?php

namespace Laraphant\Contactform\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Laraphant\Contactform\Models\Contact;
use Laraphant\Contactform\Mail\InquiryEmail;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends BaseController
{
    public function create(){
        return view('contactform::create');
    }

    public function store(Request $request){
        $validated=$request->validate([
            'name'=>'required|max:255',
            'email'=>'required|email|max:255',
            'subject'=>'required|max:255',
            'message'=>'required',
        ]);

        Contact::create($validated);

        $admin_email=\config('contactform.admin_email');

        if($admin_email===null || $admin_email===''){
            echo 'The value of admin email not set';
        }else{
            Mail::to($admin_email)->send(new InquiryEmail($validated));
        }

        return back()->with('success','Inquiry sent,please wait for response');
    }

}
