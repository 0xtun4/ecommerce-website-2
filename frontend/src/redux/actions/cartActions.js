import { ADD_TO_CART, CLEAR_CART, REMOVE_FROM_CART } from "../constants";

export const addToCart = payload => {
  return {
    type: ADD_TO_CART,
    payload,
  };
};

export const removeFromCart = itemId => ({
  type: REMOVE_FROM_CART,
  payload: itemId,
});

export const clearCart = () => {
  return {
    type: CLEAR_CART,
  };
};
