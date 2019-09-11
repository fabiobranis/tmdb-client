import React, {Component} from 'react'
import cutPagination from '../helpers/cutPagination'
import PageLink from './PageLink'

/**
 * Component that represents the paginator at the bottom of the page
 */
class Paginator extends Component {

    constructor (props, context) {
        super(props, context)
    }

    /**
     * Elevate the clicked link page state
     * @param page
     */
    handleClick (page) {
        this.props.onPageClick(page)
    }

    render () {
        return (
            <nav className="nav">
                <ul className="pagination-list">
                    {cutPagination(this.props.page, this.props.last)
                        .map(p => <PageLink key={p}
                                            number={p}
                                            text={p}
                                            onPageClick={(e) => this.handleClick(p, e)}/>)}
                </ul>
            </nav>
        )
    }
}

export default Paginator