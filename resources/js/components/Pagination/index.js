import React from 'react';

export const Pagination = (props) => {
  const {
    total,
    perPage,
    currentPage,
    handlePageClick,
  } = props;

  const totalPages = Math.ceil(total / perPage);

  let pages = [];

  for (let page = 1; page <= totalPages; page++) {
    pages.push(page);
  }

  return (
    <nav>
      <ul className="pagination pagination-sm">
        {pages.map(page =>
          <li className={ 'page-item' + (page === currentPage ? ' active' : '') } key={ 'page-' + page }>
            <a className="page-link" href="#" onClick={e => handlePageClick(e, page)}>{ page }</a>
          </li>
        )}
      </ul>
    </nav>
  )
}
