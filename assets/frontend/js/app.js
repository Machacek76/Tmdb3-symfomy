// assets/js/app.js

import React from 'react'
import ReactDOM from 'react-dom'
import { Route, Link, BrowserRouter as Router } from 'react-router-dom'
//import './index.css'
import Home from './route/index'
import Films from './route/films'
import People from './route/people'
import Serials from './route/serials'

import Menu from './Components/Menu'
import Footer from './Components/Footer'




const routing = (
  <Router>
    <div>
      <Menu />
      <div className="container pb-20">
        <div className="container-content">
          <Route path="/"   exact component={Home}    />
          <Route path="/lide"     component={People}  />
          <Route path="/filmy"    component={Films}   />
          <Route path="/serialy"  component={Serials} />
        </div>
      </div>
      <Footer />
    </div>
  </Router>
)
ReactDOM.render(routing, document.getElementById('root'))



