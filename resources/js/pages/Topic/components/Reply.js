import React from 'react';

export const Reply = (props) => {
  const {
    authorName,
    createdAt,
    createdAtGMT,
    body
  } = props;

  return (
    <div className="p-3 mb-3 border border-top border-left border-bottom border-right rounded">
      <p>
        <span className="font-weight-bold">{ authorName } - </span>
        <span className="text-secondary" title={ createdAtGMT }>{ createdAt }</span>
      </p>

      { body }
    </div>
  )
};
