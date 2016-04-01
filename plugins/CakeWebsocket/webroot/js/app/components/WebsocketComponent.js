App.Components.WebsocketComponent = Frontend.Component.extend({
    _connection: null,
    _onMessageCallbacks: {},
    startup: function() {
    },
    initWebsocket: function() {
        this._connection = new ab.Session('ws://cake-relay.dev:8080', this.onConnected.bind(this), this.onClosed.bind(this), {'skipSubprotocolCheck': true});
    },
    onConnected: function() {
        this._connection._websocket.onmessage = function(e) {
            var data = JSON.parse(e.data);
            if (this._onMessageCallbacks[data.action] != undefined) {
                this._onMessageCallbacks[data.action](data);
            }
        }.bind(this);
    },
    onClosed: function() {
    },
    on: function(action, callback) {
        this._onMessageCallbacks[action] = callback;
    }
});
