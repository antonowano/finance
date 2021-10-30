import { useParams } from 'react-router-dom';
import TransactionList from '../components/TransactionList';

interface Params {
  date: string;
}

const TransactionListPage = () => {
  const { date } = useParams<Params>();

  return <>
    <h1 className="h1 mt-4 mb-5">Список транзакций за {date}</h1>
    <TransactionList date={date} />
  </>;
};

export default TransactionListPage;
