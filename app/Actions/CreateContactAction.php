<?php


namespace App\Actions;


use App\DataTransferObjects\CreateContactData;
use App\Models\Contact;

class CreateContactAction
{
    public function __invoke(CreateContactData $data) : Contact
    {
        $contact = Contact::create([
            'name' => $data->name,
            'company' => $data->company,
            'phone' => $data->phone,
            'email' => $data->email,
        ]);

        return $contact->refresh();
    }
}
