import React from 'react';
import AmountsPerDay from '../components/AmountsPerDay';

const DashboardPage = () => {
  return <>
    <h1 className="h1 mt-4 mb-5">Расходы/доходы по дням</h1>
    <AmountsPerDay />
  </>;
};

export default DashboardPage;
