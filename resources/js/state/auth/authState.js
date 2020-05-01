import jwt from 'jsonwebtoken';
import jwksClient from 'jwks-rsa';
import AuthService from '../../services/AuthService';

const client = jwksClient({
  jwksUri: '/.well-known/jwks.json',
});

const auth = new AuthService(localStorage, jwt, client);

auth.check(user => {
  localStorage.setItem('user', JSON.stringify(user));
});

let user = localStorage.getItem('user');
let isLoggedIn = false;

if (typeof user === 'string' && user !== "") {
  user = JSON.parse(user);
  isLoggedIn = true;
}

const authState = {
  isLoggingIn: false,
  isLoggedIn: isLoggedIn,
  user: user,
};

export default authState;
