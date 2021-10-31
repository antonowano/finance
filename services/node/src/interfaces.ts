export interface Response<T> {
  status: 'error' | 'success',
  data: T,
}

export interface AmountPerDay {
  date: string;
  value: number;
}

export interface Transaction {
  id: number | null;
  created: string;
  value: string;
  categoryId: string | null;
  categoryName?: string | null;
}

export interface Category {
  id: number;
  name: string;
}
