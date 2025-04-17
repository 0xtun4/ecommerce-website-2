import React from "react";
import { createStackNavigator } from "@react-navigation/stack";
import Categories from "../views/admin/Categories";
import Products from "../views/admin/Products";
import ProductsForm from "../views/admin/ProductsForm";
import Order from "../views/admin/Order";

const Stack = createStackNavigator();

const AdminNavigator = () => {
  return (
    <Stack.Navigator>
      <Stack.Screen
        name="Products"
        component={Products}
        options={{
          headerShown: false,
          title: 'Products',
        }}
      />
      <Stack.Screen
        name="Categories"
        component={Categories}
        options={{
          // headerShown: false,
          title: 'Categories',
        }}
      />
      <Stack.Screen
        name="ProductsForm"
        component={ProductsForm}
        options={{
          // headerShown: false,
          title: 'Add product',
        }}
      />
      <Stack.Screen
        name="Order"
        component={Order}
        options={{
          // headerShown: false,
          title: 'Order',
        }}
      />
    </Stack.Navigator>
  );
};

export default function AdminNavigatorScreen() {
  return <AdminNavigator />;
}
