// assets/js/app.js
import React from 'react';
import ReactDOM from 'react-dom';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';

import ItemCard from './Components/ItemCard';
import MvieCard from './Components/MovieCard';

class App extends React.Component {
  constructor() {
    super();

    this.state = {
      entries: [],
      movieEntries : []
    };
  }

  componentDidMount() {
    fetch('/film/data')
      .then(response => response.json())
      .then(entries => {
        this.setState({
          entries
        });
      });
  }
  

  
  componentDidMount() {
    fetch('/api/film/all')
      .then(response => response.json())
      .then(entries => {
        this.setState({
          movieEntries
        });
      });
  }

  render() {
    return (
      <MuiThemeProvider>
        <div style={{ display: 'flex' }}>
          {this.state.entries.map(
            ({ id, author, avatarUrl, title, description }) => (
              <ItemCard
                key={id}
                author={author}
                title={title}
                avatarUrl={avatarUrl}
                style={{ flex: 1, margin: 10 }}
              >
                {description}
              </ItemCard>
            )
          )}
        </div>
        <div style={{ display: 'flex' }}>
          {this.state.entries.map(
            ({ id, author, avatarUrl, title, description }) => (
              <MovieCard
                key={id}
                author={author}
                title={title}
                avatarUrl={avatarUrl}
                style={{ flex: 1, margin: 10 }}
              >
                {description}
              </MovieCard>
            )
          )}
        </div>
      </MuiThemeProvider>
    ); 
  }
}

ReactDOM.render(<App />, document.getElementById('root'));