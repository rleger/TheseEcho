var elixir = require('laravel-elixir');

elixir(function(mix) {
    // Will output public/css/app.css
    // Used for IE9 fix
    mix.less([
        "styles.less",
        "../Flat-UI-Pro-1.3.2/less/flat-ui-pro.less"
        ],  'resources/assets/css/app.css');

    // Move resources/assets/css/app.css -> public/css/app.css
    // for IE9
    mix.styles([
        "../../../vendor/bower_components/bootstrap/dist/css/bootstrap.min.css",
        "app.css"
        ], 'public/css/app.css');

    // For other browsers
    // Will output public/css/all.css
    mix.styles([
        "../../../vendor/bower_components/normalize.css/normalize.css",
        "../../../vendor/bower_components/bootstrap/dist/css/bootstrap.min.css",
        "../../../vendor/bower_components/font-awesome/css/font-awesome.css",
        "../../../vendor/bower_components/Plugins/integration/font-awesome/dataTables.fontAwesome.css",
        "../Flat-UI-Pro-1.3.2/dist/css/flat-ui-pro.css",
        "app.css",
    ]);

    mix.scripts([
        "../../../vendor/bower_components/jquery/dist/jquery.min.js",
        "../../../vendor/bower_components/datatables/media/js/jquery.dataTables.min.js",
        "../../../vendor/bower_components/Plugins/integration/bootstrap/3/dataTables.bootstrap.min.js",
        "../../../vendor/bower_components/pusher/dist/pusher.js",
        "../Flat-UI-Pro-1.3.2/dist/js/flat-ui-pro.min.js",
        "handlebars-v2.0.0.js",
        "typeahead.js",
        "cities-typeahead.js",
        "survey.js",
        "tableToExcel.js",
        "background-resize.js",
        "pusher.js",
        "scripts.js",
        "questions.js",
    ]);

    mix.version(["css/all.css", "js/all.js"]);

    //mix.phpUnit();
});
