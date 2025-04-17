import React from "react";
import { Dimensions, TouchableOpacity } from "react-native";
import ProductCard from "./ProductCard";

let {width} = Dimensions.get('window');

const ProductList = props => {
  const {item} = props;
  return (
    <TouchableOpacity

      style={{width: '50%'}}
      onPress={() => props.navigation.navigate('ProductDetail', {item: item})}>
      <ProductCard {...item} />
    </TouchableOpacity>
  );
};

export default ProductList;
