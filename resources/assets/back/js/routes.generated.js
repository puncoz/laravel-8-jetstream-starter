    var Ziggy = {
        namedRoutes: {"auth.logout":{"uri":"logout","methods":["POST"],"domain":null},"back.":{"uri":"\/","methods":["GET","HEAD"],"domain":null},"back.dashboard":{"uri":"dashboard","methods":["GET","HEAD"],"domain":null},"back.users.index":{"uri":"users","methods":["GET","HEAD"],"domain":null},"back.users.create":{"uri":"users\/create","methods":["GET","HEAD"],"domain":null},"back.users.store":{"uri":"users","methods":["POST"],"domain":null},"back.users.show":{"uri":"users\/{user}","methods":["GET","HEAD"],"domain":null},"back.users.edit":{"uri":"users\/{user}\/edit","methods":["GET","HEAD"],"domain":null},"back.users.update":{"uri":"users\/{user}","methods":["PUT","PATCH"],"domain":null},"back.users.destroy":{"uri":"users\/{user}","methods":["DELETE"],"domain":null}},
        baseUrl: 'https://haami-dev-admin.valet/',
        baseProtocol: 'https',
        baseDomain: 'haami-dev-admin.valet',
        basePort: false,
        defaultParameters: []
    };

    if (typeof window.Ziggy !== 'undefined') {
        for (var name in window.Ziggy.namedRoutes) {
            Ziggy.namedRoutes[name] = window.Ziggy.namedRoutes[name];
        }
    }

    export {
        Ziggy
    }
