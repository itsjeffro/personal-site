import React from 'react';

export default class Login extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      isLoggingIn: false,
      input: {
        email: '',
        password: '',
      },
    };

    this.handleLoginClick = this.handleLoginClick.bind(this);
  }

  componentDidMount() {
    const accessToken = localStorage.getItem('accessToken');

    console.log(accessToken);
  }

  handleInputChange(e) {
    const target = event.target;
    const value = target.type === 'checkbox' ? target.checked : target.value;
    const name = target.name;

    let input = Object.assign({}, this.state.input);

    input[name] = value;

    this.setState({ input: input });
  }

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

      this.setState({ isLoggingIn: false });
    }, error => {
      this.setState({ isLoggingIn: false });
    });
  }

  render() {
    const { isLoggingIn } = this.state;

    return (
      <>
        <div className="container">
          <div className="content">
            <div className="row justify-content-center">
              <div className="col-lg-8">
                <div className="card">
                  <div className="card-body">
                    <h2>Login</h2>

                    <div className="form-group">
                      <label htmlFor="exampleInputEmail1">E-mail</label>
                      <input
                        name="email"
                        type="email"
                        className="form-control"
                        id="exampleInputEmail1"
                        aria-describedby="emailHelp"
                        placeholder="E-mail"
                        onChange={e => this.handleInputChange(e)}
                      />
                    </div>
                    <div className="form-group">
                      <label htmlFor="exampleInputPassword1">Password</label>
                      <input
                        name="password"
                        type="password" 
                        className="form-control"
                        id="exampleInputPassword1" 
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
                    <a href="">Login via Steam</a>
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
