import React from 'react';
import { Pagination } from '../../components/Pagination';
import { TopicsTable } from './components/TopicsTable';
import TopicApi from '../../api/TopicApi';

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
      input: {
        title: '',
        body: '',
      }
    };

    this.topicApi = new TopicApi(axios);

    this.handleTopicClick = this.handleTopicClick.bind(this);
    this.handlePageClick = this.handlePageClick.bind(this);
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
    let queries = [
      {'name': 'per_page', 'value': this.state.perPage},
      {'name': 'page', 'value': page},
    ];

    let urlQueries = queries.map(query => {
      return `${query.name}=${query.value}`
    });

    urlQueries = urlQueries.join('&');

    this.topicApi
      .getTopics(urlQueries)
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
   * Handles input change on input fields.
   *
   * @param {*} e
   */
  handleInputChange(e) {
    const target = event.target;
    const value = target.type === 'checkbox' ? target.checked : target.value;
    const name = target.name;

    let input = Object.assign({}, this.state.input);

    input[name] = value;

    this.setState({ input: input });
  }

  /**
   * Update page results on page click.
   * 
   * @param {object} event
   * @param {string} page
   */
  handlePageClick(event, page) {
    event.preventDefault();

    window.scrollTo(0, 0);

    this.loadResults(page);
  }

  /**
   * Creates new topic.
   */
  handleTopicClick() {
    const data = this.state.input;
    const accessToken = localStorage.getItem('accessToken');
  
    this.topicApi
      .createTopic(accessToken, data)
      .then(response => {
        console.log(response);
      }, error => {
        console.log(error);
      })
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
                  handlePageClick={ this.handlePageClick }
                  centerPagination
                />

                <div>
                  <h5>New topic</h5>
                  <div className="form-group">
                    <input type="text" className="form-control" name="title" onChange={ e => this.handleInputChange(e) } />
                  </div>
                  <div className="form-group">
                    <textarea className="form-control" name="body" onChange={ e => this.handleInputChange(e) }></textarea>
                  </div>
                  <button className="btn btn-primary" onClick={ this.handleTopicClick }>Post</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </>
    );
  }
}

export default Discussion;
