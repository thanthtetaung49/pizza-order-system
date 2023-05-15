<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class CustomerFeedbackController extends Controller
{
    // location customer feedback
    public function customerFeedback() {
        $feedbacks = Contact::orderBy('created_at', 'desc')->paginate(3);
        return view('admin.feedback.feedback', compact('feedbacks'));
    }

    // location customer feedback view
    public function feedbackView($id) {
        $viewFeedback = Contact::where('id', $id)->first();
        return view('admin.feedback.feedbackView', compact("viewFeedback"));
    }
}
