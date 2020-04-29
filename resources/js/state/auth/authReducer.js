import authState from './authState';

const initialState = authState;

const authReducer = (state = initialState, action) => {
  switch(action.type) {
    case 'LOGIN_REQUEST':
      return {
        ...state,
        isLoggingIn: true,
        isLoggedIn: false,
        user: null,
      };

    case 'LOGIN_SUCCESS':
      return {
        ...state,
        isLoggingIn: false,
        isLoggedIn: true,
        user: action.payload,
      };

    case 'LOGIN_FAILURE':
      return {
        ...state,
        isLoggingIn: false,
        isLoggedIn: false,
        user: null,
      };

    default:
      return state;
  }
};

export default authReducer;
