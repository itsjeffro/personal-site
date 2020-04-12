import React from 'react';
import { PlayersTable } from './components/PlayersTable';
import { Pagination } from '../../components/Pagination';

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
      sortColumn: null,
      sortOrder: null,
    };

    this.onPageClick = this.onPageClick.bind(this);
    this.onSortClick = this.onSortClick.bind(this);
  }

  /**
   * Load results once component has mounted.
   */
  componentDidMount() {
    const { sortColumn, sortOrder } = this.state;

    this.loadResults(1, sortColumn, sortOrder);
  }

  /**
   * Load results.
   */
  loadResults(page, column, order) {
    let queries = [
      {'name': 'per_page', 'value': this.state.perPage},
      {'name': 'page', 'value': page},
    ];

    if (column && order) {
      queries.push({ 'name': 'sort', 'value': `${column}:${order}` });
    }

    let urlQueries = queries.map(query => {
      return `${query.name}=${query.value}`
    });

    urlQueries = urlQueries.join('&');

    axios.request({
      method: 'GET',
      url: `/api/v1/player-stats?${urlQueries}`,
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
   * 
   * @param {object} event
   * @param {string} page
   */
  onPageClick(event, page) {
    event.preventDefault();

    window.scrollTo(0, 0);

    const { sortColumn, sortOrder } = this.state;

    this.loadResults(page, sortColumn, sortOrder);
  }

  /**
   * Update result sort/order.
   *
   * @param {object} event
   * @param {string} column
   */
  onSortClick(event, column) {
    event.preventDefault();

    const { sortOrder } = this.state;

    const order = sortOrder === 'asc' ? 'desc' : 'asc';

    this.loadResults(1, column, order);

    this.setState({ sortColumn: column, sortOrder: order });
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
              <div className="col-lg-10">
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
                  handleSortClick={ this.onSortClick }
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
