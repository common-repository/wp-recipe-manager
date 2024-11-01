(function ($) {
	"use strict";

	$(document).ready(function () {
		wp_recipe_manager.ready();
	});

	$(window).load(function () {
		wp_recipe_manager.load();
	});

	var wp_recipe_manager = window.$wp_recipe_manager = {

		/**
		 * Call functions when document ready
		 */
		ready: function () {
			this.complete_task();
		},

		/**
		 * Call functions when window load.
		 */
		load: function () {

		},

		// CUSTOM FUNCTION IN BELOW

		complete_task: function () {
			$('.recipe-steps, .recipe-ingredients').on('click', 'li,.step', function (e) {
				$(this).toggleClass('completed');
			});
		},

	};

})(jQuery);