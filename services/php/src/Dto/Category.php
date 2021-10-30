<?php

namespace App\Dto;

use JetBrains\PhpStorm\ArrayShape;

class Category
{
    private ?int $id = null;
    private string $name;

    #[ArrayShape([
        'id' => 'int|null',
        'name' => 'string',
    ])]
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
