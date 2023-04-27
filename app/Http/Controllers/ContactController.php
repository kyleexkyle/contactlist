<?php

namespace App\Http\Controllers;

use App\Actions\CreateContactAction;
use App\Actions\DeleteContactAction;
use App\Actions\UpdateContactAction;
use App\DataTransferObjects\CreateContactData;
use App\Http\Requests\CreateContactFormRequest;
use App\Http\Requests\UpdateContactFormRequest;
use App\Http\Resources\ContactCollection;
use App\Models\Contact;
use App\Queries\ContactIndexQuery;
use App\ViewModels\ContactFormViewModel;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ContactController extends Controller
{
    public function index(ContactIndexQuery $query) : Response
    {
        $contacts = $query->paginate(15)->withQueryString();

        return Inertia::render('Contacts/Index',[
            'contacts' => new ContactCollection($contacts),
            'filters' => \Illuminate\Support\Facades\Request::only(['search'])
        ]);
    }

    public function create() : Response
    {
        return Inertia::render('Contacts/Create');
    }

    public function store(CreateContactFormRequest $request, CreateContactAction $createContactAction) : RedirectResponse
    {

        $data = CreateContactData::fromRequest($request);

        ($createContactAction)($data);

        return redirect(route('contacts.index'));
    }

    public function edit(Contact $contact)
    {
        $this->authorize('update', $contact);

        // Render the task edit form view.
        return Inertia::render('Contacts/Edit',[
            'data' => new ContactFormViewModel($contact)
        ]);
    }

    public function update(Contact $contact, UpdateContactFormRequest $request, UpdateContactAction $updateContactAction) : RedirectResponse
    {
        $this->authorize('update', $contact);

        $data = CreateContactData::fromRequest($request);

        ($updateContactAction)($contact,$data);

        return redirect(route('contacts.index'));
    }

    public function destroy(Contact $contact, DeleteContactAction $deleteContactAction) : void
    {
        $this->authorize('delete', $contact);

        ($deleteContactAction)($contact);
    }
}
