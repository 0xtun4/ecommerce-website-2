/**
 * Sample React Native App
 * https://github.com/facebook/react-native
 *
 * @format
 */

import React from "react";
import Header from "./src/shared/Header.js";
import { StyleSheet } from "react-native";
import { NavigationContainer } from "@react-navigation/native";
import { Provider } from "react-redux";
import store from "./src/redux/store";
import Main from "./src/navigators/Main.js";
import Toast from "react-native-toast-message";
import Auth from "./src/context/store/Auth";

// LogBox.ignoreAllLogs(true);
function App() {
  return (
    <Auth>
      <Provider store={store}>
        <NavigationContainer>
          <Header />
          <Main />
          <Toast ref={ref => Toast.setRef(ref)} />
        </NavigationContainer>
      </Provider>
    </Auth>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: 'white',
  },
});
export default App;
