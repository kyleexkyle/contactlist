<?php


namespace App\ViewModels;


use App\Models\Contact;
use Spatie\ViewModels\ViewModel;

class ContactFormViewModel extends ViewModel
{
    public function __construct(public ?Contact $contact = null)
    {
        $this->contact = $this->contact ?? new Contact();
    }
}
