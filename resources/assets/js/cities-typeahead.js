(function () {

    // Needed for IE !!!
    if ( ! window.location.origin) {
      window.location.origin = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port: '');
    }

    // Build Bloodhound search object
    var cities = new Bloodhound(
        {
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            limit: 30,
            remote: {
                url: window.location.origin + '/city/%QUERY',
                filter: function (list) {
                    return $.map(list, function (city) {
                        return {
                            name: city.ville_nom_reel,
                            cp: city.ville_code_postal
                        };
                    });
                }
            }
        });

    // Initialize cities object
    cities.initialize();

    // Link to UI
    $('.question .typeahead').typeahead(
        {
            minLength: 2,
            hint: true,
            highlight: true
        },
        {
            name: 'cities',
            displayKey: 'name',
            source: cities.ttAdapter(),
            templates: {
                empty: [
                    '<div class="typeahead-no-result-found">',
                    'Impossible de trouver cette ville ou ce code postal !',
                    '</div>'
                ].join('\n'),
                suggestion: Handlebars.compile('<p>{{name}} ({{cp}})</p>')
            }
        });

})();
