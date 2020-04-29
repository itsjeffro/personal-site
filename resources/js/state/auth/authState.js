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

if (typeof user === 'string' && user !== "") {
  user = JSON.parse(user);
}

const authState = {
  isLoggingIn: false,
  isLoggedIn: false,
  user: user,
};

export default authState;
