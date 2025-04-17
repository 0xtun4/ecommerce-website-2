import React from "react";
import { createMaterialTopTabNavigator } from "@react-navigation/material-top-tabs";
import Confirm from "../views/cart/checkout/Confirm";
import Checkout from "../views/cart/checkout/Checkout";
import Payment from "../views/cart/checkout/Payment";

const Tab = createMaterialTopTabNavigator();

function MyTabs() {
  return (
    <Tab.Navigator>
      <Tab.Screen name="Shipping" component={Checkout} />
      <Tab.Screen name="Payment" component={Payment} />
      <Tab.Screen name="Confirm" component={Confirm} />
    </Tab.Navigator>
  );
}

export default function CheckoutNavigator() {
  return <MyTabs />;
}
