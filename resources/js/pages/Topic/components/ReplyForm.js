import React from 'react';

const ReplyForm = (props) => {
  const {
    errors,
    input,
    onInputChange,
    onReplyClick,
    topic
  } = props;

  const hasBodyError = errors && errors.body;

  return (
    <>
    <h5>Reply to conversation</h5>
    <div className="form-group">
      <textarea 
        className={ 'form-control' + (hasBodyError ? ' is-invalid' : '') }
        name="body"
        onChange={ e => onInputChange(e) }
        value={ input.body }
      />

      <div className="invalid-feedback">
        { hasBodyError ? errors.body[0] : '' }
      </div>
    </div>
    <button className="btn btn-primary" onClick={ e => onReplyClick(topic) }>Post</button>
  </>
  );
}

export default ReplyForm;
