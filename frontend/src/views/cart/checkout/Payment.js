import React, { useState } from "react";
import { FlatList, StyleSheet, Text, TouchableOpacity, View } from "react-native";
import { Button, RadioButton } from "react-native-paper";
import RNPickerSelect from "react-native-picker-select";

const method = [
  {name: 'Cash on Delivery', value: 1},
  {name: 'Bank transfer', value: 2},
  {name: 'Card payment', value: 3},
];

const c = [
  {label: 'Wallet', value: 1},
  {label: 'Visa', value: 2},
  {label: 'MasterCard', value: 3},
  {label: 'Other', value: 4},
];

const Payment = props => {
  const order = props.route.params;
  const [selected, setSelected] = useState();
  const [card, setCard] = useState();

  return (
    <View>
      <Text style={styles.title}>Choose your payment method</Text>
      <View>
        <FlatList
          data={method}
          renderItem={({item}) => {
            return (
              <View style={styles.container}>
                <TouchableOpacity
                  key={item.value}
                  onPress={() => setSelected(item.value)}
                  style={styles.button}>
                  <Text style={styles.buttonText}>{item.name}</Text>
                </TouchableOpacity>
                <RadioButton.IOS
                  value={item.value}
                  color={'green'}
                  status={selected === item.value ? 'checked' : 'unchecked'}
                  onPress={() => setSelected(item.value)}
                />
              </View>
            );
          }}
        />
        {selected === 3 ? (
          <RNPickerSelect
            items={c}
            placeholder={{
              label: 'Select a card',
              value: null,
            }}
            onValueChange={value => setCard(value)}
          />
        ) : null}
        <Button
          type="outline"
          mode="outline"
          style={styles.bottomButton}
          textColor={'blue'}
          onPress={() => props.navigation.navigate('Confirm', {order})}>
          Confirm
        </Button>
      </View>
    </View>
  );
};
const styles = StyleSheet.create({
  container: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
  },
  bottomButton:{
    marginTop: 60,
    alignSelf: 'center',
  },
  title: {
    fontSize: 20,
    fontWeight: 'bold',
    color: 'black',
    padding: 10,
    textAlign: 'center',
  },

  button: {
    width: '90%',
    height: 40,
    borderRadius: 5,
    borderBottomColor: 'gray',
    borderBottomWidth: 0.2,
  },
  buttonText: {
    paddingTop: 10,
    paddingLeft: 10,
    color: 'black',
    fontSize: 18,
  },
  radioButton: {
    color: 'green',
  },
});
export default Payment;
