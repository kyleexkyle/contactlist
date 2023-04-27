<?php


namespace App\Queries;


use App\Models\Contact;
use Spatie\QueryBuilder\QueryBuilder;

class ContactIndexQuery extends QueryBuilder
{
    public function __construct()
    {
        $contact = Contact::query()
                ->when(\Illuminate\Support\Facades\Request::input('search'),function ($query,$search){
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('company', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })
                ->mine()
                ->orderBy('created_at','desc');

        parent::__construct($contact);
    }
}
