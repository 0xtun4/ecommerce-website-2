import React from "react";
import { StyleSheet, Text, View } from "react-native";

const Error = props => {
  return (
    <View style={styles.container}>
      <Text style={styles.message}>{props.message}</Text>
    </View>
  );
};
const styles = StyleSheet.create({
  container: {
    width: '100%',
    alignItems: 'center',
    margin: 10,
  },

  message: {
    color: 'red',
    fontSize: 16,
  },
});
export default Error;
