import React, { useEffect, useState } from "react";
import { launchImageLibrary } from "react-native-image-picker";
import { Image, ScrollView, StyleSheet, Text, TouchableOpacity, View } from "react-native";
import FormContainer from "../../shared/FormContainer";
import { Button, TextInput } from "react-native-paper";
import style from "../../shared/Style";
import RNPickerSelect from "react-native-picker-select";
import axios from "axios";
import { prefixUrl } from "../../services/instance";
import Icon from "react-native-vector-icons/FontAwesome";
import AsyncStorage from "@react-native-async-storage/async-storage";
import Toast from "react-native-toast-message";
import mime from "mime";

const ProductsForm = props => {
  const [pickerValue, setPickerValue] = useState();
  const [brand, setBrand] = useState();
  const [name, setName] = useState();
  const [price, setPrice] = useState();
  const [description, setDescription] = useState();
  const [image, setImage] = useState();
  const [mainImage, setMainImage] = useState();
  const [category, setCategory] = useState();
  const [categories, setCategories] = useState([]);
  const [token, setToken] = useState();
  const [err, setError] = useState();
  const [countInStock, setCountInStock] = useState();
  const [rating, setRating] = useState(0);
  const [isFeatured, setIsFeatured] = useState(false);
  const [richDescription, setRichDescription] = useState([]);
  const [numReviews, setNumReviews] = useState(0);
  const [item, setItem] = useState(null);

  useEffect(() => {
    if (!props.route.params) {
      setItem(null);
    } else {
      setItem(props.route.params.item);
      setBrand(props.route.params.item.brand);
      setName(props.route.params.item.name);
      setPrice(props.route.params.item.price.toString());
      setDescription(props.route.params.item.description);
      setMainImage(props.route.params.item.image);
      setImage(props.route.params.item.image);
      setCategory(props.route.params.item.category);
      setCountInStock(props.route.params.item.countInStock.toString());
    }
    AsyncStorage.getItem('jwt')
      .then(res => {
        setToken(res);
      })
      .catch(error => console.log(error));
    axios
      .get(`${prefixUrl}/categories`)
      .then(res => {
        setCategories(res.data);
      })
      .catch(err => {
        alert(err);
      });

    // (async () => {
    //   if (Platform.OS !== 'web') {
    //     const {status} = await ImagePicker.requestCameraPermissionsAsync();
    //     if (status !== 'granted') {
    //       alert('Sorry, we need camera roll permissions to make this work!');
    //     }
    //   }
    // })();

    return () => {
      setCategories([]);
    };
  }, [props.route.params]);

  const ImagePicker = async () => {
    const options = {
      mediaType: 'photo',
      includeBase64: false,
      maxHeight: 2000,
      maxWidth: 2000,
    };
    await launchImageLibrary(options, response => {
      if (response.didCancel) {
        console.log('User cancelled image picker');
      } else if (response.error) {
        console.log('Image picker error: ', response.error);
      } else {
        let imageUri = response.uri || response.assets?.[0]?.uri;
        setMainImage(imageUri);
        setImage(imageUri);
      }
    });
  };

  const addProduct = () => {
    if (
      name == '' ||
      brand == '' ||
      price == '' ||
      description == '' ||
      category == '' ||
      countInStock == ''
    ) {
      setError('Please fill in the form correctly');
    }

    let formData = new FormData();

    const newImageUri = 'file:///' + image.split('file:/').join('');

    formData.append('image', {
      uri: newImageUri,
      type: mime.getType(newImageUri),
      name: newImageUri.split('/').pop(),
    });
    formData.append('name', name);
    formData.append('brand', brand);
    formData.append('price', price);
    formData.append('description', description);
    formData.append('category', category);
    formData.append('countInStock', countInStock);
    formData.append('richDescription', richDescription);
    formData.append('rating', rating);
    formData.append('numReviews', numReviews);
    formData.append('isFeatured', isFeatured);
    const config = {
      headers: {
        'Content-Type': 'multipart/form-data',
        Authorization: `Bearer ${token}`,
      },
    };

    if (item !== null) {
      axios
        .put(`${prefixUrl}/products/${item.id}`, formData, config)
        .then(res => {
          if (res.status === 200 || res.status === 201) {
            Toast.show({
              topOffset: 60,
              type: 'success',
              text1: 'Product successfuly updated',
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
    } else {
      axios
        .post(`${prefixUrl}/products`, formData, config)
        .then(res => {
          if (res.status === 200 || res.status === 201) {
            Toast.show({
              topOffset: 60,
              type: 'success',
              text1: 'New Product added',
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
    }
  };

  return (
    <View>
      <ScrollView>
        <FormContainer title={'Add product'}>
          <View style={styles.imageContainer}>
            <Image style={styles.image} source={{uri: mainImage}} />
            <TouchableOpacity onPress={ImagePicker} style={styles.imagePicker}>
              <Icon style={{color: 'white'}} name="camera" />
            </TouchableOpacity>
          </View>
          <TextInput
            mode={'outlined'}
            style={style.input}
            name={'brand'}
            id={'brand'}
            value={brand}
            label={'Brand'}
            onChangeText={text => setBrand(text)}
          />
          <TextInput
            mode={'outlined'}
            style={style.input}
            name={'name'}
            id={'name'}
            value={name}
            label={'Name'}
            onChangeText={text => setName(text)}
          />
          <TextInput
            mode={'outlined'}
            style={style.input}
            name={'price'}
            id={'price'}
            value={price}
            label={'Price'}
            keyboardType={'numeric'}
            onChangeText={text => setPrice(text)}
          />
          <TextInput
            mode={'outlined'}
            style={style.input}
            name={'stock'}
            id={'stock'}
            value={countInStock}
            label={'Count in Stock'}
            keyboardType={'numeric'}
            onChangeText={text => setCountInStock(text)}
          />
          <TextInput
            mode={'outlined'}
            style={style.input}
            name={'description'}
            id={'description'}
            value={description}
            label={'Description'}
            onChangeText={text => setDescription(text)}
          />

          <RNPickerSelect
            style={pickerSelectStyles}
            onValueChange={e => [setPickerValue(e), setCategory(e)]}
            items={categories}
          />
          {err ? <Text>{err}</Text> : null}
        </FormContainer>
      </ScrollView>
      <View style={style.bottom}>
        <Button
          textColor={'white'}
          buttonColor={'red'}
          onPress={() => props.navigation.navigate('Products')}>
          Cancel
        </Button>
        <Button
          textColor={'white'}
          buttonColor={'green'}
          onPress={() => addProduct()}>
          Confirm
        </Button>
      </View>
    </View>
  );
};
const pickerSelectStyles = StyleSheet.create({
  inputAndroid: {
    justifyContent: 'center',
    margin: 20,
    alignItems: 'center',
    fontSize: 16,
    paddingHorizontal: 10,
    paddingVertical: 8,
    borderWidth: 2,
    borderColor: 'black',
    borderRadius: 8,
    color: 'black',
    backgroundColor: 'white',
  },
});
const styles = StyleSheet.create({
  imageContainer: {
    width: 200,
    height: 200,
    borderStyle: 'solid',
    borderWidth: 1,
    padding: 10,
    justifyContent: 'center',
    borderRadius: 100,
    borderColor: 'gray',
    elevation: 5,
  },
  image: {
    width: '100%',
    height: '100%',
    borderRadius: 100,
  },
  imagePicker: {
    position: 'absolute',
    right: 5,
    bottom: 5,
    backgroundColor: 'grey',
    padding: 8,
    borderRadius: 100,
    elevation: 20,
  },
});

export default ProductsForm;
