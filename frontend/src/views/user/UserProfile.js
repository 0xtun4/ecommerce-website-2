import React, { useCallback, useContext, useState } from "react";
import { ScrollView, StyleSheet, Text, View } from "react-native";
import { useFocusEffect } from "@react-navigation/native";
import AsyncStorage from "@react-native-async-storage/async-storage";
import { prefixUrl } from "../../services/instance";
import AuthGlobal from "../../context/store/AuthGlobal";
import { logoutUser } from "../../context/actions/AuthActions";
import axios from "axios";
import { Button } from "react-native-paper";
import OrderCard from "../../shared/OrderCard";

const UserProfile = props => {
  const context = useContext(AuthGlobal);
  const [userProfile, setUserProfile] = useState();
  const [orders, setOrder] = useState();

  useFocusEffect(
    useCallback(() => {
      if (
        context.stateUser.isAuthenticated === false ||
        context.stateUser.isAuthenticated === null
      ) {
        props.navigation.navigate('Login');
      }

      AsyncStorage.getItem('jwt')
        .then(res => {
          axios
            .get(`${prefixUrl}/users/${context.stateUser.user.userId}`, {
              headers: {Authorization: `Bearer ${res}`},
            })
            .then(user => setUserProfile(user.data))
            .catch(error => console.log(error));
        })
        .catch(error => console.log(error));
      setTimeout(() => {
        axios
          .get(
            `${prefixUrl}/orders/get/userorders/${context.stateUser.user.userId}`,
          )
          .then(res => {
            const data = res.data;
            setOrder(data);
          })
          .catch(error => console.log(error));
      }, 1000);
      return () => {
        setUserProfile();
        setOrder();
      };
    }, [context.stateUser.isAuthenticated]),
  );

  return (
    <View style={styles.container}>
      <Text style={{fontSize: 30}}>{userProfile ? userProfile.name : ''}</Text>
      <View style={{marginTop: 20}}>
        <Text style={{margin: 10}}>
          Email: {userProfile ? userProfile.email : ''}
        </Text>
        <Text style={{margin: 10}}>
          Phone: {userProfile ? userProfile.phone : ''}
        </Text>
      </View>
      <View style={{marginTop: 80}}>
        <Button textColor={'blue'}
          onPress={() => {
            AsyncStorage.removeItem('jwt');
            logoutUser(context.dispatch);
          }}>
          Log out
        </Button>
      </View>
      <ScrollView contentContainerStyle={styles.subContainer}>
        <View>
          <Text style={{fontSize: 20, marginTop: 40}}>My Orders</Text>
          <View>
            {orders ? (
              orders.map(x => {
                return <OrderCard key={x.id} {...x} />;
              })
            ) : (
              <View style={styles.order}>
                <Text>You have no orders</Text>
              </View>
            )}
          </View>
        </View>
      </ScrollView>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    alignItems: 'center',
  },
  subContainer: {
    alignItems: 'center',
    marginTop: 60,
  },
  order: {
    marginTop: 20,
    alignItems: 'center',
    marginBottom: 60,
  },
});

export default UserProfile;
