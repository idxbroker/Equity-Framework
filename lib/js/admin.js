/**
 * This file controls the behaviours within the Equity Framework.
 *
 * Note that while this version of the file include 'use strict'; at the function level,
 * the Closure Compiler version strips that away. This is fine, as the compiler may
 * well be doing things that are not use strict compatible.
 *
 * @author IDX, LLC
 */

/* global equity, equity_L10n, equity_toggles, confirm */

/**
 * Holds Equity values in an object to avoid polluting global namespace.
 *
 * @since 1.0
 *
 * @constructor
 */
window[ 'equity' ] = {

	settingsChanged: false,

	/**
	 * Inserts a category checklist toggle button and binds the behaviour.
	 *
	 * @since 1.0
	 *
	 * @function
	 */
	categoryChecklistToggleInit: function() {
		'use strict';

		// Insert toggle button into DOM wherever there is a category checklist
		jQuery( '<p><span id="equity-category-checklist-toggle" class="button">' + equity_L10n.categoryChecklistToggle + '</span></p>' )
			.insertBefore( 'ul.categorychecklist' );

		// Bind the behaviour to click
		jQuery( document ).on( 'click.equity.equity_category_checklist_toggle', '#equity-category-checklist-toggle', equity.categoryChecklistToggle );
	},

	/**
	 * Provides the behaviour for the category checklist toggle button.
	 *
	 * On the first click, it checks all checkboxes, and on subsequent clicks it
	 * toggles the checked status of the checkboxes.
	 *
	 * @since 1.0
	 *
	 * @function
	 *
	 * @param {jQuery.event} event
	 */
	categoryChecklistToggle: function( event ) {
		'use strict';

		// Cache the selectors
		var $this = jQuery( event.target ),
			checkboxes = $this.parent().next().find( ':checkbox' );

		// If the button has already been clicked once, clear the checkboxes and remove the flag
		if ( $this.data( 'clicked' ) ) {
			checkboxes.removeAttr( 'checked' );
			$this.data( 'clicked', false );
		} else { // Mark the checkboxes and add a flag
			checkboxes.attr( 'checked', 'checked' );
			$this.data( 'clicked', true );
		}
	},

	/**
	 * Grabs the array of toggle settings and loops through them to hook in
	 * the behaviour.
	 *
	 * The equity_toggles array is filterable in load-scripts.php before being
	 * passed over to JS via wp_localize_script().
	 *
	 * @since 1.0
	 *
	 * @function
	 */
	toggleSettingsInit: function() {
		'use strict';

		jQuery.each( equity_toggles, function( k, v ) {

			// Prepare data
			var data = { selector: v[ 0 ], showSelector: v[ 1 ], checkValue: v[ 2 ] };

			// Setup toggle binding
			jQuery( 'div.equity-metaboxes' )
				.on( 'change.equity.equity_toggle', v[ 0 ], data, equity.toggleSettings );

			// Trigger the check when page loads too.
			// Can't use triggerHandler here, as that doesn't bubble the event up to div.equity-metaboxes.
			// We namespace it, so that it doesn't conflict with any other change event attached that
			// we don't want triggered on document ready.
			jQuery( v[ 0 ]).trigger( 'change.equity_toggle', data );
		});

	},

	/**
	 * Provides the behaviour for the change event for certain settings.
	 *
	 * Three bits of event data is passed - the jQuery selector which has the
	 * behaviour attached, the jQuery selector which to toggle, and the value to
	 * check against.
	 *
	 * The checkValue can be a single string or an array (for checking against
	 * multiple values in a dropdown) or a null value (when checking if a checkbox
	 * has been marked).
	 *
	 * @since 1.0
	 *
	 * @function
	 *
	 * @param {jQuery.event} event
	 */
	toggleSettings: function( event ) {
		'use strict';

		// Cache selectors
		var $selector = jQuery( event.data.selector ),
		    $showSelector = jQuery( event.data.showSelector ),
		    checkValue = event.data.checkValue;

		// Compare if a checkValue is an array, and one of them matches the value of the selected option
		// OR the checkValue is _unchecked, but the checkbox is not marked
		// OR the checkValue is _checked, but the checkbox is marked
		// OR it's a string, and that matches the value of the selected option.
		if (
			( jQuery.isArray( checkValue ) && jQuery.inArray( $selector.val(), checkValue ) > -1) ||
				( '_unchecked' === checkValue && $selector.is( ':not(:checked)' ) ) ||
				( '_checked' === checkValue && $selector.is( ':checked' ) ) ||
				( '_unchecked' !== checkValue && '_checked' !== checkValue && $selector.val() === checkValue )
		) {
			jQuery( $showSelector ).slideDown( 'fast' );
		} else {
			jQuery( $showSelector ).slideUp( 'fast' );
		}

	},

	/**
	 * When a input or textarea field field is updated, update the character counter.
	 *
	 * For now, we can assume that the counter has the same ID as the field, with a _chars
	 * suffix. In the future, when the counter is added to the DOM with JS, we can add
	 * a data( 'counter', 'counter_id_here' ) property to the field element at the same time.
	 *
	 * @since 1.0
	 *
	 * @function
	 *
	 * @param {jQuery.event} event
	 */
	updateCharacterCount: function( event ) {
		'use strict';
		jQuery( '#' + event.target.id + '_chars' ).html( jQuery( event.target ).val().length.toString() );
	},

	/**
	 * Provides the behaviour for the layout selector.
	 *
	 * When a layout is selected, the all layout labels get the selected class
	 * removed, and then it is added to the label that was selected.
	 *
	 * @since 1.0
	 *
	 * @function
	 *
	 * @param {jQuery.event} event
	 */
	layoutHighlighter: function( event ) {
		'use strict';

		// Cache class name
		var selectedClass = 'selected';

		// Remove class from all labels
		jQuery('input[name="' + jQuery(event.target).attr('name') + '"]').parent('label').removeClass(selectedClass);

		// Add class to selected layout
		jQuery(event.currentTarget).addClass(selectedClass);

	},

	/**
	 * Helper function for confirming a user action.
	 *
	 * @since 1.0
	 *
	 * @function
	 *
	 * @param {String} text The text to display.
	 * @returns {Boolean}
	 */
	confirm: function( text ) {
		'use strict';

		return confirm( text );

	},

	/**
	 * Have all form fields in Equity metaboxes set a dirty flag when changed.
	 *
	 * @since 1.0
	 *
	 * @function
	 */
	attachUnsavedChangesListener: function() {
		'use strict';

		jQuery( 'div.equity-metaboxes :input' ).change( function() {
			equity.registerChange();
		});
		window.onbeforeunload = function(){
			if ( equity.settingsChanged ) {
				return equity_L10n.saveAlert;
			}
		};
		jQuery( 'div.equity-metaboxes input[type="submit"]' ).click( function() {
			window.onbeforeunload = null;
		});
	},

	/**
	 * Set a flag, to indicate form fields have changed.
	 *
	 * @since 1.0
	 *
	 * @function
	 */
	registerChange: function() {
		'use strict';

		equity.settingsChanged = true;
	},

	/**
	 * Ask user to confirm that settings should now be reset.
	 *
	 * @since 1.0
	 *
	 * @function
	 *
	 * @return {Boolean} True if reset should occur, false if not.
	 */
	confirmReset: function() {
		'use strict';

		return confirm( equity_L10n.confirmReset );
	},

	/**
	 * Initialises all aspects of the scripts.
	 *
	 * Generally ordered with stuff that inserts new elements into the DOM first,
	 * then stuff that triggers an event on existing DOM elements when ready,
	 * followed by stuff that triggers an event only on user interaction. This
	 * keeps any screen jumping from occuring later on.
	 *
	 * @since 1.0
	 *
	 * @function
	 */
	ready: function() {
		'use strict';

		// Move all messages below our floated buttons
		jQuery( 'h2' ).nextAll( 'div.updated, div.error' ).insertAfter( 'p.top-buttons' );

		// Initialise category checklist toggle button
		equity.categoryChecklistToggleInit();

		// Initialise settings that can toggle the display of other settings
		equity.toggleSettingsInit();

		// Initialise form field changing flag.
		equity.attachUnsavedChangesListener();

		// Bind layout highlighter behaviour
		jQuery('.equity-layout-selector').on('change.equity.equity_layout_selector', 'label', equity.layoutHighlighter);

		// Bind reset confirmation
		jQuery( '.equity-js-confirm-reset' ).on( 'click.equity.equity_confirm_reset', equity.confirmReset );

	}

};

jQuery( equity.ready );