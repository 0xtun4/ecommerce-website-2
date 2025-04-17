import {Platform} from "react-native";

export let prefixUrl = 'https://rn.tunatkit.me/api/v1';
// {
//   Platform.OS === 'android'
//     ? (prefixUrl = process.env.API_URL)
//     : (prefixUrl = '');
// }
export const instance = fetch(prefixUrl, {
  headers: {
    Accept: 'application/json',
    'Content-Type': 'application/json',
  },
});
