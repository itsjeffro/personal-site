import React from 'react';
import { Link } from 'react-router-dom';
import moment from 'moment';
import { Pagination } from '../../components/Pagination';

export default class Topic extends React.Component {
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
      }
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
    let queries = [
      {'name': 'per_page', 'value': this.state.perPage},
      {'name': 'page', 'value': page},
    ];

    let urlQueries = queries.map(query => {
      return `${query.name}=${query.value}`
    });

    const { topic } = this.props.match.params;

    urlQueries = urlQueries.join('&');

    axios.request({
      method: 'GET',
      url: `/api/v1/topics/${topic}`,
      responseType: 'json'
    })
    .then(response => {
      this.setState({ topic: response.data });
    });

    axios.request({
      method: 'GET',
      url: `/api/v1/topics/${topic}/replies?${urlQueries}`,
      responseType: 'json'
    })
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
      topic,
      replies,
      perPage,
      currentPage,
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

                <div className="p-3 mb-3 border border-top border-left border-bottom border-right rounded">
                  <p>
                    <span className="font-weight-bold">{ topic.author ? topic.author.name : '' } - </span>
                    <span className="text-secondary" title={ topic.created_at + ' GMT' }>{ topicCreatedAt }</span>
                  </p>

                  { topic.body }
                </div>

                <h5>Replies</h5>

                { replies.data.length === 0 ? 'Be the first to reply' : '' }

                {replies.data.map(reply => {
                  let replyCreatedAt = moment.utc(reply.created_at).toDate();

                  replyCreatedAt = moment(replyCreatedAt).format('DD, MMM YYYY - hh:mm A');
                  
                  return (
                    <div key={reply.id} className="p-3 mb-3 border border-top border-left border-bottom border-right rounded">
                      <p>
                        <span className="font-weight-bold">{ reply.author ? reply.author.name : '' } - </span>
                        <span className="text-secondary" title={ reply.created_at + ' GMT' }>{ replyCreatedAt }</span>
                      </p>
    
                      { reply.body }
                    </div>
                  )
                })}

                <Pagination
                  total={ replies.total }
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
