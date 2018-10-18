<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactEnquiryRequest;
use App\Http\Requests\ContactFeedbackRequest;
use App\Http\Requests\TradeContactRequest;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactEnquiry;
use App\Mail\ContactFeedback;
use App\Mail\TradeRequest;

use GetCandyClient;
use Session;

class ContactController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function enquiry(ContactEnquiryRequest $request)
    {
        Mail::to(env('MAIL_TO_ADDRESS', ''))
            ->send(new ContactEnquiry($request->all()));

        return redirect()->back()->with('success', 'Email successfully sent');
    }

    public function feedback(ContactFeedbackRequest $request)
    {
        Mail::to(env('MAIL_TO_ADDRESS', ''))
            ->send(new ContactFeedback($request->all()));

        return redirect()->back()->with('success', 'success', 'Email successfully sent');
    }

    public function trade(TradeContactRequest $request)
    {
        Mail::to(env('MAIL_TO_ADDRESS', ''))
            ->send(new TradeRequest($request->all()));

        return redirect()->back()->with('success', 'success', 'Email successfully sent');
    }
}
