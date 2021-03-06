import React from 'react';
import moment from 'moment';
import Avatar from '../../../components/Avatar';

export const PlayersTable = (props) => {
  const {
    players,
    handleSortClick,
  } = props;

  return (
    <div className="table-responsive">
      <table className="table table-striped">
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col" className="text-nowrap">
              <a href="#" onClick={ e => handleSortClick(e, 'name') }>Player name</a>
            </th>
            <th scope="col" className="text-center">
              <a href="#" onClick={ e => handleSortClick(e, 'kills') }>Kills</a>
            </th>
            <th scope="col" className="text-center">
              <a href="#" onClick={ e => handleSortClick(e, 'deaths') }>Deaths</a>
            </th>
            <th scope="col" className="text-center">
              Hits
            </th>
            <th scope="col" className="text-center">
              Shots
            </th>
            <th scope="col" className="text-center">
              Headshots
            </th>
            <th scope="col" className="text-right text-nowrap">
              <a href="#" onClick={ e => handleSortClick(e, 'updated_at') }>Last updated</a>
            </th>
          </tr>
        </thead>
        <tbody>
          {players.map(player => {
            let updatedAt = 'N/A';
            let updatedAtRaw = 'N/A';
            let kills = player.kills || 0;
            let deaths = player.deaths || 0;
            let hits = player.hits || 0;
            let shots = player.shots || 0;
            let headshots = player.headshots || 0;

            if (player.updated_at) {
              updatedAt = moment(player.updated_at, 'YYYY-MM-DDThh:mm:ss.SSSSSSZ').format('DD, MMM YYYY - hh:mm A');
              updatedAtRaw = player.updated_at;
            }

            return (
              <tr key={ player.id }>
                <td>
                  <Avatar
                    name={ player.player_name }
                    imagePath={ player.avatar }
                  />
                </td>
                <td className="text-nowrap">
                  {player.player_name}
                </td>
                <td className="text-center">
                  { kills }
                </td>
                <td className="text-center">
                  { deaths }
                </td>
                <td className="text-center">
                  { hits }
                </td>
                <td className="text-center">
                  { shots }
                </td>
                <td className="text-center">
                  { headshots }
                </td>
                <td className="text-right text-nowrap">
                  <span title={ updatedAtRaw }>{ updatedAt }</span>
                </td>
              </tr>
            )
          })}
        </tbody>
      </table>
    </div>
  )
}