import React from 'react';
import { Link } from 'react-router-dom';
import moment from 'moment';
import Topic from '../../Topic/Topic';

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
            <th width="2%"></th>
            <th scope="col">
              Title
            </th>
            <th scope="col" className="text-center">
              Views
            </th>
            <th scope="col" className="text-center">
              Replies
            </th>
          </tr>
        </thead>
        <tbody>
          {rows.map(row => {
            let latestCreatedAtUtc = row.created_at;
            let latestAuthor = row.author ? row.author.name : '';

            if (row.latest_reply) {
              latestCreatedAtUtc = row.latest_reply.created_at;
              latestAuthor = row.latest_reply ? row.latest_reply.author.name : '';
            }

            let latestCreatedAt = moment.utc(latestCreatedAtUtc).toDate();
            latestCreatedAt = moment(latestCreatedAt).format('DD, MMM YYYY - hh:mm A');

            return (
              <tr key={ row.id }>
                <td width="2%">
                  <img 
                    className="rounded" 
                    src={ row.author.player ? row.author.player.avatar : '/images/player_default.jpg' } 
                    width="25" 
                    height="25"
                    title={ 'Created by ' + row.author.name }
                  />
                </td>
                <td>
                  <div><Link to={`/discussions/topics/${row.id}`}>{ row.title }</Link></div>
                  <span>
                    { latestAuthor } - <span title={ latestCreatedAtUtc + ' GMT' }>{ latestCreatedAt }</span></span>
                </td>
                <td className="text-center">
                  { row.views }
                </td>
                <td className="text-center">
                  { row.replies }
                </td>
              </tr>
            )
          })}
        </tbody>
      </table>
    </div>
  )
}