import React from 'react';
import { Redirect } from 'react-router-dom';
import Alert from '../../components/Alert';

export default class Login extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      isLoggingIn: false,
      isLoggedIn: false,
      user: {
        name: '',
        picture: '',
      },
      input: {
        email: '',
        password: '',
      },
      errors: null,
    };

    this.handleLoginClick = this.handleLoginClick.bind(this);
  }

  /**
   * Check authenticated user.
   */
  componentDidMount() {
    //
  }

  /**
   * Handle input changes and store them in state.
   *
   * @param {object} event 
   */
  handleInputChange(event) {
    const target = event.target;
    const value = target.type === 'checkbox' ? target.checked : target.value;
    const name = target.name;

    let input = Object.assign({}, this.state.input);

    input[name] = value;

    this.setState({ input: input });
  }

  /**
   * Handle login click.
   */
  handleLoginClick() {
    const { input } = this.state;

    this.setState({ isLoggingIn: true });

    axios.request({
      method: 'POST',
      url: `/api/login`,
      responseType: 'json',
      data: {
        email: input.email,
        password: input.password,
      }
    })
    .then(response => {
      const { access_token } = response.data;

      localStorage.setItem('accessToken', access_token);

      this.setState({ isLoggingIn: false, isLoggedIn: true });
    }, error => {
      this.setState({ isLoggingIn: false, errors: error.response.data.error });
    });
  }

  render() {
    const {
      errors,
      isLoggingIn, 
      isLoggedIn
    } = this.state;

    if (isLoggedIn) {
      return <Redirect to="/" />
    }

    return (
      <>
        <div className="container">
          <div className="content">
            <div className="row justify-content-center">
              <div className="col-lg-8">
                <div className="card">
                  <div className="card-body">
                    <h2>Login</h2>

                    { errors ? <Alert variant="danger">We could not verify your credentials.</Alert> : '' }

                    <div className="form-group">
                      <label htmlFor="email">E-mail</label>
                      <input
                        name="email"
                        type="email"
                        className="form-control"
                        id="email"
                        aria-describedby="emailHelp"
                        placeholder="E-mail"
                        onChange={e => this.handleInputChange(e)}
                      />
                    </div>
                    <div className="form-group">
                      <label htmlFor="password">Password</label>
                      <input
                        name="password"
                        type="password" 
                        className="form-control"
                        id="password" 
                        placeholder="Password"
                        onChange={e => this.handleInputChange(e)}
                      />
                    </div>
                    <button 
                      type="submit"
                      className="btn btn-primary" 
                      onClick={this.handleLoginClick}
                    >{ isLoggingIn ? 'Logging in ...' : 'Login' }</button>
                  </div>

                  <div className="card-footer">
                    <a href="/steam/login">Login via Steam</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </>
    )
  }
}
