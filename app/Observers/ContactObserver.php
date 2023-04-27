<?php

namespace App\Observers;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class ContactObserver
{
    public function creating(Contact $contact)
    {
        if (Auth::check()) {
            $contact->user_id = auth()->user()->id;
        }
    }
}
