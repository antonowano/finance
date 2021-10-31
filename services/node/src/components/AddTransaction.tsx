import React, { FormEvent, useEffect, useState } from 'react';
import { Category, Transaction } from '../interfaces';
import FinanceService from '../services/FinanceService';

const AddTransaction = () => {
  const [ categories, setCategories ] = useState<Category[]>([]);
  const [ success, setSuccess ] = useState<boolean>(false);
  const [ body, setBody ] = useState<Transaction>(getEmptyTransaction());

  function getEmptyTransaction(): Transaction {
    return {
      id: null,
      value: '',
      created: currentTime(),
      categoryId: null,
    };
  }

  useEffect(() => {
    FinanceService.getAllCategories().then((obj) => setCategories(obj.data));
  }, []);

  function onSubmit(e: FormEvent<HTMLFormElement>) {
    e.preventDefault();

    FinanceService.addTransaction(body)
      .then(() => setSuccess(true))
      .then(() => setBody({ ...body, ...getEmptyTransaction() }))
    ;
  }

  function currentTime(): string {
    const datetime = new Date();
    const Y = datetime.getFullYear();
    const m = ('0' + (datetime.getMonth() + 1)).slice(-2);
    const d = ('0' + datetime.getDate()).slice(-2);
    const H = ('0' + datetime.getHours()).slice(-2);
    const i = ('0' + datetime.getMinutes()).slice(-2);

    return `${Y}-${m}-${d}T${H}:${i}`;
  }

  return <form onSubmit={(e) => onSubmit(e)}>
    {success ? <div className="alert alert-success" role="alert">Транзакция успешно добавлена</div> : ''}
    <div className="mb-3">
      <label htmlFor="created" className="form-label">Время операции</label>
      <input type="datetime-local" className="form-control" id="created" name="created" value={body.created} required
             onChange={(e) => setBody({ ...body, created: e.target.value })} />
    </div>
    <div className="mb-3">
      <label htmlFor="value" className="form-label">Значение</label>
      <input type="text" className="form-control" id="value" name="value" value={body.value} required
             onChange={(e) => setBody({ ...body, value: e.target.value })} />
    </div>
    <div className="mb-3">
      <label htmlFor="category_id" className="form-label">Категория</label>
      <select className="form-select" id="category_id" name="category_id" value={body.categoryId || ''}
              onChange={(e) => setBody({ ...body, categoryId: e.target.value })}>
        <option value="">- Не выбрана -</option>
        {categories.map((category) => <option key={category.id} value={category.id}>{category.name}</option>)}
      </select>
    </div>
    <div className="row">
      <div className="col">
        <button type="submit" className="btn btn-primary">Отправить</button>
      </div>
    </div>
  </form>;
};

export default AddTransaction;
