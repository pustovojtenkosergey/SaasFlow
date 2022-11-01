<?php

namespace App\Infrastructure\Builders;

use App\Infrastructure\Domain\DTO\ContactData;
use Illuminate\Support\Arr;

class ContactDataBuilder implements DataBuilder
{

    public function build(array $data): ContactData
    {
        return new ContactData(
            name: (string) Arr::get($data, 'name'),
            company_name: (string) Arr::get($data, 'company_name'),
            address_line_1: (string) Arr::get($data, 'address_line_1'),
            address_line_2: (string) Arr::get($data, 'address_line_2'),
            address_line_3: (string) Arr::get($data, 'address_line_3'),
            city: (string) Arr::get($data, 'city'),
            state: (string) Arr::get($data, 'state'),
            zip: (string) Arr::get($data, 'zip'),
            country: (string) Arr::get($data, 'country'),
            phone: (string) Arr::get($data, 'phone'),
            email: (string) Arr::get($data, 'email'),
            vat: (string) Arr::get($data, 'vat', ''),
            eori_number: (string) Arr::get($data, 'eori_number'),
            ioss_number: (string) Arr::get($data, 'ioss_number'),
            id_number: (string) Arr::get($data, 'id_number'),
            extra_fields: json_encode(Arr::get($data, 'extra_fields', [])),
        );
    }
}
