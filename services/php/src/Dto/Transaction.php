<?php

namespace App\Dto;

use DateTime;
use JetBrains\PhpStorm\ArrayShape;

class Transaction
{
    private ?int $id = null;
    private DateTime $created;
    private float $value;
    private ?int $categoryId;

    #[ArrayShape([
        'id' => 'int|null',
        'created' => 'string',
        'value' => 'float',
        'category_id' => 'int|null',
    ])]
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'created' => $this->created->format('Y-m-d\TH:i:s'),
            'value' => $this->value,
            'category_id' => $this->categoryId,
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
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

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function setCategoryId(?int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }
}
