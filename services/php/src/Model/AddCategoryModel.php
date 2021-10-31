<?php

namespace App\Model;

use App\Exception\ModelException;

class AddCategoryModel extends StandardModel
{
    /**
     * @throws ModelException
     */
    public function getName(): string
    {
        $name = trim($_POST['name'] ?? '');

        if ($name == '') {
            throw new ModelException('Название категории не может быть пустым');
        }

        $countCategories = $this->getDb()->countCategoriesWithName($name);

        if ($countCategories > 0) {
            throw new ModelException('Категория с таким названием уже существует');
        }

        return $name;
    }
}
