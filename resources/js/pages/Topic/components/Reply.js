import React from 'react';
import Avatar from '../../../components/Avatar';

export const Reply = (props) => {
  const {
    authorName,
    authorImage,
    createdAt,
    createdAtGMT,
    body
  } = props;

  return (
    <div className="p-2 mb-3 border border-top border-left border-bottom border-right rounded">
      <div className="d-flex bd-highlight">
        <div className="p-2">
          <Avatar
            name={ authorName }
            imagePath={ authorImage }
          />
        </div>
        <div className="p-2 flex-grow-1">
          <p>
            <span className="font-weight-bold">{ authorName } - </span>
            <span className="text-secondary" title={ createdAtGMT }>{ createdAt }</span>
          </p>

          { body }
        </div>
      </div>
    </div>
  )
};
