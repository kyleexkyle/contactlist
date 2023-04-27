<?php


namespace App\DataTransferObjects;


use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\Data;

class CreateContactData extends Data
{
    public function __construct(
        public string $name,
        public string $company,
        public string $phone,
        public string $email
    ){}

    public static function fromRequest(FormRequest $request) : static
    {
        return new self(
            $request->input('name'),
            $request->input('company'),
            $request->input('phone'),
            $request->input('email')
        );
    }
}
