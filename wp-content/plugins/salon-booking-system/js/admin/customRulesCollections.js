jQuery(function() {
    jQuery(".sln-booking-rules").each(function() {
        initBookingRules(jQuery(this));
    });
    jQuery(".sln-booking-holiday-rules").each(function() {
        initBookingHolidayRules(jQuery(this));
    });

    jQuery("body").on("change", "[data-unhide]", function() {
        jQuery(jQuery(this).data("unhide")).toggle(
            jQuery(this).is(":checked") ? false : true
        );
        if (jQuery(this).is(":checked")) {
            console.log("checked");
            jQuery(jQuery(this).data("unhide")).removeClass(
                "sln-box--appeared"
            );
        } else {
            console.log("not checked");
            jQuery(jQuery(this).data("unhide")).addClass("sln-box--appeared");
        }
    });
    jQuery("[data-unhide]").trigger('change');

    jQuery("body").on(
        "change",
        ".sln-disable-second-shift input",
        toggleSecondShift
    );
    jQuery(".sln-disable-second-shift input").trigger("change");
});

function bindRemoveFunction() {
    jQuery(this)
        .parent()
        .parent()
        .parent()
        .remove();
    return false;
}

function bindRemove() {
    jQuery('button[data-collection="remove"]')
        .off("click", bindRemoveFunction)
        .on("click", bindRemoveFunction);
}

function bindDisableSecondShift() {
    jQuery(".sln-disable-second-shift input")
	.off("change", bindDisableSecondShiftFunction)
        .on("change", bindDisableSecondShiftFunction);
}

function bindDisableSecondShiftFunction() {
    jQuery(this)
        .closest(".sln-booking-rule")
        .find(
            ".sln-second-shift .slider-time-input-from, .sln-second-shift .slider-time-input-to"
        )
        .prop("disabled", jQuery(this).prop("checked"));
}

function initBookingRules(elem) {
    var prototype = elem.find('div[data-collection="prototype"]');
    var wrapper = elem.find(".sln-booking-rules-wrapper");
    var html = prototype.html();
    var count = prototype.data("count");
    prototype.remove();

    jQuery('button[data-collection="addnew"]', elem).on('click', function(e) {
        count++;
        e.preventDefault();
        wrapper.append(html.replace(/__new__/g, count));
        bindRemove();
        bindDisableSecondShift();

        initDatepickers(jQuery);
        initTimepickers(jQuery);
        customSliderRange(jQuery, jQuery(".slider-range"));
        jQuery("[data-unhide]", elem).trigger('change');
        jQuery(".sln-booking-rule:last-child input").prop( "checked", true );
    });
    bindRemove();
    bindDisableSecondShift();
}

function initBookingHolidayRules(elem) {
    var prototype = elem.find('div[data-collection="prototype"]');
    var html = prototype.html();
    var count = prototype.data("count");
    var wrapper = elem.find(".sln-booking-holiday-rules-wrapper");
    prototype.remove();

    jQuery('button[data-collection="addnewholiday"]', elem).on('click', function(e) {
        e.preventDefault();
        wrapper.append(html.replace(/__new__/g, count));
        count++;
        initDatepickers(jQuery);
        initTimepickers(jQuery);
        bindRemove();
    });
    bindRemove();
}

function toggleSecondShift(e) {
    var disable = jQuery(this).prop("checked");
    if (disable) {
        jQuery(this)
            .parent()
            .parent()
            .parent()
            .find(
                'input[name="salon_settings[availabilities][1][from][1]"],input[name="salon_settings[availabilities][1][to][1]"]'
            )
            //.removeAttr("disabled");
            .attr("disabled", "disabled");
        jQuery(this)
            .parent()
            .parent()
            .parent()
            .find(".sln-slider-wrapper-second-shift")
            .removeClass("sln-slider--disabled")
            .removeAttr("hidden")
            .find(".sln-slider__inner")
            //.show();
            .hide();
    } else {
        jQuery(this)
            .parent()
            .parent()
            .parent()
            .find(".sln-slider-wrapper-second-shift")
            .find(
                'input[name="salon_settings[availabilities][1][from][1]"],input[name="salon_settings[availabilities][1][to][1]"]'
            )
            //.attr("disabled", "disabled");
            .removeAttr("disabled");
        jQuery(this)
            //.closest(".sln-box-maininfo")
            .parent()
            .parent()
            .parent()
            .find(".sln-slider-wrapper-second-shift")
            .addClass("sln-slider--disabled")
            .find(".sln-slider__inner")
            //.hide();
            .show();
    }
}
