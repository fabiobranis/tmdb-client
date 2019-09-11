import React, {Component} from 'react'

/**
 * The button to change the page
 */
class PageLink extends Component {

    /**
     * Elevate the page number state of the component
     */
    handleClickPage () {
        this.props.onPageClick(this.props.number)
    }

    render () {
        return (
            <li className="pagination-item">
                <button className="pure-button" onClick={(e) => this.handleClickPage(e)}>{this.props.text}</button>
            </li>
        )
    }
}

export default PageLink