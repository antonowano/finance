export interface Response<T> {
  status: 'error' | 'success',
  data: T,
}

export interface AmountPerDay {
  date: string;
  value: number;
}

export interface Transaction {
  created: string;
  value: string;
  category: string;
}

export interface Category {
  id: number;
  name: string;
}
