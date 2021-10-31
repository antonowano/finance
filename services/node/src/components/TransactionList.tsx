import React, { useEffect, useState } from 'react';
import { Transaction } from '../interfaces';
import FinanceService from '../services/FinanceService';

interface Props {
  date: string;
}

const TransactionList = ({ date }: Props) => {
  const [ transactions, setTransactions ] = useState<Transaction[]>([]);

  useEffect(() => {
    FinanceService.getTransactions(date).then((obj) => setTransactions(obj.data));
  }, [date]);

  const deleteTransaction = (id: number | null) => {
    id && FinanceService.removeTransaction(id).then(() => {
      setTransactions(transactions.filter((transaction) => {
        return (transaction.id !== id);
      }));
    });
  };

  return <table className="table">
    <thead>
    <tr>
      <th className="col">ID</th>
      <th className="col">Время</th>
      <th className="col">Категория</th>
      <th className="col text-end">Сумма</th>
      <th className="col" />
    </tr>
    </thead>
    <tbody>
    {transactions.length ? transactions.map((transaction) => <tr key={transaction.id}>
      <th>{transaction.id}</th>
      <td>{transaction.created}</td>
      <td>{transaction.categoryName ?? <i>Не указана</i>}</td>
      <td className="text-end">{transaction.value} руб.</td>
      <td className="text-end">
        <button className="btn btn-danger btn-sm" onClick={() => deleteTransaction(transaction.id)}>Удалить</button>
      </td>
    </tr>) : <tr><td className="text-center" colSpan={5}>Нет транзакций за этот день.</td></tr>}
    </tbody>
  </table>;
};

export default TransactionList;
