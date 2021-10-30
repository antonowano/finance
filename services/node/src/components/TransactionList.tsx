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

  return <table className="table">
    <thead>
    <tr>
      <th className="col">#</th>
      <th className="col">День</th>
      <th className="col">Сумма</th>
      <th className="col">Категория</th>
    </tr>
    </thead>
    <tbody>
    {transactions.map((transaction, i) => <tr key={i}>
      <th>{i + 1}</th>
      <td>{transaction.created}</td>
      <td>{transaction.value}</td>
      <td>{transaction.category}</td>
    </tr>)}
    </tbody>
  </table>;
};

export default TransactionList;
