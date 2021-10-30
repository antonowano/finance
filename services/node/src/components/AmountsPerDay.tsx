import React, { useEffect, useState } from 'react';
import { AmountPerDay } from '../interfaces';
import { Link } from 'react-router-dom';
import FinanceService from '../services/FinanceService';

const AmountsPerDay = () => {
  const [ amounts, setAmounts ] = useState<AmountPerDay[]>([]);

  useEffect(() => {
    FinanceService.getAmountsPerDay().then((obj) => setAmounts(obj.data));
  }, []);

  return <table className="table">
    <thead>
    <tr>
      <th className="col">#</th>
      <th className="col">День</th>
      <th className="col">Сумма</th>
    </tr>
    </thead>
    <tbody>
      {amounts.map((amount, index) => <tr key={amount.date}>
        <th>{index + 1}</th>
        <td><Link to={`/transactions/${amount.date}`}>{amount.date}</Link></td>
        <td>{amount.value}</td>
      </tr>)}
    </tbody>
  </table>;
};

export default AmountsPerDay;
