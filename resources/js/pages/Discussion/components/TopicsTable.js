import React from 'react';
import { Link } from 'react-router-dom';
import moment from 'moment';

export const TopicsTable = (props) => {
  const {
    rows,
    handleSortClick,
  } = props;

  return (
    <div className="table-responsive">
      <table className="table">
        <thead>
          <tr>
            <th scope="col">
              <a href="#" onClick={ e => handleSortClick(e, 'title') }>Title</a>
            </th>
            <th scope="col" className="text-center">
              <a href="#" onClick={ e => handleSortClick(e, 'views') }>Views</a>
            </th>
            <th scope="col" className="text-center">
              <a href="#" onClick={ e => handleSortClick(e, 'replies') }>Replies</a>
            </th>
            <th scope="col" className="text-right">
              <a href="#" onClick={ e => handleSortClick(e, 'updated_at') }>Last updated</a>
            </th>
          </tr>
        </thead>
        <tbody>
          {rows.map(row => {
            let updatedAt = 'N/A';

            if (row.updated_at) {
              updatedAt = moment(row.updated_at, 'YYYY-MM-DDThh:mm:ss.SSSSSSZ').format('DD, MMM YYYY - hh:mm A');
            }

            return (
              <tr key={ row.id }>
                <td>
                  <Link to={`/discussions/topics/${row.slug}`}>{ row.title }</Link>
                </td>
                <td className="text-center">
                  { row.views }
                </td>
                <td className="text-center">
                  { row.replies }
                </td>
                <td className="text-right">
                  <span title={ row.updated_at }>{ updatedAt }</span>
                </td>
              </tr>
            )
          })}
        </tbody>
      </table>
    </div>
  )
}