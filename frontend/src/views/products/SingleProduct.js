import React, {useState} from 'react';
import {Image, ScrollView, StyleSheet, Text, View} from 'react-native';
import style from '../../shared/Style';
import {Button} from 'react-native-paper';
import {connect} from 'react-redux';
import Toast from 'react-native-toast-message';
import * as actions from '../../redux/actions/cartActions';

const SingleProduct = props => {
  const [item, setItem] = useState(props.route.params.item);
  const [availability, setAvailability] = useState('');

  return (
    <View style={style.container}>
      <ScrollView style={styles.scrollView}>
        <View style={styles.imageContainer}>
          <Image
            style={styles.image}
            resizeMode={'contain'}
            source={{
              uri:
                item.image && item.image !== ''
                  ? item.image
                  : 'https://cdn.pixabay.com/photo/2012/04/01/17/29/box-23649_960_720.png',
            }}
          />
        </View>
        <View style={styles.contentContainer}>
          <Text style={styles.contentHeader}>{item.name}</Text>
          <Text style={styles.contentText}>{item.brand}</Text>
        </View>
      </ScrollView>
      <View style={style.bottom}>
        <Text style={style.price}>${item.price}</Text>
        <Button
          type="elevated"
          mode="elevated"
          textColor="green"
          icon="cart"
          buttonColor={'#f0f0f0'}
          onPress={() => {
            props.addItemToCart(item);
            Toast.show({
              topOffset: 60,
              type: 'success',
              text1: `${item.name} added to Cart`,
              text2: 'Go to your cart to complete order',
            });
          }}>
          Add to cart
        </Button>
      </View>
    </View>
  );
};
const mapDispatchToProps = dispatch => {
  return {
    addItemToCart: product =>
      dispatch(actions.addToCart({quantity: 1, product})),
  };
};
const styles = StyleSheet.create({
  scrollView: {
    flex: 1,
    marginBottom: 80,
    padding: 5,
  },

  imageContainer: {
    backgroundColor: 'white',
    padding: 0,
    margin: 0,
  },

  image: {
    width: '100%',
    height: 250,
  },

  contentContainer: {
    marginTop: 20,
    justifyContent: 'center',
    alignItems: 'center',
    paddingHorizontal: 20,
  },

  contentHeader: {
    fontSize: 30,
    fontWeight: 'bold',
    color: 'black',
    marginBottom: 10,
    textAlign: 'center',
  },

  contentText: {
    fontSize: 18,
    fontWeight: 'bold',
    marginBottom: 20,
    textAlign: 'center',
  },
});

export default connect(null, mapDispatchToProps)(SingleProduct);
