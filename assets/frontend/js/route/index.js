
import React from 'react'

import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';

import HpHero from '../Components/HpHero'
import MovieCard from '../Components/MovieCard'




class Index extends React.Component {
    constructor(props) {
            super(props);
            this.state = {
            error: null,
            isLoaded: false,
            items: []
        };
    }
    
    componentDidMount() {
        fetch("https://tmdb3.jsvyvoj.cz/api/index")
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

            var hero = ''
            if(items.hasOwnProperty('hero')){
                hero = <HpHero
                            src={items.hero.src}
                            link={items.hero.link}
                            title={items.hero.title}
                        />
            }
            


            return (
                <div className="content">
                    {hero}
                    
                    <div className='row'>
                        {items.films.map(
                            (movie) => (
                                <div className='col-12 col-md-6' key={movie.id}>
                                    <MovieCard
                                        key={movie.id}
                                        title={movie.title}
                                        media={ !movie.poster_path ? '/image/poster-placeholder.jpg' : 'https://image.tmdb.org/t/p/w500' + movie.poster_path}
                                        overview={movie.overview}
                                        genres={movie.genres}
                                        release={movie.release_date}
                                    >
                                    </MovieCard>
                                </div>
                            )
                        )}
                    </div>
                </div>
            );
        }
    }
}

function getHero(){

};
export default Index;
