import React, { useContext } from "react";
import { createBottomTabNavigator } from "@react-navigation/bottom-tabs";
import Icon from "react-native-vector-icons/FontAwesome";
import { View } from "react-native";
import HomeNavigator from "./HomeNavigator";
import CartNavigator from "./CartNavigator";
import CartIcon from "../shared/CartIcon";
import UserNavigator from "./UserNavigator";
import AdminNavigator from "./AdminNavigator";
import AuthGlobal from "../context/store/AuthGlobal";

const Tab = createBottomTabNavigator();

const Main = () => {
  const context = useContext(AuthGlobal);
  return (
    <Tab.Navigator
      initialRouteName="MainHome"
      screenOptions={{
        keyboardHidesTabBar: true,
        showLabel: false,
        activeTintColor: 'blue',
      }}>
      <Tab.Screen
        name="MainHome"
        component={HomeNavigator}
        options={{
          headerShown: false,
          tabBarIcon: ({color}) => (
            <Icon
              name="home"
              style={{position: 'relative'}}
              color={color}
              size={30}
            />
          ),
        }}
      />
      <Tab.Screen
        name="Cart"
        component={CartNavigator}
        options={{
          headerShown: false,
          tabBarIcon: ({color}) => (
            <View>
              <Icon
                name="shopping-cart"
                style={{position: 'relative'}}
                color={color}
                size={30}
              />
              <CartIcon />
            </View>
          ),
        }}
      />

      {context.stateUser.user.isAdmin === true ? (
        <Tab.Screen
          name="Admin"
          component={AdminNavigator}
          options={{
            headerShown: false,
            tabBarIcon: ({color}) => (
              <Icon
                name="cogs"
                style={{position: 'relative'}}
                color={color}
                size={30}
              />
            ),
          }}
        />
      ) : null}

      <Tab.Screen
        name="Profile"
        component={UserNavigator}
        options={{
          headerShown: false,
          tabBarIcon: ({color}) => (
            <Icon
              name="user"
              style={{position: 'relative'}}
              color={color}
              size={30}
            />
          ),
        }}
      />
    </Tab.Navigator>
  );
};

export default Main;
