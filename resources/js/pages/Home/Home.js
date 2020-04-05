import React from 'react';
import { PlayersTable } from './components/PlayersTable';
import { Pagination } from '../../components/Pagination';
import { Navbar } from '../../components/Navbar';

class Home extends React.Component {
  constructor(props) {
    super(props);
    
    this.state = {
      perPage: 50,
      currentPage: 1,
      players: {
        data: [],
        total: 0,
      },
    };

    this.onPageClick = this.onPageClick.bind(this);
  }

  /**
   * Load results once component has mounted.
   */
  componentDidMount() {
    this.loadResults(1);
  }

  /**
   * Load results.
   */
  loadResults(page) {
    axios.request({
      method: 'GET',
      url: '/api/v1/players?per_page=' + this.state.perPage + '&page=' + page,
      responseType: 'json'
    })
    .then(response => {
      const players = {
        data: response.data.data,
        total: response.data.meta.total
      };

      this.setState({ players: players, currentPage: response.data.meta.current_page });
    });
  }

  /**
   * Update page results on page click.
   */
  onPageClick(event, page) {
    event.preventDefault();

    window.scrollTo(0, 0);

    this.loadResults(page);
  }

  /**
   * Render DOM.
   */
  render() {
    const { 
      players, 
      perPage,
      currentPage,
    } = this.state;

    return (
      <>
        <div className="container">
          <div className="content">
            <div className="row justify-content-center">
              <div className="col-lg-9">
                <p>The server hosts Counter-Strike 1.6 on Steam. Server: <span className="font-weight-bold">13.55.196.137:27015</span></p>

                <h2>Players</h2>

                <div className="row">
                  <div className="col-md-4">
                    <p>
                      Total that have joined: { players.total }
                    </p>
                  </div>
                </div>

                <PlayersTable 
                  players={ players.data }
                />

                <Pagination
                  total={ players.total }
                  perPage={ perPage }
                  currentPage={ currentPage }
                  handlePageClick={ this.onPageClick }
                  centerPagination
                />
              </div>
            </div>
          </div>
        </div>
      </>
    );
  }
}

export default Home;
