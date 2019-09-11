import React, {Component} from 'react'
import {Link} from 'react-router-dom'
import MovieGenreBadge from './MovieGenreBadge'

/**
 * The movie row
 */
class MovieRow extends Component {

    /**
     * Renders the genres badges
     * @returns {*[]}
     */
    renderGenres () {
        return this.props.genres.map(g => <MovieGenreBadge name={g.name}/>)
    }

    render () {
        return (
            <section className="movie">
                <header className="movie-header">
                    <img width="100" height="100" alt="Some movie title" className="movie-poster-list"
                         src={this.props.poster}/>

                    <h2 className="movie-title"><Link to={'/movie/' + this.props.id}>{this.props.name}</Link></h2>

                    <p className="movie-meta">
                        {this.renderGenres()}
                    </p>
                </header>
            </section>
        )
    }
}

export default MovieRow