import { ADD_TO_CART, CLEAR_CART, REMOVE_FROM_CART } from "../constants";

const cartItem = (state = [], action) => {
  switch (action.type) {
    case ADD_TO_CART:
      return [...state, action.payload];
    case REMOVE_FROM_CART:
      return state.filter(cartItems => cartItems.id !== action.payload);
    case CLEAR_CART:
      return [];
    default:
      return state;
  }
};

export default cartItem;
