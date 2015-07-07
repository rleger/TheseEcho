(function() {

    // Open a connection, and subscribe to the channel.
    var pusher = new Pusher('adf76ef5f5586a94130f');
    var channel = pusher.subscribe('theseecho');

    // Namespacing
    window.App = {};
    App.Listeners = {};

    // Notifier
    App.Notifier = function() {
        this.notify = function(message) {
            var template = Handlebars.compile($('#flash-template').html());
            var flashMessage = template({ message: message});

            $('.flash-from-pusher').hide().html(flashMessage).fadeIn(300);
        };
    };

    // Listeners
    App.Listeners.Post = {
        whenSurveyWasSubmitted: function(data) {
            (new App.Notifier).notify("Une nouvelle réponse vient d'arriver !");
        },
        whenDatabaseTableWasSavedToCSV: function(data) {
            (new App.Notifier).notify("La base de donnée à été sauvegardée !");
        }
    };

    // Register bindings
    channel.bind('SurveyWasSubmitted', App.Listeners.Post.whenSurveyWasSubmitted);
    channel.bind('DatabaseTableWasSavedToCSV', App.Listeners.Post.whenDatabaseTableWasSavedToCSV);

})();
