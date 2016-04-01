App.Controllers.ExampleIndexController = Frontend.AppController.extend({
    startup: function() {
        console.log('Hi from Example controller');
        this.Websocket.initWebsocket();
    },
});
