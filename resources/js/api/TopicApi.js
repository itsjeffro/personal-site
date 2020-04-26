class TopicApi {
  constructor(httpClient) {
    this.httpClient = httpClient;
  }

  getTopics(urlQueries) {
    return this.httpClient
      .request({
        method: 'GET',
        url: `/api/v1/topics?${urlQueries}`,
        responseType: 'json'
      });
  }

  getTopicById(topic) {
    let topicId = parseInt(topic);

    return this.httpClient
      .request({
        method: 'GET',
        url: `/api/v1/topics/${topicId}`,
        responseType: 'json'
      });
  }

  getRepliesByTopicId(topic, urlQueries) {
    let topicId = parseInt(topic);

    return this.httpClient
      .request({
        method: 'GET',
        url: `/api/v1/topics/${topicId}/replies?${urlQueries}`,
        responseType: 'json'
      });
  }

  createTopic(accessToken, data) {
    return this.httpClient
      .request({
        headers: {
          Authorization: `Bearer ${accessToken}`
        },
        method: 'POST',
        url: `/api/v1/topics`,
        responseType: 'json',
        data: data
      });
  }

  createTopicReply(accessToken, topic, data) {
    let topicId = parseInt(topic);

    return this.httpClient
      .request({
        headers: {
          Authorization: `Bearer ${accessToken}`
        },
        method: 'POST',
        url: `/api/v1/topics/${topicId}/replies`,
        responseType: 'json',
        data: data
      });
  }
}

export default TopicApi;
