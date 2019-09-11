import React, {Component} from 'react'
import MovieGenreBadge from '../components/MovieGenreBadge'
import moment from 'moment'
import {Link} from 'react-router-dom'
import MovieService from '../services/MovieService'

/**
 * Component that shows the movie data
 */
class MovieShow extends Component {

    constructor (props, context) {
        super(props, context)
        this.movieService = new MovieService()
        this.state = {
            name: null,
            overview: null,
            releaseDate: null,
            poster: null,
            backdrop: null,
            genres: []
        }
    }

    /**
     * Whenever the component mount
     * @returns {Promise<void>}
     */
    async componentDidMount () {
        const data = await this.movieService.show(this.props.match.params.id)
        this.setState({
            name: data.name,
            overview: data.overview,
            releaseDate: moment(data.release_date).format('LL'),
            poster: data.poster,
            backdrop: data.backdrop,
            genres: data.genres
        })
    }

    render () {
        return (
            <div className="movies">
                <nav className="nav">
                    <ul className="pagination-list">
                        <li className="pagination-item">
                            <Link to='/'>Back</Link>
                        </li>
                    </ul>
                </nav>
                <h1 className="content-subhead">All about the movie</h1>


                <section className="movie">
                    <header className="movie-header">
                        <h2 className="movie-title">{this.state.name}</h2>
                        <h4>Release date: {this.state.releaseDate}</h4>
                        <p className="movie-meta">
                            {this.state.genres.map(g => <MovieGenreBadge name={g.name}/>)}
                        </p>
                    </header>
                    <div className="movie-overview">
                        <p>
                            {this.state.overview}
                        </p>
                    </div>
                    <div className="post-images pure-g">
                        <div className="pure-u-1 pure-u-md-1-2">
                            <img alt="Photo of someone working poolside at a resort"
                                 className="pure-img-responsive"
                                 src={this.state.poster}/>
                            <div className="movie-image-meta">
                                <h3>Movie poster</h3>
                            </div>
                        </div>

                        <div className="pure-u-1 pure-u-md-1-2">
                            <img alt="Photo of the sunset on the beach"
                                 className="pure-img-responsive"
                                 src={this.state.backdrop}/>
                            <div className="movie-image-meta">
                                <h3>Movie Backdrop</h3>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        )
    }
}

export default MovieShow