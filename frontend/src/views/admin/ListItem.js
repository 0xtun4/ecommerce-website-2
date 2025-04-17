import React, { useState } from "react";
import { Dimensions, Image, Modal, StyleSheet, Text, TouchableHighlight, TouchableOpacity, View } from "react-native";
import Icon from "react-native-vector-icons/FontAwesome";
import { useNavigation } from "@react-navigation/native";
import { Button } from "react-native-paper";
import style from "../../shared/Style";

const {width} = Dimensions.get('window');

const ListItem = props => {
  const [modalVisible, setModalVisible] = useState(false);
  const navigation = useNavigation();
  return (
    <View>
      <Modal
        animationType="fade"
        transparent={true}
        visible={modalVisible}
        onRequestClose={() => {
          setModalVisible(false);
        }}>
        <View style={styles.centerView}>
          <View style={styles.modalView}>
            <TouchableHighlight
              underlayColor="gainsboro"
              onPress={() => setModalVisible(false)}
              style={styles.closeButton}>
              <Icon name="close" size={20} />
            </TouchableHighlight>
            <Button
              style={style.button}
              mode="contained"
              buttonColor={'blue'}
              onPress={() => [
                props.navigation.navigate('ProductsForm', {item: props}),
                setModalVisible(false),
              ]}>
              Edit
            </Button>
            <Button
              style={style.button}
              mode="contained"
              buttonColor={'red'}
              onPress={() => [props.delete(props.id), setModalVisible(false)]}>
              Delete
            </Button>
          </View>
        </View>
      </Modal>

      <TouchableOpacity
        style={[
          styles.container,
          {
            backgroundColor: props.index % 2 === 0 ? 'white' : 'gainsboro',
          },
        ]}
        onLongPress={() => setModalVisible(true)}
        onPress={() =>
          props.navigation.navigate('ProductDetail', {item: props})
        }>
        <Image
          source={{
            uri: props.image
              ? props.image
              : 'https://cdn.pixabay.com/photo/2012/04/01/17/29/box-23649_960_720.png',
          }}
          resizeMode="contain"
          style={styles.image}
        />
        <View style={styles.body}>
          <Text style={styles.item}>{props.brand}</Text>
          <Text style={styles.item} numberOfLines={1} ellipsizeMode="tail">
            {props.name}
          </Text>
          <Text style={styles.item} numberOfLines={1} ellipsizeMode="tail">
            {props.category ? props.category.name : ''}
          </Text>
          <Text style={styles.item}>${props.price}</Text>
        </View>
      </TouchableOpacity>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flexDirection: 'row',
    padding: 5,
    width: width,
    marginTop: 5,
  },
  body: {
    width: '10%',
    flexDirection: 'row',
    position: 'relative',
    justifyContent: 'space-between',
    right: 0,
  },
  image: {
    borderRadius: 50,
    width: width / 6,
    height: 20,
    margin: 2,
  },
  item: {
    flexWrap: 'wrap',
    margin: 3,
    width: width / 6,
  },
  centerView: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    marginTop: 22,
  },
  modalView: {
    margin: 20,
    backgroundColor: 'white',
    borderRadius: 20,
    padding: 35,
    alignItems: 'center',
    shadowColor: '#000',
    shadowOffset: {
      width: 0,
      height: 2,
    },
    shadowOpacity: 0.25,
    shadowRadius: 4,
    elevation: 5,
  },
  closeButton: {
    position: 'absolute',
    left: 5,
    top: 5,
  },
});

export default ListItem;
