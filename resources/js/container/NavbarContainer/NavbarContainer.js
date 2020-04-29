import React from 'react';
import { connect } from 'react-redux';

import Navbar from '../../components/Navbar';

const NavbarContainer = (props) => {
  const { user } = props;

  return (
    <Navbar user={ user } />
  )
}

const mapStateToProps = (state) => {
  return state.auth;
}

export default connect(mapStateToProps)(NavbarContainer);
