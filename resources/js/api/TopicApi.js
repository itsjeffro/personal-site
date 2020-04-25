class TopicApi {
  constructor(httpClient) {
    this.httpClient = httpClient;
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
