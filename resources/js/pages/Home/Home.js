import React from 'react';
import { PlayersTable } from './components/PlayersTable';
import { Pagination } from '../../components/Pagination';

class Home extends React.Component {
  constructor(props) {
    super(props);
    
    this.state = {
      players: {
        data: [],
        total: 0,
      },
    };
  }

  componentDidMount() {
    axios.request({
      method: 'GET',
      url: '/api/v1/players?per_page=100',
      responseType: 'json'
    })
    .then(response => {
      const players = {
        data: response.data.data,
        total: response.data.meta.total
      };

      this.setState({ players: players });
    });
  }

  render() {
    return (
      <>
        <nav className="navbar navbar-dark bg-primary">
          <a className="navbar-brand" href="/">Itsjeffro.com</a>

          <form className="form-inline">
            <input className="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" />
            <button className="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
          </form>
        </nav>

        <div className="container">
          <div className="content">
            <div className="row justify-content-center">
              <div className="col-md-8">
                <p>The server hosts Counter-Strike 1.6 on Steam. Server: <span className="font-weight-bold">3.24.138.157:27015</span></p>

                <h2>Players</h2>

                <div className="row">
                  <div className="col-md-4">
                    <p>
                      Total that have joined: { this.state.players.total }
                    </p>
                  </div>
                </div>

                <PlayersTable players={this.state.players.data} />

                <Pagination total={this.state.players.total} />
              </div>
            </div>
          </div>
        </div>
      </>
    );
  }
}

export default Home;
