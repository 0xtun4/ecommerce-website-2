import { React, useEffect, useState } from "react";
import AsyncStorage from "@react-native-async-storage/async-storage";
import TrafficLight from "./TrafficLight";
import axios from "axios";
import { prefixUrl } from "../services/instance";
import Toast from "react-native-toast-message";
import { StyleSheet, Text, View } from "react-native";
import RNPickerSelect from "react-native-picker-select";
import { Button } from "react-native-paper";

const codes = [
  {label: 'pending', value: '3'},
  {label: 'shipped', value: '2'},
  {label: 'delivered', value: '1'},
];

const OrderCard = props => {
  const [orderStatus, setOrderStatus] = useState();
  const [statusText, setStatusText] = useState();
  const [statusChange, setStatusChange] = useState();
  const [token, setToken] = useState();
  const [cardColor, setCardColor] = useState();
  console.log(props.status);

  useEffect(() => {
    if (props.editMode) {
      AsyncStorage.getItem('jwt')
        .then(res => {
          setToken(res);
        })
        .catch(error => console.log(error));
    }

    if (props.status === 3) {
      setOrderStatus(<TrafficLight unavailable />);
      setStatusText('pending');
      setCardColor('#E74C3C');
    } else if (props.status === 2) {
      setOrderStatus(<TrafficLight limited />);
      setStatusText('shipped');
      setCardColor('#F1C40F');
    } else {
      setOrderStatus(<TrafficLight available />);
      setStatusText('delivered');
      setCardColor('#2ECC71');
    }

    return () => {
      setOrderStatus();
      setStatusText();
      setCardColor();
    };
  }, []);

  const updateOrder = () => {
    const config = {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    };
    console.log(token);

    const order = {
      city: props.city,
      country: props.country,
      dateOrdered: props.dateOrdered,
      id: props.id,
      orderItems: props.orderItems,
      phone: props.phone,
      shippingAddress1: props.shippingAddress1,
      shippingAddress2: props.shippingAddress2,
      status: statusChange,
      totalPrice: props.totalPrice,
      user: props.user,
      zip: props.zip,
    };

    axios
      .put(`${prefixUrl}/orders/${props.id}`, order, config)
      .then(res => {
        if (res.status === 200 || res.status === 201) {
          Toast.show({
            topOffset: 60,
            type: 'success',
            text1: 'Order Edited',
            text2: '',
          });
          setTimeout(() => {
            props.navigation.navigate('Products');
          }, 500);
        }
      })
      .catch(error => {
        Toast.show({
          topOffset: 60,
          type: 'error',
          text1: 'Something went wrong',
          text2: `${error}`,
        });
      });
  };

  return (
    <View style={[{backgroundColor: cardColor}, styles.container]}>
      <View style={styles.container}>
        <Text style={styles.textColor}>Order Number: #{props.id}</Text>
      </View>
      <View style={{marginTop: 10}}>
        <Text style={styles.textColor}>
          Status: {statusText} {orderStatus}
        </Text>
        <Text style={styles.textColor}>
          Address: {props.shippingAddress1} {props.shippingAddress2}
        </Text>
        <Text style={styles.textColor}>City: {props.city}</Text>
        <Text style={styles.textColor}>Country: {props.country}</Text>
        <Text style={styles.textColor}>
          Date Ordered: {props.dateOrdered.split('T')[0]}
        </Text>
        <View style={styles.priceContainer}>
          <Text style={styles.textColor}>Price: </Text>
          <Text style={styles.price}>$ {props.totalPrice}</Text>
        </View>
        {props.editMode ? (
          <View>
            <RNPickerSelect
              placeholder={{label: 'Change Status', value: null}}
              style={pickerSelectStyles}
              onValueChange={e => setStatusChange(e)}
              items={codes}
            />
            <Button
              mode={'text'}
              textColor={'white'}
              onPress={() => updateOrder()}>
              Change status
            </Button>
          </View>
        ) : null}
      </View>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    padding: 20,
    margin: 10,
    borderRadius: 10,
  },
  title: {
    backgroundColor: '#62B1F6',
    padding: 5,
  },
  textColor: {
    color: 'white',
  },
  priceContainer: {
    marginTop: 10,
    alignSelf: 'flex-end',
    flexDirection: 'row',
  },
  price: {
    color: 'white',
    fontWeight: 'bold',
  },
});
const pickerSelectStyles = StyleSheet.create({
  inputAndroid: {
    justifyContent: 'center',
    margin: 20,
    alignItems: 'center',
    fontSize: 16,
    paddingHorizontal: 10,
    paddingVertical: 8,
    borderWidth: 2,
    borderColor: 'white',
    borderRadius: 8,
    color: 'white',
  },
});

export default OrderCard;
