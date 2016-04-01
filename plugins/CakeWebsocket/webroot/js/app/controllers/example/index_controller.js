App.Controllers.ExampleIndexController = Frontend.AppController.extend({
    startup: function() {
        this.Websocket.initWebsocket();
        this.Websocket.on('WebsocketContent.somethingHappened', function(data) {
            console.log(data);
        });

    }
});
