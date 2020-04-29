import React from 'react';
import { Link } from 'react-router-dom';
import Avatar from '../Avatar';

const NavbarUser = (props) => {
  const { user } = props;

  return (
    <>
      <a className="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <Avatar
          name={ user.name }
          imagePath={ user.picture }
        />
      </a>
      <div className="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
        <Link className="dropdown-item" to="/settings">Settings</Link>
        <div className="dropdown-divider"></div>
        <Link className="dropdown-item" to="/logout">Logout</Link>
      </div>
    </>
  )
};

export default NavbarUser;
