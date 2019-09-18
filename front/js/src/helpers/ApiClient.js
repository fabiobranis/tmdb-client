import Querystring from 'querystring'
import cleanParameters from '../helpers/cleanParameters'

/**
 * Handle the Api Requests using fetch api
 */
class ApiClient {

    constructor () {
        this.url = '/api/v1/'
    }

    /**
     * Make the request - METHOD GET
     * @param endpoint
     * @param qs
     * @returns {Promise<any>}
     */
    async get (endpoint, qs) {
        let query = ''
        if (qs) {
            query = '?' + Querystring.stringify(cleanParameters(qs))
        }
        const response = await fetch(this.url + endpoint + query)
        return await response.json()
    }
}

export default ApiClient