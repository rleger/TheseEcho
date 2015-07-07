///////////////////////////
// Subquestions handling //
///////////////////////////

/**
 * Show or hide Radio SubQuestions
 */
function showOrHideRadioSubQuestions($this) {
    var fieldName = $this.attr('name');
    var value = $this.val();

    // show true
    $('div[data-original="' + fieldName + '"][data-condition="true"][data-on!="' + value + '"].question-sub').addClass('hide');
    $('div[data-original="' + fieldName + '"][data-condition="true"][data-on="' + value + '"].question-sub').removeClass('hide');

    // Show false
    $('div[data-original="' + fieldName + '"][data-condition="false"][data-on!="' + value + '"].question-sub').addClass('hide');
    $('div[data-original="' + fieldName + '"][data-condition="false"].question-sub').addClass('hide');
}

/**
 * Show or hide Checkboxes SubQuestions
 */
function showOrHideCheckboxesSubQuestions($this) {
    var fieldName = $this.val();
    var status = $this.prop('checked');

    var $subQuestionTrue = $('div[data-original="' + fieldName + '"][data-condition="true"].question-sub');
    var $subQuestionFalse = $('div[data-original="' + fieldName + '"][data-condition="false"].question-sub');

    // show true
    if (status) {
        $subQuestionTrue.removeClass('hide');
    } else {
        $subQuestionTrue.addClass('hide');
    }

    // Show false
    if (status) {
        $subQuestionFalse.addClass('hide');
    } else {
        $subQuestionFalse.removeClass('hide');
    }
}

///////////////////////////////////////////////////
// Hide or show questions on another's condition //
///////////////////////////////////////////////////

// @todo: for now only works with radio buttons

/************************************************************************************
 |   Use with a condition object following this model
 |
 |   var conditions = {
    |       pratique_ALR : {
    |           non: {
    |               pratique_ALR_FESF: false,
    |               phase_realisation_alr: false,
    |           },
    |           oui: {
    |               pratique_ALR_FESF: true,
    |               phase_realisation_alr: true,
    |           }
    |       }
    |   };
 ***********************************************************************************/

/**
 * Hide or show questions if they meet some conditions
 */
function hideQuestionOnCondition(origin, target, condition, show) {
    $(document).on('change', 'input.question-field[name="' + origin + '"][value="' + condition + '"]', function (e) {
        if (show) {
            $('input[name="' + target + '"]').parents('.form-group').removeClass('hide');
        } else {
            $('input[name="' + target + '"]').parents('.form-group').addClass('hide');
        }
    });
}

/**
 * Check if section heading needs to be hidden or shown depending on wether the section contains
 * non hidden items or not
 */
function hideOrShowSectionHeadings(sectionTitleCssSelector) {
    $(sectionTitleCssSelector).each(function (index) {
        var sectionContent = $(this).nextUntil(sectionTitleCssSelector, '.form-group:not(.hide)');

        if (sectionContent.length === 0) {
            $(this).addClass('hide');
        } else {
            $(this).removeClass('hide');
        }
    });
}

/**
 * Apply conditions to other questions
 */
function showOrHideConditionnedQuestions($this) {
    fieldName = $this.prop('name');
    fieldName = (fieldName.match(/(.*?)\[/)) ? fieldName.match(/(.*?)\[/)[1] : fieldName;

    fieldCondition = $this.val();
    isChecked = $this.prop('checked');

    // If there is a condition for that field
    if (conditions.hasOwnProperty(fieldName)) {
        // If the field has a condition heading
        if (conditions[fieldName].hasOwnProperty(fieldCondition)) {
            // For every targets undet that condition, process item
            for (var targetField in conditions[fieldName][fieldCondition]) {
                show = conditions[fieldName][fieldCondition][targetField];

                // If the condition is to show and the box is checked then show,
                if (show && isChecked) {
                    $('div[data-field-name="' + targetField + '"]').removeClass('hide');
                } else {
                    $('div[data-field-name="' + targetField + '"]').addClass('hide');
                }
            }
        }
    }

    // Hide or show section headings
    hideOrShowSectionHeadings(sectionTitleCssSelector);
}
