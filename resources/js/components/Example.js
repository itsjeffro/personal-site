import React from 'react';
import ReactDOM from 'react-dom';

class App extends React.Component {
  constructor(props) {
    super(props);
    
    this.state = {
      players: [],
    };
  }

  componentDidMount() {
    axios.request({
      method: 'GET',
      url: '/api/v1/players',
      responseType: 'json'
    })
    .then(response => {
      this.setState({ players: response.data.data });
    });
  }

  render() {
    return (
      <div className="container">
        <div className="row justify-content-center">
          <div className="col-md-8">
            <h1>Jeff's Awesome Server</h1>

            <p>The server hosts Counter-strike 1.6 via steam. Server: <span className="font-weight-bold">3.24.138.157:27015</span></p>

            <h2>Players</h2>

            <table className="table">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Player name</th>
                  <th scope="col">Kills</th>
                  <th scope="col">Deaths</th>
                  <th scope="col" className="text-right">Last updated</th>
                </tr>
              </thead>
              <tbody>
                {this.state.players.map(player => (
                  <tr key={player.id}>
                    <td>
                      {player.id}
                    </td>
                    <td>
                      {player.player_name}
                    </td>
                    <td>
                      {player.stats.kills}
                    </td>
                    <td>
                      {player.stats.deaths}
                    </td>
                    <td className="text-right">
                      {player.updated_at}
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    );
  }
}

export default App;

if (document.getElementById('app')) {
  ReactDOM.render(<App />, document.getElementById('app'));
}
