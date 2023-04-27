<?php


namespace App\Actions;


use App\Models\Contact;

class DeleteContactAction
{
    public function __invoke(Contact $contact) : bool
    {
        return $contact->delete();
    }
}
