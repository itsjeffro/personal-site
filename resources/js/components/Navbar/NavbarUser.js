import React from 'react';
import { Link } from 'react-router-dom';

const NavbarUser = (props) => {
  const { user } = props;

  return (
    <>
      <span className="text-white">Welcome, {user.name}</span> - <Link className="text-white" to="/logout">Logout</Link>
    </>
  )
};

export default NavbarUser;
