import { jwtDecode } from "jwt-decode";
import AsyncStorage from "@react-native-async-storage/async-storage";
import Toast from "react-native-toast-message";
import { prefixUrl } from "../../services/instance";

export const SET_CURRENT_USER = 'SET_CURRENT_USER';

export const loginUser = (user, dispatch) => {
  fetch(`${prefixUrl}/users/login`, {
    method: 'POST',
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(user),
  })
    .then(res => res.json())
    .then(data => {
      if (data) {
        const token = data.token;
        AsyncStorage.setItem('jwt', token);
        const decoded = jwtDecode(token);
        dispatch(setCurrentUser(decoded, token));
      } else {
        logoutUser(dispatch);
        Toast.show({
          type: 'error',
          text1: 'Error',
          text2: data.message,
        });
      }
    })
    .catch(err => {
      Toast.show({
        topOffset: 60,
        type: 'error',
        text1: 'Please provide correct credentials',
        text2: "Email or password doesn't match",
      });
      logoutUser(dispatch);
    });
};

export const getUserProfile = id => {
  fetch(`${prefixUrl}/user/${id}`, {
    method: 'GET',
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({id}),
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        console.log(data);
      } else {
        Toast.show({
          type: 'error',
          text1: 'Error',
          text2: data.message,
        });
      }
    })
    .catch(err => {
      Toast.show({
        topOffset: 60,
        type: 'error',
        text1: 'Error',
        text2: err.message,
      });
    });
};

export const logoutUser = dispatch => {
  AsyncStorage.removeItem('jwt');
  dispatch(setCurrentUser({}));
};

export const setCurrentUser = (decoded, token) => {
  return {
    type: SET_CURRENT_USER,
    payload: decoded,
    token,
  };
};
