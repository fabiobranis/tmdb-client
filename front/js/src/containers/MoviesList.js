import React, {Component} from 'react'
import MovieRow from '../components/MovieRow'
import MovieService from '../services/MovieService'
import Paginator from '../components/Paginator'

/**
 * List the movies in a cool styled page
 */
class MoviesList extends Component {
    constructor (props) {
        super(props)
        this.movieService = new MovieService()
        this.state = {
            movies: [],
            paginationData: {
                total: 0,
                page: 1,
                last: 0
            },
            filter: null
        }
    }

    /**
     * Get the movies from api
     * @returns {Promise<void>}
     */
    async getMovies () {
        const params = {
            filter: this.state.filter,
            page: this.state.page
        }
        const data = await this.movieService.index(params)
        await this.setState({
            movies: data.data,
            paginationData: {
                total: data.total,
                page: data.current_page,
                last: data.last_page
            }
        })
    }

    /**
     * Whenever the component load
     * @returns {Promise<void>}
     */
    async componentDidMount () {
        await this.getMovies()
    }

    /**
     * Filter the input data
     * @param event
     * @returns {Promise<void>}
     */
    async filterData (event) {
        await this.setState({filter: event.target.value})
        await this.getMovies()
    }

    /**
     * Change the page with elevated stated from paginator
     * @param page
     * @returns {Promise<void>}
     */
    async changePage (page) {
        await this.setState({page: page})
        await this.getMovies()
    }

    render () {
        return (
            <div>
                <div className="movies">
                    <div className="group">
                        <input type="text" required value={this.state.filter} onInput={this.filterData.bind(this)}/>
                        <span className="highlight"/>
                        <span className="bar"/>
                        <label>Search for a movie</label>
                    </div>
                    <h1 className="content-subhead">A list of upcoming movies</h1>
                    {this.state.movies.map(m => <MovieRow genres={m.genres} poster={m.poster} id={m.id}
                                                          name={m.name}/>)}
                </div>
                <div className="footer">
                    <div className="pure-menu pure-menu-horizontal">
                        <Paginator page={this.state.paginationData.page}
                                   last={this.state.paginationData.last}
                                   total={this.state.paginationData.total}
                                   onPageClick={this.changePage.bind(this)}/>

                    </div>
                </div>
            </div>
        )
    }
}

export default MoviesList