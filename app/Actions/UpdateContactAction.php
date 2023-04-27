<?php


namespace App\Actions;


use App\DataTransferObjects\CreateContactData;
use App\Models\Contact;

class UpdateContactAction
{
    public function __invoke(Contact $contact, CreateContactData $data) : Contact
    {
        $contact->name = $data->name;
        $contact->company = $data->company;
        $contact->phone = $data->phone;
        $contact->email = $data->email;

        $contact->save();

        return $contact->refresh();
    }
}
