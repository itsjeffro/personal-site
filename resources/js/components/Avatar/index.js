import React from 'react';

const Avatar = (props) => {
  const { name, imagePath } = props;

  return (
    <img 
      className="rounded" 
      src={ imagePath ? imagePath : '/images/player_default.jpg'} 
      width="25" 
      height="25"
      alt={ name } 
      title={ name + ' avatar' } 
    />
  )
}

export default Avatar;
