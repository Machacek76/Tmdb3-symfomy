import React from 'react';
import { NavLink } from 'react-router-dom';

class Moviecard extends React.Component {

  constructor(props) {
      super(props);

      this.media    = props.media;
      this.title    = props.title;
      this.overview = props.overview;
      this.genres   = props.genres;
      this.release  = props.release;

      this.trim = {
        zIndex: '4',
      }

      this.imgWrapper = {
        zIndex: '5'
      }

      console.log(props)
  }


  render() {

    return (
      <div className="card movie-card-sm mt-10" >
        <div className="card-horizontal">
          <div className="ratio-34-cont float-left ml-15 mt-15 mb-15" style={this.imgWrapper}>
            <div className="ration-34-cont--wrapper"></div>
            <img src={this.media} className="ratio-34-cont-img" alt="" />
          </div>
          <div className="card-body float-right">
            <h2>{this.title}</h2>
            <p className="card-text">{this.overview}</p>
          </div>
        </div>
        <div className="card-trim" style={this.trim} ></div>
        <div className="card-footer">
          <span className="badge badge-light">{this.release}</span>
          {this.genres.map(
            (genre) => (
              <span key={'g-'+genre.id} className="badge badge-light">{genre.cs_name}</span>
            )
          )}
        </div>
      </div>
    );
  }
}
export default Moviecard;