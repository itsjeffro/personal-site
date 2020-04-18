import React from 'react';
import { Pagination } from '../../components/Pagination';
import { TopicsTable } from './components/TopicsTable';

class Discussion extends React.Component {
  constructor(props) {
    super(props);
    
    this.state = {
      perPage: 50,
      currentPage: 1,
      topics: {
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
      url: `/api/v1/topics?${urlQueries}`,
      responseType: 'json'
    })
    .then(response => {
      const topics = {
        data: response.data.data,
        total: response.data.total
      };

      this.setState({ 
        topics: topics,
        currentPage: response.data.current_page
      });
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
      topics, 
      perPage,
      currentPage,
    } = this.state;

    return (
      <>
        <div className="container">
          <div className="content">
            <div className="row justify-content-center">
              <div className="col-lg-10">
                <h2>Topics</h2>

                <p>Map suggestions</p>

                <TopicsTable 
                  rows={ topics.data }
                  handleSortClick={ this.onSortClick }
                />

                <Pagination
                  total={ topics.total }
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

export default Discussion;
