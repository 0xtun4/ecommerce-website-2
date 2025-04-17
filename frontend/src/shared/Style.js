import { Dimensions, StyleSheet } from "react-native";

let {width, height} = Dimensions.get('window');
const style = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: 'white',
  },
  body: {
    width: Dimensions.get('window').width - 90,
    flexDirection: 'row',
    position: 'relative',
    justifyContent: 'space-between',
    right: 10,
  },
  title: {
    fontSize: 20,
    fontWeight: 'bold',
    color: 'black',
    padding: 10,
  },
  input: {
    width: '90%',
    margin: 10,
  },

  text: {
    color: 'black',
    fontSize: 16,
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

  top: {
    width: '100%',
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    position: 'relative',
    top: 0,
    left: 0,
    backgroundColor: 'white',
    paddingVertical: 10,
    paddingHorizontal: 20,
  },

  image: {
    width: 90,
    height: 90,
  },

  price: {
    fontSize: 18,
    fontWeight: 'bold',
    color: 'red',
  },
  listCartItems: {
    borderBottomWidth: 0.5,
    borderStyle: 'dotted',
    borderColor: 'gray',
    flexDirection: 'row',
    alignItems: 'center',
    position: 'relative',
    bottom: 0,
    left: 0,
  },

  button: {
    borderRadius: 10,
    marginLeft: 'auto',
    width: 100,
  },

  buttonGroup: {
    width: '80%',
    alignItems: 'center',
  },
  spinner: {
    height: height / 2,
    alignItems: 'center',
    justifyContent: 'center',
  },
});

export default style;
