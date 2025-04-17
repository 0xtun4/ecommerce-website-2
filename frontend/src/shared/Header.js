import React from "react";
import { Image, SafeAreaView, StyleSheet } from "react-native";

const Header = () => {
  return (
    <SafeAreaView>
      <Image
        style={styles.header}
        source={require('../../assets/Logo.png')}
        resizeMode="contain"
      />
    </SafeAreaView>
  );
};
const styles = StyleSheet.create({
  header: {
    width: '100%',
    flexDirection: 'row',
    alignContent: 'center',
    justifyContent: 'center',
    padding: 20,
    backgroundColor: 'gainsboro',
    elevation: 8,
    height: 50,
  },
});
export default Header;
