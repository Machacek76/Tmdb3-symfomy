import React from 'react';
import { NavLink } from 'react-router-dom';

class HpHero extends React.Component {
    constructor(props) {
        super(props);

        this.src = props.src;
        this.link = props.link;
        this.title = props.title;
    }


    render() {

        var img = <img src={this.src} className="hero-image" />

        if(this.link !== ''){
            img = <NavLink to={this.link} title={this.title}> { img } </NavLink>
        }


        return (
            <div className="row" >
                <div className="col-12">{img}</div>
            </div>
        );
    }
}
export default HpHero;


