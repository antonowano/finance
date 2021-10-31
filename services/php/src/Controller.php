<?php

namespace App;

use App\Dto\AmountByDay;
use App\Dto\Category;
use App\Dto\Transaction;
use App\Exception\ControllerException;
use App\Exception\ModelException;
use App\Model\AddCategoryModel;
use App\Model\AddTransactionModel;
use App\Model\StandardModel;
use DateTime;

class Controller
{
    public function getAmountByDay(): array
    {
        $model = new StandardModel();

        return array_map(
            fn(AmountByDay $amount) => $amount->toArray(),
            $model->getDb()->getAmountByDay()
        );
    }

    /**
     * @throws ControllerException
     */
    public function getTransactionsPerDay(): array
    {
        $model = new StandardModel();
        $day = DateTime::createFromFormat('Y-m-d', $_GET['day']);

        if (!$day) {
            throw new ControllerException('Не указан день или указан в неверном формате. Ожидаемый формат: 1993-01-01');
        }

        return array_map(
            fn(Transaction $transaction) => $transaction->toArray(),
            $model->getDb()->getTransactionsPerDay($day)
        );
    }

    /**
     * @throws ModelException
     */
    public function addTransaction(): bool
    {
        $model = new AddTransactionModel();

        $transaction = new Transaction();
        $transaction->setValue($model->getValue());
        $transaction->setCreated($model->getCreated());
        $transaction->setCategoryId($model->getCategory()?->getId());

        $model->getDb()->addTransaction($transaction);
        return true;
    }

    /**
     * @throws ControllerException
     */
    public function deleteTransaction(): bool
    {
        $model = new StandardModel();
        $id = $_POST['id'] ?? null;

        if (!$id) {
            throw new ControllerException('Идентификатор транзакции не передан');
        }

        $model->getDb()->deleteTransaction($_POST['id']);
        return true;
    }

    public function getAllCategories(): array
    {
        $model = new StandardModel();
        return array_map(
            fn(Category $category) => $category->toArray(),
            $model->getDb()->getAllCategories()
        );
    }

    /**
     * @throws ModelException
     */
    public function addCategory(): bool
    {
        $model = new AddCategoryModel();

        $category = new Category();
        $category->setName($model->getName());

        return $model->getDb()->addCategory($category);
    }

    /**
     * @throws ControllerException
     */
    public function deleteCategory(): bool
    {
        $model = new StandardModel();
        $id = $_POST['id'] ?? null;

        if (!$id) {
            throw new ControllerException('Идентификатор категории не передан');
        }

        return $model->getDb()->deleteCategory($_POST['id']);
    }
}
