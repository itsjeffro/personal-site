import React from 'react';

export const TopicForm = (props) => {
  const {
    input,
    errors,
    onTopicClick,
    onInputChange
  } = props;

  return (
    <>
      <h5>New topic</h5>

      <div className="form-group">
        <input
          type="text"
          className="form-control"
          name="title"
          onChange={ onInputChange }
          value={ input.title }
        />

        { errors && errors.title ? errors.title[0] : '' }
      </div>
      <div className="form-group">
        <textarea
          className="form-control"
          name="body"
          onChange={ onInputChange }
          value={ input.body }
        />

        { errors && errors.body ? errors.body[0] : '' }
      </div>
      <button className="btn btn-primary" onClick={ onTopicClick }>Post</button>
    </>
  )
}