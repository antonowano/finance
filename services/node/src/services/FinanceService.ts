import { AmountPerDay, Category, Response, Transaction } from '../interfaces';

export default class FinanceService {
  static async getAmountsPerDay(): Promise<Response<AmountPerDay[]>> {
    return await fetch('/api.php?method=amount_by_day')
      .then((response) => response.json());
  }

  static async getAllCategories(): Promise<Response<Category[]>> {
    return await fetch('/api.php?method=all_categories')
      .then((response) => response.json());
  }

  static async getTransactions(date: string): Promise<Response<Transaction[]>> {
    return await fetch('/api.php?method=transactions_per_day&day=' + date)
      .then((response) => response.json());
  }

  static async addTransaction(data: Transaction): Promise<Response<true>> {
    const options = {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
      },
      body: new URLSearchParams({
        value: data.value,
        created: data.created,
        category_id: data.category,
      }),
    };
    return await fetch('/api.php?method=add_transaction', options)
      .then((response) => response.json());
  }
}
