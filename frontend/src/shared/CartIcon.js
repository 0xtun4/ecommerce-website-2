import React from "react";
import { StyleSheet, Text, View } from "react-native";
import { connect } from "react-redux";

const CartIcon = props => {
  return (
    <>
      {props.cartItems.length > 0 ? (
        <View style={styles.badge}>
          <Text style={styles.text}>{props.cartItems.length}</Text>
        </View>
      ) : null}
    </>
  );
};

const mapStateToProps = state => {
  const {cartItems} = state;
  return {
    cartItems: cartItems,
  };
};

const styles = StyleSheet.create({
  badge: {
    width: 20,
    position: 'absolute',
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    alignContent: 'center',
    top: -4,
    right: -10,
    backgroundColor: 'red',
    borderRadius: 50,
  },

  text: {
    color: 'white',
    fontSize: 12,
    fontWeight: 'bold',
  },
});

export default connect(mapStateToProps, null)(CartIcon);
