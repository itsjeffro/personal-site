import React from 'react';
import PropTypes from 'prop-types';

const Alert = props => {
  const {
    dismissible,
    variant,
    message
  } = props;
  
  const classDismissible = dismissible ? ' alert-dismissible' : '';
  const variantType = 'alert alert-' + (variant ? variant : 'info');

  return (
    <div className={variantType + classDismissible}>
      {dismissible ? 
        <button type="button" className="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        : ''}

      {message || props.children}
    </div>
  )
};

Alert.propTypes = {
  dismissible: PropTypes.bool,
  type: PropTypes.string,
  message: PropTypes.string
};

export default Alert;