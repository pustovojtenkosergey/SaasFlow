<?php

declare(strict_types=1);


namespace App\Infrastructure\Domain\DTO;

class ContactData extends DataTransferObject
{

    public function __construct(
        public ?string $name,
        public ?string $company_name,
        public ?string $address_line_1,
        public ?string $address_line_2,
        public ?string $address_line_3,
        public ?string $city,
        public ?string $state,
        public ?string $zip,
        public ?string $country,
        public ?string $phone,
        public ?string $email,
        public ?string $vat,
        public ?string $eori_number,
        public ?string $ioss_number,
        public ?string $id_number,
        public ?string $extra_fields,
    ) {
    }

//    public static function createFromAddressFieldsModel(AddressField $addressField): self
//    {
//
//        return new self(
//            name: $addressField->name,
//            company_name: $addressField->company_name,
//            address_line_1: $addressField->address_line_1,
//            address_line_2: $addressField->address_line_2,
//            address_line_3: $addressField->address_line_3,
//            city: $addressField->city,
//            state: $addressField->state,
//            zip: $addressField->zip,
//            country: $addressField->country,
//            phone: $addressField->phone,
//            email: $addressField->email,
//            vat: $addressField->vat,
//            eori_number: $addressField->eori_number,
//            ioss_number: $addressField->ioss_number,
//            id_number: $addressField->id_number,
//            extra_fields: json_decode($addressField->extra_fields, true),
//        );
//    }
}
