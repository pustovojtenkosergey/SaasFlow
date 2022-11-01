<?php

declare(strict_types=1);


namespace App\Infrastructure\Domain\DTO;


use App\Models\Contact;

class PackageDto extends DataTransferObject
{

    public function __construct(
        public bool               $is_test = true,
        public string             $reference = '',
        public ?Contact $contact = null,
        public ?PackageServiceDTO $service = null,
        public ?PackageDetailsDto $details = null,
        public array              $items = []
    ) {
    }

    public function toDataArray(): array
    {
        return [
            'is_test' => $this->is_test,
            'reference' => $this->reference,
            'service' => (array)$this->service,
            'contact' => $this->contact->toArray(),
            'details' => (array)$this->details,
            'items' => $this->items
        ];
    }

    public function toDataJson(): string
    {
        return json_encode($this->toDataArray());
    }
}
