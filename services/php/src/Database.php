<?php

namespace App;

use App\Dto\Category;
use App\Dto\Transaction;
use PDO;
use PDOException;
use ReflectionProperty;

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

    /**
     * @throws PDOException
     */
    public function pushTransaction(Transaction $transaction)
    {
        if ($transaction->getId()) {
            $sth = $this->pdo->prepare('
                UPDATE `finance` 
                SET `created` = ?, `value` = ?, `category_id` = ? 
                WHERE `id` = ?
            ');
            $sth->bindValue(4, $transaction->getId());
        } else {
            $sth = $this->pdo->prepare('INSERT `finance` (`created`, `value`, `category_id`) VALUE(?, ?, ?)');
        }

        $sth->bindValue(1, $transaction->getCreated()->format('c'));
        $sth->bindValue(2, $transaction->getValue());
        $sth->bindValue(3, $transaction->getCategory()?->getId());
        $sth->execute();
    }

    public function getAmountByDay(): array
    {
        $sth = $this->pdo->prepare('
            SELECT DATE(`created`) AS `date`, SUM(`value`) AS `value` 
            FROM `finance` 
            GROUP BY `date` 
            ORDER BY `date` DESC
        ');
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTransactionsPerDay(\DateTime $day): array
    {
        $sth = $this->pdo->prepare('
            SELECT f.`created`, f.`value`, c.`name` AS `category`
            FROM `finance` AS f 
                LEFT JOIN `finance_categories` AS c ON c.`id` = f.`category_id`
            WHERE f.`created` LIKE :likeDate 
            ORDER BY f.`created` ASC
        ');
        $sth->execute([':likeDate' => $day->format('Y-m-d%')]);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}
