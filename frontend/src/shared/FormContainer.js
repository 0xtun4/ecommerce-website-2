import React from "react";
import { Dimensions, ScrollView, StyleSheet, Text } from "react-native";
import style from "./Style";

let {width} = Dimensions.get('window');

const FormContainer = props => {
  return (
    <ScrollView contentContainerStyle={styles.container}>
      <Text style={style.title}>{props.title}</Text>
      {props.children}
    </ScrollView>
  );
};

const styles = StyleSheet.create({
  container: {
    marginBottom: 400,
    width: width,
    justifyContent: 'center',
    alignItems: 'center',
  },

});

export default FormContainer;
