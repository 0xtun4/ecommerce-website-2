import React from 'react';
import {createStackNavigator} from '@react-navigation/stack';
import ProductContainer from '../views/products/ProductContainer';
import SingleProduct from '../views/products/SingleProduct';

const Stack = createStackNavigator();

function MyStack() {
  return (
    <Stack.Navigator>
      <Stack.Screen
        name="HomeScreen"
        component={ProductContainer}
        options={{
          headerShown: false,
        }}
      />
      <Stack.Screen name="ProductDetail" component={SingleProduct} />
    </Stack.Navigator>
  );
}

export default function HomeNavigator() {
  return <MyStack />;
}
