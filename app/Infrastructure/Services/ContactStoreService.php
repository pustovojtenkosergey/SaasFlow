<?php

namespace App\Infrastructure\Services;

use App\Infrastructure\Domain\DTO\ContactData;
use App\Infrastructure\Repo\ContactRepository;
use App\Models\Contact;

class ContactStoreService
{

    public function __construct(
        private ContactRepository $contactRepository,
    ) {
    }

    public function execute(ContactData $data)
    {
        $contact = new Contact($data->toArray());

        $similarContact = $this->contactRepository->getSimilar($contact);
        if (null === $similarContact) {
            $contact->save();
            return $contact;
        }
        return $similarContact;
    }

}
