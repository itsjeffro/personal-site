import React from 'react';
import { Link } from 'react-router-dom';
import { connect } from 'react-redux';
import moment from 'moment';

import { Pagination } from '../../components/Pagination';
import { Reply } from './components/Reply';
import TopicApi from '../../api/TopicApi';
import ReplyForm from './components/ReplyForm';

class Topic extends React.Component {
  constructor(props) {
    super(props);
    
    this.state = {
      perPage: 50,
      currentPage: 1,
      topic: {
        title: null,
        author: null,
      },
      replies: {
        data: [],
        total: 0,
      },
      input: {
        body: '',
      },
      errors: null,
    };

    this.topicApi = new TopicApi(axios);
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
  loadResults = (page) => {
    const { topic } = this.props.match.params;

    let queries = [
      {'name': 'per_page', 'value': this.state.perPage},
      {'name': 'page', 'value': page},
    ];

    let urlQueries = queries.map(query => {
      return `${query.name}=${query.value}`
    });

    urlQueries = urlQueries.join('&');

    this.topicApi
      .getTopicById(topic)
      .then(response => {
        this.setState({ topic: response.data });
      });

    this.topicApi
      .getRepliesByTopicId(topic, urlQueries)
      .then(response => {
        this.setState({
          replies: response.data,
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
  handlePageClick = (event, page) => {
    event.preventDefault();

    window.scrollTo(0, 0);

    this.loadResults(page);
  }

  /**
   * Handles input change on input fields.
   *
   * @param {*} e
   */
  handleInputChange = (e) => {
    const target = event.target;
    const value = target.type === 'checkbox' ? target.checked : target.value;
    const name = target.name;

    let input = Object.assign({}, this.state.input);

    input[name] = value;

    this.setState({ input: input });
  }

  /**
   * Save reply on click.
   * 
   * @param {object} topic
   */
  handleReplyClick = (topic) => {
    const accessToken = localStorage.getItem('accessToken');

    this.topicApi
      .createTopicReply(accessToken, topic.id, {
        body: this.state.input.body
      })
      .then((response) => {
        this.loadResults(1);
        
        this.setState({ 
          errors: null, 
          input: {
            body: ''
          } 
        });
      }, error => {
        this.setState({ errors: error.response.data.errors });
      });
  }


  /**
   * Render DOM.
   */
  render() {
    const { auth } = this.props;
  
    const { 
      topic,
      replies,
      perPage,
      currentPage,
      errors,
      input,
    } = this.state;

    let topicCreatedAt = moment.utc(topic.created_at).toDate();

    topicCreatedAt = moment(topicCreatedAt).format('DD, MMM YYYY - hh:mm A');

    return (
      <>
        <div className="pt-2 pb-2 bg-secondary text-white">
          <div className="container">
            <div className="row justify-content-center">
              <div className="col-lg-10">
                <Link className="text-white" to="/discussions">Discussions</Link>
                <span> > { topic.title }</span>
              </div>
            </div>
          </div>
        </div>

        <div className="container">
          <div className="content">
            <div className="row justify-content-center">
              <div className="col-lg-10">
                <h2>{ topic.title } </h2>

                <Reply
                  authorName={ topic.author ? topic.author.name : '' }
                  authorImage={ topic.author && topic.author.player ? topic.author.player.avatar : '' }
                  createdAt={ topicCreatedAt }
                  createdAtGMT={ topic.created_at + ' GMT' }
                  body={ topic.body }
                />

                <h5>Replies</h5>

                { replies.data.length === 0 ? 'Be the first to reply' : '' }

                {replies.data.map((reply) => {
                  let replyCreatedAt = moment.utc(reply.created_at).toDate();

                  replyCreatedAt = moment(replyCreatedAt).format('DD, MMM YYYY - hh:mm A');
                  
                  return (
                    <Reply
                      key={ 'reply_' + reply.id }
                      authorName={ reply.author ? reply.author.name : '' }
                      authorImage={ reply.author && reply.author.player ? reply.author.player.avatar : '' }
                      createdAt={ replyCreatedAt }
                      createdAtGMT={ reply.created_at + ' GMT' }
                      body={ reply.body }
                    />
                  )
                })}

                <Pagination
                  total={ replies.total }
                  perPage={ perPage }
                  currentPage={ currentPage }
                  handlePageClick={ this.handlePageClick }
                  centerPagination
                />

                { auth.isLoggedIn ?
                  <ReplyForm
                    errors={ errors }
                    input={ input }
                    onInputChange={ this.handleInputChange }
                    onReplyClick={ this.handleReplyClick}
                    topic={ topic }
                  /> : '' }
              </div>
            </div>
          </div>
        </div>
      </>
    );
  }
}

const mapStateToProps = (state) => {
  return { auth: state.auth };
};

export default connect(mapStateToProps)(Topic);
