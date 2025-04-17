import {createAsyncThunk, createSlice, isPending} from '@reduxjs/toolkit';
import axios from 'axios';
import {prefixUrl} from '../instance';

const initialState = {
  products: [],
  productsFiltered: [],
  focus: false,
  categories: [],
  productsCtg: [],
  loading: true,
};

const fetchProducts = createAsyncThunk(
  'products/fetchProducts',
  async () => {
    const response = await axios.get(`${prefixUrl}/products`);
    return response.data;
  },
);

const fetchCategories = createAsyncThunk(
  'products/fetchCategories',
  async () => {
    const response = await axios.get(`${prefixUrl}/categories`);
    return response.data;
  },

);
const fetchProductData = createAsyncThunk(
  'products/fetchProductData',
  async () => {
    const response = await axios.get(`${prefixUrl}/products/${id}`);
    return response.data;
  },
);
