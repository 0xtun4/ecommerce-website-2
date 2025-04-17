import React from "react";
import { Dimensions, FlatList, StyleSheet, View } from "react-native";
import ProductList from "./ProductList";

var {width} = Dimensions.get('window');

const SearchedProduct = props => {
  const {productsFiltered} = props;
  return (
    <View>
      <FlatList
        numColumns={2}
        data={productsFiltered}
        renderItem={({item}) => (
          <ProductList
            navigation={props.navigation}
            key={item.brand}
            item={item}
          />
        )}
        keyExtractor={item => item.name}
      />
    </View>
  );
};

const styles = StyleSheet.create({
  center: {
    justifyContent: 'center',
    alignItems: 'center',
    height: 100,
  },
});

export default SearchedProduct;
