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
      <th className="col">День</th>
      <th className="col text-end">Сумма</th>
    </tr>
    </thead>
    <tbody>
      {amounts.length ? amounts.map((amount) => <tr key={amount.date}>
        <td><Link to={`/transactions/${amount.date}`}>{amount.date}</Link></td>
        <td className="text-end">{amount.value} руб.</td>
      </tr>) : <tr><td className="text-center" colSpan={2}>Нет информации по расходам и доходам.</td></tr>}
    </tbody>
  </table>;
};

export default AmountsPerDay;
