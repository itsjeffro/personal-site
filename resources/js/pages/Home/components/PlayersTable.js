import React from 'react';
import moment from 'moment';
import { calculateRatio } from '../../../helpers/math';

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
            <th scope="col" className="text-center">Kills</th>
            <th scope="col" className="text-center">Deaths</th>
            <th scope="col" className="text-right">Last updated</th>
          </tr>
        </thead>
        <tbody>
          {players.map(player => {
            let updatedAt = 'N/A';
            let updatedAtRaw = 'N/A';
            let kills = player.stats ? player.stats.kills : 0;
            let deaths = player.stats ? player.stats.deaths : 0;

            if (player.updated_at) {
              updatedAt = moment(player.updated_at, 'YYYY-MM-DDThh:mm:ss.SSSSSSZ').format('DD, MMM YYYY - hh:mm A');
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
                <td className="text-center">
                  { kills }
                </td>
                <td className="text-center">
                  { deaths }
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