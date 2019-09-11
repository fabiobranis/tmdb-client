import React, {Component} from 'react'
import {BrowserRouter as Router, Route} from 'react-router-dom'
import MoviesList from './src/containers/MoviesList'
import MovieShow from './src/containers/MovieShow'
import Sidebar from './src/components/Sidebar'

/**
 * Our main container
 */
class App extends Component {

    render () {
        return (
            <Router>
                <div id="layout" className="pure-g">
                    <Sidebar/>
                </div>
                <div className="content pure-u-1 pure-u-md-3-4">
                    <Route path="/" exact component={MoviesList}/>
                    <Route path="/movie/:id" component={MovieShow}/>
                </div>
            </Router>
        )
    }
}

export default App;