import React from 'react';
import { BrowserRouter, Redirect, Route, Switch } from 'react-router-dom';
import DashboardPage from './pages/DashboardPage';
import AddTransactionPage from './pages/AddTransactionPage';
import Navbar from './components/ui/navbar/Navbar';
import TransactionListPage from './pages/TransactionListPage';

function App() {
  return <BrowserRouter>
    <Navbar />
    <div className="container pt-3">
      <Switch>
        <Route path="/dashboard">
          <DashboardPage />
        </Route>
        <Route exact path="/transactions/add">
          <AddTransactionPage />
        </Route>
        <Route exact path="/transactions/:date">
          <TransactionListPage />
        </Route>
        <Redirect to="/dashboard" />
      </Switch>
    </div>
  </BrowserRouter>;
}

export default App;
