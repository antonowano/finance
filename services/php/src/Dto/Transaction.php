<?php

namespace App\Dto;

use DateTime;

class Transaction
{
    private ?int $id = null;
    private DateTime $created;
    private float $value;
    private ?Category $category;

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'created' => $this->created->format('Y-m-d\TH:i:s'),
            'value' => $this->value,
            'category' => $this->category?->toArray(),
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreated(): DateTime
    {
        return $this->created;
    }

    public function setCreated(DateTime $created): void
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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): void
    {
        $this->category = $category;
    }
}
