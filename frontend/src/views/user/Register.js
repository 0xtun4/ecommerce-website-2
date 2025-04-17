import React from "react";
import { ScrollView, Text, View } from "react-native";
import { Button, TextInput } from "react-native-paper";
import FormContainer from "../../shared/FormContainer";
import style from "../../shared/Style";
import Error from "../../shared/Error";
import axios from "axios";
import Toast from "react-native-toast-message";
import { prefixUrl } from "../../services/instance";

const Register = props => {
  const [email, setEmail] = React.useState('');
  const [name, setName] = React.useState('');
  const [phone, setPhone] = React.useState('');
  const [password, setPassword] = React.useState('');
  const [error, setError] = React.useState('');

  const handleSumit = () => {
    const user = {
      name: name,
      email: email,
      phone: phone,
      password: password,
      isAdmin: false,
    };

    axios
      .post(`${prefixUrl}/users/register`, user)
      .then(res => {
        if (res.status === 200) {
          setTimeout(() => {
            Toast.show({
              topOffset: 60,
              type: 'success',
              text1: 'Registration Successful',
              text2: 'Please Login into your account',
            });
            props.navigation.navigate('Login');
          }, 500);
        }
      })
      .catch(err => {
        Toast.show({
          topOffset: 60,
          type: 'error',
          text1: 'Something went wrong',
          text2: 'Please try again',
        });
      });

    if (email === '' || name === '' || phone === '' || password === '') {
      setError('Please fill in all fields');
    } else {
      setError('');
    }
  };

  return (
    <ScrollView>
      <FormContainer title={'Register'}>
        <TextInput
          style={style.input}
          mode={'outlined'}
          id={'name'}
          label={'Enter name'}
          value={name}
          onChangeText={text => setName(text)}
        />
        <TextInput
          style={style.input}
          mode={'outlined'}
          id={'email'}
          label={'Enter email'}
          value={email}
          onChangeText={text => setEmail(text.toLowerCase())}
        />
        <TextInput
          style={style.input}
          mode={'outlined'}
          id={'phone'}
          label={'Enter phone'}
          value={phone}
          onChangeText={text => setPhone(text)}
        />
        <TextInput
          id={'password'}
          style={style.input}
          mode={'outlined'}
          label={'Enter password'}
          value={password}
          secureTextEntry={true}
          onChangeText={text => setPassword(text)}
        />
        <View style={style.buttonGroup}>
          {error ? <Error message={error} /> : null}
          <Button onPress={() => handleSumit()}> Register</Button>
        </View>
        <View style={[style.buttonGroup, {marginTop: 40}]}>
          <Text>Already have an account?</Text>
          <Button onPress={() => props.navigation.navigate('Login')}>
            Login
          </Button>
        </View>
      </FormContainer>
    </ScrollView>
  );
};

export default Register;
