import React from 'react';
import {createStackNavigator} from '@react-navigation/stack';

import Cart from '../views/cart/Cart';
import checkoutNavigator from './CheckoutNavigator';

const Stack = createStackNavigator();

function MyStack() {
  return (
    <Stack.Navigator>
      <Stack.Screen
        name="Cart"
        component={Cart}
        options={
          {
            // headerShown: false,
          }
        }
      />
      <Stack.Screen
        name="Checkout"
        component={checkoutNavigator}
        options={
          {
            // headerShown: false,
          }
        }
      />
    </Stack.Navigator>
  );
}

export default function CartNavigator() {
  return <MyStack />;
}
