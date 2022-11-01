<?php

namespace App\Infrastructure\Repo;

use App\Models\Contact;

class ContactRepository
{

    /**
     * @param Contact $contact
     * @return Contact|null
     */
    public function getSimilar(Contact $contact): ?Contact
    {
        return Contact::where('name', $contact->name)
                      ->where('company_name', $contact->company_name)
                      ->where('country', $contact->country)
                      ->where('phone', $contact->phone)
                      ->where('email', $contact->email)
                      ->first();
    }
}
