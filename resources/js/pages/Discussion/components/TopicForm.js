import React from 'react';

export const TopicForm = (props) => {
  const {
    input,
    errors,
    onTopicClick,
    onInputChange
  } = props;

  const hasTitleError = errors && errors.title;
  const hasBodyError = errors && errors.body;

  return (
    <>
      <h5>New topic</h5>

      <div className="form-group">
        <label htmlFor="title">Title</label>
        <input
          id="title"
          type="text"
          className={ 'form-control' + (hasTitleError ? ' is-invalid' : '') }
          name="title"
          onChange={ onInputChange }
          value={ input.title }
        />

        <div class="invalid-feedback">
          { hasTitleError ? errors.title[0] : '' }
        </div>
      </div>
      <div className="form-group">
        <label htmlFor="body">Body</label>
        <textarea
          id="body"
          className={ 'form-control' + (hasBodyError ? ' is-invalid' : '') }
          name="body"
          onChange={ onInputChange }
          value={ input.body }
        />

        <div class="invalid-feedback">
          { hasBodyError ? errors.body[0] : '' }
        </div>
      </div>
      <button className="btn btn-primary" onClick={ onTopicClick }>Post</button>
    </>
  )
}