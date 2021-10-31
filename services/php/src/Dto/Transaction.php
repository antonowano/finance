<?php

namespace App\Dto;

use JetBrains\PhpStorm\ArrayShape;

class Transaction
{
    private ?int $id = null;
    private string $created;
    private float $value;
    private ?int $categoryId;
    private ?string $categoryName;

    #[ArrayShape([
        'id' => 'int|null',
        'created' => 'string',
        'value' => 'float',
        'categoryId' => 'int|null',
        'categoryName' => 'string|null',
    ])]
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'created' => $this->created,
            'value' => $this->value,
            'categoryId' => $this->categoryId,
            'categoryName' => $this->categoryName,
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

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function setCategoryId(?int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }

    public function setCategoryName(?string $categoryName): void
    {
        $this->categoryName = $categoryName;
    }
}
