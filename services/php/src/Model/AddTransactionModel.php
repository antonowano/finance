<?php

namespace App\Model;

use App\Dto\Category;
use App\Exception\ModelException;

class AddTransactionModel extends StandardModel
{
    /**
     * @throws ModelException
     */
    public function getValue(): int
    {
        if (empty($_POST['value'])) {
            throw new ModelException('Транзакция не может быть нулевой');
        }

        return $_POST['value'];
    }

    /**
     * @throws ModelException
     */
    public function getCreated(): \DateTime
    {
        if (empty($_POST['created'])) {
            throw new ModelException('Дата не выбрана');
        }

        $datetime = \DateTime::createFromFormat('Y-m-d\TH:i', $_POST['created']);

        if (!$datetime) {
            throw new ModelException('Невозможно преобразовать дату для добавления в базу данных');
        }

        return $datetime;
    }

    /**
     * @throws ModelException
     */
    public function getCategory(): ?Category
    {
        $categories = $this->getDb()->getAllCategories();

        if (empty($_POST['category_id'])) {
            return null;
        }

        // ищем категорию с выбранным id
        $matchingCategories = array_filter($categories, function ($category) {
            return ($category->getId() == $_POST['category_id']);
        });
        // отбрасываем ключи
        $matchingCategories = array_values($matchingCategories);

        if (!count($matchingCategories)) {
            throw new ModelException('Выбранная категория не найдена');
        }

        // берем первую найденную категорию
        return $matchingCategories[0];
    }
}
