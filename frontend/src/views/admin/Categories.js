import React, { useEffect, useState } from "react";
import { Button, TextInput } from "react-native-paper";
import { Dimensions, FlatList, StyleSheet, Text, View } from "react-native";
import { prefixUrl } from "../../services/instance";
import style from "../../shared/Style";
import AsyncStorage from "@react-native-async-storage/async-storage";
import axios from "axios";

let {width} = Dimensions.get('window');

const Categories = props => {
  const [categories, setCategories] = useState([]);
  const [categoryName, setCategoryName] = useState('');
  const [token, setToken] = useState('');

  useEffect(() => {
    AsyncStorage.getItem('jwt')
      .then(res => {
        setToken(res);
      })
      .catch(error => console.log(error));

    axios
      .get(`${prefixUrl}/categories`)
      .then(res => setCategories(res.data))
      .catch(error => alert(`Error: ${error}`));

    return () => {
      setCategories();
      setToken();
    };
  }, []);

  const addCategory = () => {
    const category = {
      name: categoryName,
    };

    const config = {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    };
    console.log(category);

    axios
      .post(`${prefixUrl}/categories`, category, config)
      .then(res => setCategories([...categories, res.data]))
      .catch(error => alert('Error to load categories'));

    setCategoryName('');
  };

  const deleteCategory = id => {
    const config = {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    };

    axios
      .delete(`${prefixUrl}/categories/${id}`, config)
      .then(res => {
        const newCategories = categories.filter(item => item.id !== id);
        setCategories(newCategories);
      })
      .catch(error => alert('Error to load categories'));
  };

  const Item = props => {
    return (
      <View style={styles.item}>
        <Text>{props.item.label}</Text>
        <Button
          style={style.button}
          textColor={'white'}
          buttonColor={'red'}
          // onPress={deleteCategory(props.item.id)}
        >
          Delete
        </Button>
      </View>
    );
  };

  return (
    <View style={style.container}>
      <View style={{marginBottom: 60}}>
        <FlatList
          data={categories}
          renderItem={({item, index}) => <Item item={item} index={index} />}
        />
      </View>
      <View style={styles.bottom}>
        <TextInput
          style={styles.input}
          mode={'outlined'}
          textColor={'black'}
          value={categoryName}
          label="Add Category:"
          onChangeText={text => setCategoryName(text)}
        />
        <Button
          style={style.button}
          buttonColor={'green'}
          textColor={'white'}
          mode={'contained'}
          onPress={addCategory}>
          Submit
        </Button>
      </View>
    </View>
  );
};

const styles = StyleSheet.create({
  input: {
    width: '70%',
    marginRight: 10,
    height: 35,
  },
  bottom: {
    width: '100%',
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    position: 'absolute',
    bottom: 0,
    left: 0,
    backgroundColor: 'white',
    paddingVertical: 10,
    paddingHorizontal: 20,
  },
  item: {
    shadowColor: '#000',
    shadowOffset: {
      width: 0,
      height: 2,
    },
    shadowOpacity: 0.2,
    shadowRadius: 1,
    elevation: 1,
    padding: 5,
    margin: 5,
    backgroundColor: 'white',
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
    borderRadius: 5,
  },
});
export default Categories;
