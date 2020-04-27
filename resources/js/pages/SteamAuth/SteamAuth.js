import React from 'react';
import jwt from 'jsonwebtoken';
import jwksClient from 'jwks-rsa';
import AuthService from '../../services/AuthService';
import Alert from '../../components/Alert';

export default class SteamAuth extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      steamPersona: null,
      isSteamAuthValidated: false,
      isSteamAuthValid: false,
    }

    const client = jwksClient({
      jwksUri: '/.well-known/jwks.json',
    });

    this.auth = new AuthService(localStorage, jwt, client);
  }

  /**
   * Check authenticated user.
   */
  componentDidMount() {
    const urlQueries = this.props.location.search;
  
    axios.request({
      method: 'GET',
      url: '/steam/authenticate' + urlQueries,
      responseType: 'json'
    })
    .then(response => {
      const accessToken = response.data.access_token;

      localStorage.setItem('accessToken', accessToken);

      this.auth.check(user => {
        this.setState({ user: user });
          
        localStorage.setItem('user', JSON.stringify(user));
      });

      this.setState({
        steamPersona: response.data.steam_persona,
        isSteamAuthValidated: true,
        isSteamAuthValid: true,
      });
    }, error => {
      this.setState({
        isSteamAuthValidated: true,
        isSteamAuthValid: false,
      });
    });
  }

  render() {
    const { steamPersona, isSteamAuthValid, isSteamAuthValidated } = this.state;

    let variant = "info";
    let message = "Validating your Steam login...";

    if (isSteamAuthValidated && isSteamAuthValid) {
      variant = "success";
      message = `Successfully validated your Steam login. Welcome, ${steamPersona}!`;
    }

    if (isSteamAuthValidated && !isSteamAuthValid) {
      variant = "danger";
      message = "We could not validate your Steam login.";
    }

    return (
      <>
        <div className="container">
          <div className="content">
            <div className="row justify-content-center">
              <div className="col-lg-8">
                <h2>Steam Login</h2>

                <Alert variant={ variant }>{ message }</Alert>
              </div>
            </div>
          </div>
        </div>
      </>
    )
  }
}
