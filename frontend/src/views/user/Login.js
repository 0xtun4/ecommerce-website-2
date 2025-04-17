import React, { useContext, useEffect } from "react";
import { StyleSheet, Text, View } from "react-native";
import { Button, TextInput } from "react-native-paper";
import FormContainer from "../../shared/FormContainer";
import style from "../../shared/Style";
import Error from "../../shared/Error";
import AuthGlobal from "../../context/store/AuthGlobal";
import { loginUser } from "../../context/actions/AuthActions";

const Login = props => {
  const context = useContext(AuthGlobal);
  const [email, setEmail] = React.useState('');
  const [password, setPassword] = React.useState('');
  const [error, setError] = React.useState('');

  useEffect(() => {
    if (context.stateUser.isAuthenticated === true) {
      props.navigation.navigate('UserProfile');
    }
  }, [context.stateUser.isAuthenticated]);

  const handleSumit = () => {
    const user = {
      email,
      password,
    };
    if (email === '' || password === '') {
      setError('Please fill in all fields');
    } else {
      loginUser(user, context.dispatch);
    }
  };

  return (
    <FormContainer title={'Login'}>
      <TextInput
        style={style.input}
        mode={'outlined'}
        id={'email'}
        label={'Enter email'}
        value={email}
        onChangeText={text => setEmail(text.toLowerCase())}
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
      <View style={styles.buttonGroup}>
        {error ? <Error message={error} /> : null}
        <Button onPress={() => handleSumit()}> Login</Button>
      </View>
      <View style={[styles.buttonGroup, {marginTop: 40}]}>
        <Text>Don't have an account yet?</Text>
        <Button onPress={() => props.navigation.navigate('Register')}>
          Register
        </Button>
      </View>
    </FormContainer>
  );
};
const styles = StyleSheet.create({
  buttonGroup: {
    width: '80%',
    alignItems: 'center',
  },
});
export default Login;
