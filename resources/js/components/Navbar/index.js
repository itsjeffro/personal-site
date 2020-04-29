import React from 'react';
import { NavLink, Link } from "react-router-dom";
import NavbarUser from './NavbarUser';

const Navbar = (props) => {
  const { user } = props;

  return (
    <nav className="navbar navbar-expand-lg navbar-dark bg-primary">
      <a className="navbar-brand" href="/">Itsjeffro.com</a>

      <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span className="navbar-toggler-icon"></span>
      </button>
      
      <div className="collapse navbar-collapse" id="navbarNav">
        <ul className="nav navbar-nav">
          <li className="nav-item">
            <NavLink exact className="nav-link" to="/">Player board</NavLink>
          </li>

          <li className="nav-item">
            <NavLink className="nav-link" to="/maps">Maps</NavLink>
          </li>

          <li className="nav-item">
            <NavLink className="nav-link" to="/discussions">Discussions</NavLink>
          </li>
        </ul>

        <ul className="nav navbar-nav ml-auto">
          <li className="nav-item dropdown">
            { user ? <NavbarUser user={ user } /> : <Link className="nav-link" to="/login">Login</Link> }
          </li>
        </ul>
      </div>
    </nav>
  )
}

export default Navbar;
