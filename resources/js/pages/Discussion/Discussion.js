import React from 'react';
import jwt from 'jsonwebtoken';
import jwksClient from 'jwks-rsa';
import { Pagination } from '../../components/Pagination';
import { TopicsTable } from './components/TopicsTable';
import { TopicForm } from './components/TopicForm';
import TopicApi from '../../api/TopicApi';
import AuthService from '../../services/AuthService';
import { Redirect } from 'react-router-dom';

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
      },
      errors: null,
    };

    const client = jwksClient({
      jwksUri: '/.well-known/jwks.json',
    });

    this.auth = new AuthService(localStorage, jwt, client);
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
        window.scrollTo(0, 0);

        this.setState({
          input: {
            title: '',
            body: '',
          },
          errors: null,
        });

        this.loadResults(1);
      }, error => {
        this.setState({ errors: error.response.data.errors });
      })
  }

  /**
   * Render DOM.
   */
  render() {
    const {
      input,
      topics, 
      perPage,
      currentPage,
      errors,
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

                <TopicForm
                  input={ input }
                  errors={ errors }
                  onInputChange={ e => this.handleInputChange(e) }
                  onTopicClick={ this.handleTopicClick }
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
