const expressJwt = require('express-jwt');

function authJwt() {
    const secret = process.env.SECRET;
    const api = process.env.API_URL;
    return expressJwt({
        secret: secret,
        algorithms: ['HS256'],
        isRevoked: isRevokeCallback
    }).unless({
        path: [
            {url: /\/public\/uploads(.*)/ , methods: ['GET', 'OPTIONS'] },
            {url: /\/api\/v1\/products(.*)/ , methods: ['GET', 'OPTIONS'] },
            {url: /\/api\/v1\/categories(.*)/ , methods: ['GET', 'OPTIONS'] },
            {url: /\/api\/v1\/orders(.*)/,methods: ['GET', 'OPTIONS', 'POST']},
            `${api}/users/login`,
            `${api}/users/register`,
        ]
    })
}

async function isRevokeCallback(req, payload, done) {
    const userId = payload.userId;
    const requestedUserPath = req._parsedUrl.pathname;
    const requestedUserId = requestedUserPath.substring(requestedUserPath.lastIndexOf('/') + 1);
    if (req.url.startsWith('/api/v1/users/') && userId !== requestedUserId) {
        return done(null, true);
    }
    
    return done();
}



module.exports = authJwt
