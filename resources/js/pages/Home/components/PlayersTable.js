import React from 'react';

export const PlayersTable = (props) => {
  const {
    players
  } = props;

  return (
    <table className="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Player name</th>
          <th scope="col">Kills</th>
          <th scope="col">Deaths</th>
          <th scope="col" className="text-right">Last updated</th>
        </tr>
      </thead>
      <tbody>
        {players.map(player => (
          <tr key={player.id}>
            <td>
              {player.id}
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
              {player.updated_at ? player.updated_at : 'N/A'}
            </td>
          </tr>
        ))}
      </tbody>
    </table>
  )
}