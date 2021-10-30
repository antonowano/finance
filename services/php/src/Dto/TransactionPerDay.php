<?php

namespace App\Dto;

use JetBrains\PhpStorm\ArrayShape;

class TransactionPerDay
{
    private string $created;
    private float $value;
    private ?string $category = null;

    #[ArrayShape([
        'created' => 'string',
        'value' => 'float',
        'category' => 'string|null',
    ])]
    public function toArray(): array
    {
        return [
            'created' => $this->created,
            'value' => $this->value,
            'category' => $this->category,
        ];
    }

    public function getCreated(): string
    {
        return $this->created;
    }

    public function setCreated(string $created): void
    {
        $this->created = $created;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value): void
    {
        $this->value = $value;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): void
    {
        $this->category = $category;
    }
}
