import React from "react";
import { ScrollView, StyleSheet, TouchableOpacity } from "react-native";
import CategoryBadget from "./CategoryBadget";

const CategoryFilter = props => {
  const {item, key} = props;
  return (
    <ScrollView style={styles.scrollView} bounces={true} horizontal={true}>
      <TouchableOpacity key={key} style={styles.listItem}>
        <CategoryBadget {...item} />
      </TouchableOpacity>
    </ScrollView>
  );
};

const styles = StyleSheet.create({
  scrollView: {
    marginTop: 10,
    marginLeft: 10,
    backgroundColor: 'gainsboro',
    marginHorizontal: 5,
    height: 50,
  },

  listItem: {
    flexDirection: 'row',
  },
});

export default CategoryFilter;
