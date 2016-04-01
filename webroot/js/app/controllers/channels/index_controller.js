App.Controllers.ChannelsIndexController = Frontend.AppController.extend({
    startup: function() {


        this.$('input').on('change', function() {
            var url = {
                plugin: 'Api',
                controller: 'Users',
                action: 'updateData'
            };
            App.Main.request(url, this.$('form').serialize(), function (response) {
            });
        }.bind(this));

       this.$('.channel-link').click(function(e) {
           var link = this.$(e.currentTarget);
           var channel = link.data('channel');
           var duration = link.parent().parent().find('.duration-input').val();
           App.Main.request({
               plugin: 'Api',
               controller: 'ChannelActions',
               action: 'onOff',
               pass: [
                   channel,
                   duration
               ]
           }, null, function (response) {
           });
       }.bind(this));

       this.Websocket.initWebsocket();
       this.Websocket.on('ChannelAction.add', function(e) {
           this.loadChannelActionsList();
       }.bind(this));

       this.loadChannelActionsList();

   },
   loadChannelActionsList: function() {
       var url = {
           controller: 'channels',
           action: 'listLastActions',
       };
       App.Main.UIBlocker.blockElement(this.$('.channel-action-list'));
       App.Main.loadJsonAction(url, {
           target: this.$('.channel-action-list'),
           onComplete: function(controller, response) {
               App.Main.UIBlocker.unblockElement(this.$('.channel-action-list'));
           }.bind(this)
       });
   }
});
