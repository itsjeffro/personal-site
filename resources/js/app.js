/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router, Switch, Route } from "react-router-dom";
import { Navbar } from './components/Navbar';
import Home from './pages/Home';
import Maps from './pages/Maps';
import Discussion from './pages/Discussion';
import Topic from './pages/Topic';
import Login from './pages/Login/Login';
import SteamAuth from './pages/SteamAuth';

if (document.getElementById('app')) {
  ReactDOM.render(
    <Router>
      <>
        <Navbar />

        <Switch>
          <Route path="/steam/auth" component={ SteamAuth } />
          <Route path="/discussions/topics/:topic" component={ Topic } />
          <Route path="/discussions" component={ Discussion } />
          <Route path="/maps" component={ Maps } />
          <Route path="/login" component={ Login } />
          <Route path="/" exact component={ Home } />
        </Switch>
      </>
    </Router>,
    document.getElementById('app')
  );
}