<?php

namespace App\Dto;

use JetBrains\PhpStorm\ArrayShape;

class AmountByDay
{
    private string $date;
    private float $value;

    #[ArrayShape([
        'date' => 'string',
        'value' => 'float',
    ])]
    public function toArray(): array
    {
        return [
            'date' => $this->date,
            'value' => $this->value,
        ];
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value): void
    {
        $this->value = $value;
    }
}
