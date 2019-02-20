<?php

namespace App\Http\Controllers\Frontend;

use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Frontend\FrontendController;
use App\Model\Contact\Main as Contact;
use App\Model\Contact\Message as Message;


use App\Mail\NewUserWelcome;
use App\Mail\ReplyBackToClients;

//========================== Use Mail
use Illuminate\Support\Facades\Mail;
use App\Mail\Notification;

class ContactUsController extends FrontendController
{
    public function index($locale = "en", $slug = '') {
        
        $data = Contact::select(
            'id', 
            'slug', 
            'parent_id',
            'has_own_info',
            $locale.'_title as title',
            $locale.'_contact_person as contact_person',
            $locale.'_position as position',
            $locale.'_address as address', 
            'website',
            'phone',
            'email',
            'google_link',
            'lat', 
            'lng'

        )->where(['slug'=>$slug, 'is_published'=>1])->first(); 


        
        if($data){
            $children = Contact::select('id', $locale.'_title as title', 'slug', 'has_sub')->where(['parent_id'=>$data->id, 'is_published'=>1])->orderBy('sub_data_order', 'ASC')->get(); 
            
            if($data->has_own_info == 0){
                if(count($children) > 0){
                    foreach($children as $row){
                        return $this->index($locale, $row->slug);
                    }
                }
            }

            $title = '';
            $subActive = $data->slug;
            $parent = [];
            $siblings = [];

            //Check if having parent
            if(!is_null($data->parent_id)){
                $parent = Contact::select(
                    'id', 
                    $locale.'_title as title'
                )->where(['id'=>$data->parent_id, 'is_published'=>1])->first();
                if($parent){
                    $title = $parent->title; 
                    $siblings = Contact::select('id', $locale.'_title as title', 'slug', 'has_sub')->where(['parent_id'=>$parent->id, 'is_published'=>1])->orderBy('sub_data_order', 'ASC')->get(); 
                } 
            }
            
            
            
            $defaultData = $this->defaultData($locale);
            return view('frontend.contact.index', 
                    [
                        'locale'=>$locale, 
                        'subActive' => $subActive,
                        'defaultData'=>$defaultData, 
                        'title' => $title,
                        'data' => $data, 
                        'parent' => $parent,
                        'siblings' => $siblings,
                        'children' => $children
                    ]);
        }else{
             return view('errors.404');
        }
    }


    public function sendMessage(Request $request , $locale = "en")  {
        $defaultData = $this->defaultData($locale);
        $slug = $request->input('slug');

        $data = array(
                    'name' =>   $request->input('name'),
                    'organization' =>  $request->input('organization'),
                    'position' =>  $request->input('position'),
                    'contact_id' =>  $request->input('contact_id'),
                    'phone' =>  $request->input('phone'),
                    'purpose' =>  $request->input('subject'), 
                    'email' =>  $request->input('email'),
                    'message' =>  $request->input('message') 
                );
         Session::flash('invalidData', $data );
         Validator::make(
                        $request->all(), 
                        [
                            'name' => 'required',
                            'organization' => 'required',
                            'position' => 'required',
                            'subject' => 'required',
                            'email' => 'required|email',
                            'message' => 'required',
                            'g-recaptcha-response' => 'required',
                        ],
                        [
                            'name.required' => __('web.errorname'),
                            'organization.required' => __('web.errororganization'),
                            'position.required' => __('web.errorposition'),
                            'subject.required' => __('web.errorsubject'),
                            'email.required' => __('web.erroremail'),
                            'email.email' => __('web.incorrectemail'),
                            'message.required' => __('web.errormessage'),
                            'g-recaptcha-response.required' => __('web.errorrecaptcha'),
                        ]

                    )->validate();
        $id=Message::insertGetId($data);

        $notification = [
                    'name' =>   $request->input('name'),
                    'organization' =>  $request->input('organization'),
                    'position' =>  $request->input('position'),
                    'contact_id' =>  $request->input('contact_id'),
                    'phone' =>  $request->input('phone'),
                    'subject' =>  $request->input('subject'), 
                    'email' =>  $request->input('email'),
                    'message' =>  $request->input('message')
            ];
	$contact = Contact::select('id', 'email')->where('slug', $slug)->first();
        if($contact->email){
           Mail::to($contact->email)->send(new Notification('Message From Visitor', $notification, 'emails.contact.contact')); 
        }
        // if(env('MAIL_RECIEVE_ADDRESS')){
        //   Mail::to(env('MAIL_RECIEVE_ADDRESS'))->send(new Notification('Message From Visitor', $notification, 'emails.contact.contact'));  
        // }
        
        if($request->input('email')){
            Mail::to($request->input('email'))->send(new Notification('Thanks for your apply', $notification, 'emails.contact.thanks'));
        }        
        Session::flash('msg', __('web.contact-successful-sent') );
        return redirect(route('contact-us', ['locale'=>$locale,'type'=>$slug]));
    }



}
