import React from 'react';

export const Pagination = (props) => {
  const {
    total,
    perPage,
    currentPage,
    handlePageClick,
    centerPagination,
  } = props;

  const totalPages = Math.ceil(total / perPage);
  const centerStyle = centerPagination ? ' justify-content-center' : '';

  let pages = [];

  for (let page = 1; page <= totalPages; page++) {
    pages.push(page);
  }

  return (
    <ul className={'pagination' + centerStyle}>
      {pages.map(page =>
        <li className={ 'page-item' + (page === currentPage ? ' active' : '') } key={ 'page-' + page }>
          <a className="page-link" href="#" onClick={e => handlePageClick(e, page)}>{ page }</a>
        </li>
      )}
    </ul>
  )
}
