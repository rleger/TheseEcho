// CSS selector for section heading
var sectionTitleCssSelector = 'h3.question-field';
var errorCssClass = 'has-error';
/**
 * Conditions object
 */
var conditions = {
    pratique_ALR: {
        non: {
            pratique_ALR_FESF: false,
            contre_indication_alr: false,
            phase_realisation_alr: false,
            ALR_douleur: false,
            reperage: false,
            quel_bloc: false,
            AL_bif: false,
            AL_bf: false,
            echec: false
        },
        oui: {
            pratique_ALR_FESF: true,
            contre_indication_alr: true,
            phase_realisation_alr: true,
            ALR_douleur: true,
            reperage: true,
            quel_bloc: true,
            AL_bif: true,
            AL_bf: true,
            echec: true
        }
    },
    pratique_ALR_FESF: {
        jamais: {
            contre_indication_alr: false,
            phase_realisation_alr: false,
            ALR_douleur: false,
            reperage: false,
            quel_bloc: false,
            AL_bif: false,
            AL_bf: false,
            AL_bf_obtu: false,
            echec: false
        },
        toujours: {
            contre_indication_alr: true,
            phase_realisation_alr: true,
            ALR_douleur: true,
            reperage: true,
            quel_bloc: true,
            AL_bif: true,
            AL_bf: true,
            AL_bf_obtu: false,
            echec: true
        },
        occasionnellement: {
            contre_indication_alr: true,
            phase_realisation_alr: true,
            ALR_douleur: true,
            reperage: true,
            quel_bloc: true,
            AL_bif: true,
            AL_bf: true,
            echec: true
        }
    },
    quel_bloc: {
        bif: {
            AL_bif: true
        },
        femoral: {
            AL_bf: true
        },
        fem_obtu: {
            AL_bf_obtu: true
        }
    }
};

// Load Radio subquestions
$(document).on('change', 'input.question-field[type="radio"]', function (e) {
    showOrHideRadioSubQuestions($(this));
});

// Load Checkboxes subquestions
$(document).on('change', 'input.question-field[type="checkbox"]', function (e) {
    showOrHideCheckboxesSubQuestions($(this));
});

/////////////////////////
// Disabling questions //
/////////////////////////

// When a radio button is clicked, check to see if some
// conditions apply to hide other questions
$(document).on('change', 'input.question-field[type="radio"]', function (e) {
    processCheckboxesAndRadioConditionnedQuestions();
});
$(document).on('change', 'input.question-field[type="checkbox"]', function (e) {
    processCheckboxesAndRadioConditionnedQuestions();
});

function processCheckboxesAndRadioConditionnedQuestions() {
    // showOrHideConditionnedQuestions($(this));
    $('input.question-field[type="radio"]:checked').each(function (index) {
        // Show or hide conditionned questions
        showOrHideConditionnedQuestions($(this));
    });
    // Checkboxes
    $('input.question-field[type="checkbox"]').each(function (index) {
        // Show or hide conditionned questions
        showOrHideConditionnedQuestions($(this));
    });
}
//////////////////////
// Document loading //
//////////////////////

// On document load, load radio and checkboxes subquestions, and process conditions
$(document).on('ready', function (e) {
    // Radio button
    $('input.question-field[type="radio"]:checked').each(function (index) {
        // Show or hide SubQuestions
        showOrHideRadioSubQuestions($(this));

        // Show or hide conditionned questions
        showOrHideConditionnedQuestions($(this));
    });

    // Checkboxes
    $('input.question-field[type="checkbox"]').each(function (index) {
        // Show or hide SubQuestions
        showOrHideCheckboxesSubQuestions($(this));

        // Show or hide conditionned questions
        showOrHideConditionnedQuestions($(this));
    });

    // Add has-error class to parents of fields with errors
    $('.error-list').children('li').each(function (index) {
        var target = $(this).attr('data-error-target-field');

        // Add has-error to questions with errors
        $('.question[data-field-name="' + target + '"]').addClass(errorCssClass);

        // Add has-error to main questions where subquestions have errors
        $('.sub-questions-group div[data-field-name="' + target + '"]').parents('.question').addClass(errorCssClass);
    });
});
