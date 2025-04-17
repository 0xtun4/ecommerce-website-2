import React from "react";
import { Dimensions, View } from "react-native";
import { Button } from "react-native-paper";

let {width} = Dimensions.get('window');

const CategoryBadget = props => {
  const {label} = props;
  return (
    <View>
      <Button
        type="elevated"
        mode="elevated"
        buttonColor={'#6d9ff2'}
        textColor="white">
        {label}
      </Button>
    </View>
  );
};

export default CategoryBadget;
