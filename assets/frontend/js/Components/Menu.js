


import React from 'react';
import { NavLink } from 'react-router-dom';

class Menu extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
          error: null,
          isLoaded: false,
          items: []
        };
      }
    
      componentDidMount() {
        fetch("https://tmdb3.jsvyvoj.cz/api/menu")
          .then(res => res.json())
          .then(
            (result) => {
              this.setState({
                isLoaded: true,
                items: result.items
              });
            },
            (error) => {
              this.setState({
                isLoaded: true,
                error
              });
            }
          )
      }
    
      render() {
        const { error, isLoaded, items } = this.state;
        if (error) {
            return <div>Error: {error.message}</div>;
        } else if (!isLoaded) {
            return <div>Loading...</div>;
        } else {
            return (
                <div className="site-header navbar bd-navbar sticky-top">
                    <div className="container">
                        <ul className="nav">
                            {items.map(item => (
                                <li className="nav-item" key={item.id}>
                                    <NavLink activeClassName="active" className="nav-link " exact to={item.link} title={item.name} >
                                        <i className={ "fa " + item.iconClass}></i> {item.name}
                                    </NavLink>
                                </li>
                            ))}
                        </ul>
                    </div>
                </div>
            );
        }
    }

}

export default Menu;

