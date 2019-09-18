import React, {Component} from 'react'

/**
 * A beautiful side bar
 */
class Sidebar extends Component {
    render () {
        return (
            <div className="sidebar pure-u-1 pure-u-md-1-4">
                <div className="header">
                    <h1 className="brand-title">Upcoming Movies</h1>
                    <h2 className="brand-tagline">A simple list of upcoming movies</h2>
                </div>
            </div>
        )
    }
}

export default Sidebar