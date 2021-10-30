<?php

namespace App;

use App\Dto\Category;
use App\Dto\Transaction;
use App\Exception\ControllerException;
use App\Exception\ModelException;
use App\Model\AddTransactionModel;
use App\Model\StandardModel;
use DateTime;

class Controller
{
    /**
     * @throws ModelException
     */
    public function getAmountByDay(): array
    {
        $model = new StandardModel();
        return $model->getDb()->getAmountByDay();
    }

    /**
     * @throws ControllerException
     * @throws ModelException
     */
    public function getTransactionsPerDay(): array
    {
        $model = new StandardModel();
        $day = DateTime::createFromFormat('Y-m-d', $_GET['day']);

        if (!$day) {
            throw new ControllerException('Не указан день или указан в неверном формате. Ожидаемый формат: 1993-01-01');
        }

        return $model->getDb()->getTransactionsPerDay($day);
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
        $transaction->setCategory($model->getCategory());

        $model->getDb()->pushTransaction($transaction);
        return true;
    }

    /**
     * @throws ModelException
     */
    public function getAllCategories(): array
    {
        $model = new StandardModel();
        return array_map(
            fn(Category $category) => $category->toArray(),
            $model->getDb()->getAllCategories()
        );
    }
}
