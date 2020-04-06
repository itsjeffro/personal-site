import React from 'react';
import moment from 'moment';

export const PlayersTable = (props) => {
  const {
    players,
    handleSortClick,
  } = props;

  return (
    <div className="table-responsive">
      <table className="table">
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col">
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
            <th scope="col" className="text-right">
              Last updated
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
                  <img 
                    className="rounded" 
                    src={player.avatar ? player.avatar : '/images/player_default.jpg'} 
                    width="25" 
                    height="25"
                    alt={player.player_name} 
                    title={player.player_name + ' avatar'} 
                  />
                </td>
                <td>
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
                <td className="text-right">
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