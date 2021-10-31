<?php

namespace App;

use App\Dto\AmountByDay;
use App\Dto\Category;
use App\Dto\Transaction;
use DateTime;
use PDO;
use PDOException;

class Database
{
    private PDO $pdo;

    /**
     * @throws PDOException
     */
    public function __construct()
    {
        $this->pdo = new PDO(
            'mysql:host=' . $_SERVER['MYSQL_HOST'] . ';dbname=' . $_SERVER['MYSQL_DATABASE'],
            $_SERVER['MYSQL_USER'],
            $_SERVER['MYSQL_PASSWORD']
        );
    }

    /**
     * @throws PDOException
     * @return Category[]
     */
    public function getAllCategories(): array
    {
        $sth = $this->pdo->prepare('SELECT `id`, `name` FROM `finance_categories`');
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_CLASS, Category::class);
    }

    public function countCategoriesWithName(string $name): int
    {
        $sth = $this->pdo->prepare('SELECT COUNT(`id`) FROM `finance_categories` WHERE `name` LIKE :name');
        $sth->execute([':name' => $name]);
        return $sth->fetchColumn();
    }

    public function deleteCategory(int $id): bool
    {
        $sth = $this->pdo->prepare('DELETE FROM `finance_categories` WHERE id = :id');
        return $sth->execute([':id' => $id]);
    }

    public function addCategory(Category $category): bool
    {
        $sth = $this->pdo->prepare('INSERT INTO `finance_categories` (`name`) VALUE(?)');
        $sth->bindValue(1, $category->getName());
        $result = $sth->execute();
        $category->setId($this->pdo->lastInsertId());
        return $result;
    }

    /**
     * @throws PDOException
     */
    public function addTransaction(Transaction $transaction): bool
    {
        $sth = $this->pdo->prepare('INSERT INTO `finance` (`created`, `value`, `category_id`) VALUE(?, ?, ?)');
        $sth->bindValue(1, $transaction->getCreated());
        $sth->bindValue(2, $transaction->getValue());
        $sth->bindValue(3, $transaction->getCategoryId());
        $result = $sth->execute();
        $transaction->setId($this->pdo->lastInsertId());
        return $result;
    }

    public function deleteTransaction(int $id): bool
    {
        $sth = $this->pdo->prepare('DELETE FROM `finance` WHERE id = :id');
        return $sth->execute([':id' => $id]);
    }

    /**
     * @return AmountByDay[]
     */
    public function getAmountByDay(): array
    {
        $sth = $this->pdo->prepare('
            SELECT DATE(`created`) AS `date`, SUM(`value`) AS `value` 
            FROM `finance` 
            GROUP BY `date` 
            ORDER BY `date` DESC
        ');
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_CLASS, AmountByDay::class);
    }

    /**
     * @return Transaction[]
     */
    public function getTransactionsPerDay(DateTime $day): array
    {
        $sth = $this->pdo->prepare('
            SELECT f.id, f.`created`, f.`value`, c.`id` AS `categoryId`, c.`name` AS `categoryName`
            FROM `finance` AS f 
                LEFT JOIN `finance_categories` AS c ON c.`id` = f.`category_id`
            WHERE f.`created` LIKE :likeDate 
            ORDER BY f.`created`
        ');
        $sth->execute([':likeDate' => $day->format('Y-m-d%')]);
        return $sth->fetchAll(PDO::FETCH_CLASS, Transaction::class);
    }
}
