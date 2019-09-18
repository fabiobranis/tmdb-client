import React, {Component} from 'react'

/**
 * Badges to movies genres
 */
class MovieGenreBadge extends Component {
    render () {
        return (
            <span className="movie-genre movie-genre-all">{this.props.name}</span>
        )
    }
}

export default MovieGenreBadge