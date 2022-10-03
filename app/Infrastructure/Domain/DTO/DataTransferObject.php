<?php

declare(strict_types=1);


namespace App\Infrastructure\Domain\DTO;

abstract class DataTransferObject
{

    public function toArray(mixed $obj = null): mixed
    {
        if (null === $obj) {
            $obj = clone $this;
        }

        if (!is_object($obj) && !is_array($obj)) {
            return $obj;
        }

        if (is_object($obj)) {
            $obj = (array) $obj;
        }

        foreach ($obj as $key => $item) {
            if (is_object($item) || is_array($item)) {
                $obj[$key] = $this->toArray($item);
            }
        }
        return $obj;
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }


}
