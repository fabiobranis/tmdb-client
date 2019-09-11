import ApiClient from '../helpers/ApiClient'

const endpoint = 'movies'

/**
 * Handles the movies actions using ApiClient as a dependency
 */
class MovieService {

    constructor () {
        this.client = new ApiClient()
    }

    /**
     * List all movies
     * @param params
     * @returns {Promise<any>}
     */
    async index (params = null) {
        return this.client.get(endpoint, params)
    }

    /**
     * Get a specific movie
     * @param id
     * @returns {Promise<any>}
     */
    async show (id) {
        return this.client.get(endpoint + '/' + id)
    }

}

export default MovieService