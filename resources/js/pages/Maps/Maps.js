import React from 'react';
import { Navbar } from '../../components/Navbar';

class Maps extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      availableMaps: [
        {
          id: 1,
          title: 'Pool Day',
          mapBsp: 'fy_pool_day',
          image: '/images/maps/fy_pool_day.jpg',
          content: 'Type: Bomb site',
        },
        {
          id: 2,
          title: 'CS Rio',
          mapBsp: 'cs_rio',
          image: '/images/maps/cs_rio.jpg',
          content: 'Type: Hostage rescue',
        },
        {
          id: 3,
          title: 'Glass 2',
          mapBsp: 'he_glass_2',
          image: '/images/maps/he_glass_2.jpg',
          content: 'Type: Survival',
        }
      ],
    }
  }

  /**
   * Render DOM.
   */
  render() {
    return (
      <>
        <div className="container">
          <div className="content">
            <div className="row justify-content-center">
              <div className="col-lg-10">
                
                <h2>Maps</h2>

                <p>Aside from the usual maps that come with Counter-Strike 1.6, there are also additional maps that have been added.</p>

                <p>Map suggestion form coming soon.</p>

                <h3>Available maps</h3>

                <div className="card-deck">
                  {this.state.availableMaps.map(availableMap => (
                    <div key={ availableMap.id } className="card" style={{ width: '18rem' }}>
                      <img 
                        className="card-img-top" 
                        src={ availableMap.image } 
                        alt={ availableMap.title } 
                        title={ availableMap.title }
                      />

                      <div className="card-body">
                        <h5 className="card-title">{ availableMap.title }</h5>
                        <p className="card-text">{ availableMap.content }</p>
                      </div>

                      <div className="card-footer">
                        <small className="text-muted">Map name: { availableMap.mapBsp }</small>
                      </div>
                    </div>
                  ))}
                </div>

              </div>
            </div>
          </div>
        </div>
      </>
    );
  }
}

export default Maps;
