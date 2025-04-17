import React, { useCallback, useState } from "react";
import { FlatList, View } from "react-native";
import axios from "axios";
import { prefixUrl } from "../../services/instance";
import { useFocusEffect } from "@react-navigation/native";
import OrderCard from "../../shared/OrderCard";

const Order = props => {
  const [orderList, setOrderList] = useState([]);

  useFocusEffect(
    useCallback(() => {
      getOrders();
      return () => {
        setOrderList([]);
      };
    }, []),
  );
  const getOrders = async () => {
    axios
      .get(`${prefixUrl}/orders`)
      .then(res => {
        setOrderList(res.data);
      })
      .catch(err => {
        console.log(err);
      });
  };
  return (
    <View>
      <FlatList
        data={orderList}
        renderItem={({item}) => (
          <OrderCard navigation = {props.navigation} {...item} editMode={true} />
        )}
        keyExtractor={item => item.id.toString()}
      />
    </View>
  );
};

export default Order;
