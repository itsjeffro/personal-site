import React from 'react';
import moment from 'moment';

export const PlayersTable = (props) => {
  const {
    players
  } = props;

  return (
    <div className="table-responsive">
      <table className="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col"></th>
            <th scope="col">Player name</th>
            <th scope="col">Kills</th>
            <th scope="col">Deaths</th>
            <th scope="col" className="text-right">Last updated</th>
          </tr>
        </thead>
        <tbody>
          {players.map(player => {
            let updatedAt = 'N/A';
            let updatedAtRaw = 'N/A';

            if (player.updated_at) {
              updatedAt = moment(player.updated_at, 'YYYY-MM-DD hh:mm:ss').utc().format('DD, MMM YYYY - hh:mm A');
              updatedAtRaw = player.updated_at;
            }

            return (
              <tr key={player.id}>
                <td>
                  {player.id}
                </td>
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
                <td>
                  {player.stats ? player.stats.kills : 0}
                </td>
                <td>
                  {player.stats ? player.stats.deaths : 0}
                </td>
                <td className="text-right">
                  <span title={updatedAtRaw}>{ updatedAt }</span>
                </td>
              </tr>
            )
          })}
        </tbody>
      </table>
    </div>
  )
}