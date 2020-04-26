class AuthService {
  constructor(storage, jwt, jwksClient) {
    this.storage = storage;
    this.jwt = jwt;
    this.jwksClient = jwksClient;
  }

  check(callback) {
    const accessToken = this.storage.getItem('accessToken');

    this.jwksClient.getSigningKey('jwt_id_rsa', (err, key) => {
      try {
        const publicKey = key.getPublicKey();
        const decoded = this.jwt.verify(accessToken, publicKey);

        const user = {
          name: decoded.name || '',
          picture: decoded.picture || '',
        };

        callback(user);
      } catch (e) {
        if (e instanceof TokenExpiredError) {
          localStorage.setItem('user', null);
          localStorage.setItem('accessToken', null);
        }

        throw e;
      }
    });
  }
}

export default AuthService;
