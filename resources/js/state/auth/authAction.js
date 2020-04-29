export const loginRequest = (login) =>({
  type: 'LOGIN_REQUEST',
  payload: login
});

export const loginSuccess = () =>({
  type: 'LOGIN_SUCCESS',
});

export const loginFailure = () =>({
  type: 'LOGIN_FAILURE',
});
