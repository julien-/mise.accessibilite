var names = new Bloodhound({
    datumTokenizer: function (d) {
        return Bloodhound.tokenizers.whitespace(d.name);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: '../../messagerie/controleur/rq_etudiants.php?query=%QUERY'
});

var ids = new Bloodhound({
    datumTokenizer: function (d) {
        return Bloodhound.tokenizers.whitespace(d.id);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: '../../messagerie/controleur/rq_etudiants.php?query=%QUERY'
});

// Initialise Bloodhound suggestion engines for each input
names.initialize();
ids.initialize();

// Make the code less verbose by creating variables for the following
var employeeNameTypeahead = $('#nom_destinataire.typeahead');
var employeeIdTypeahead = $('#destinataire.typeahead');

// Initialise typeahead for the employee name
employeeNameTypeahead.typeahead({
    highlight: true
}, {
    name: 'name',
    displayKey: Handlebars.compile('{{surname}} {{name}} ({{username}})'),
    source: names.ttAdapter(),
    templates: {
        empty: [
          '<div class="empty-message">',
          'Aucun étudiant trouvé',
          '</div>'
        ].join('\n'),
        suggestion: Handlebars.compile('{{surname}} {{name}} ({{username}})')
      }
});

// Initialise typeahead for the employee name
employeeIdTypeahead.typeahead({
    highlight: true
}, {
    name: 'id',
    displayKey: 'id',
    source: ids.ttAdapter()
});

// Set-up event handlers so that the ID is auto-populated in the id typeahead input when the name is
// selected an vice versa

var employeeNameItemSelectedHandler = function (eventObject, suggestionObject, suggestionDataset) {
    /* According to the documentation the following should work https://github.com/twitter/typeahead.js/blob/master/doc/jquery_typeahead.md#jquerytypeaheadval-val.
    However it causes the suggestion to appear which is not wanted */
    //employeeIdTypeahead.typeahead('val', suggestionObject.id);
    employeeIdTypeahead.val(suggestionObject.id);
};

var employeeIdItemSelectedHandler = function (eventObject, suggestionObject, suggestionDataset) {
    /* See comment in previous method */
    //employeeNameTypeahead.typeahead('val', suggestionObject.name);
    employeeNameTypeahead.val(suggestionObject.name);
};

// Associate the typeahead:selected event with the bespoke handler
employeeNameTypeahead.on('typeahead:selected', employeeNameItemSelectedHandler);
employeeIdTypeahead.on('typeahead:selected', employeeIdItemSelectedHandler);

$('.textarea').wysihtml5();