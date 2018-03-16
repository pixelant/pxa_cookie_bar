var PxaCookieWarning = (function () {
	/**
	 * Simulate singleton
	 */
	var _instance = null;

	/**
	 * Initialize
	 * @constructor
	 */
	function PxaCookieWarning() {
	}

	PxaCookieWarning.prototype = {
		/**
		 * Init main events handlers and cookie bar state
		 */
		init: function () {
			if (this._isVisibleCookieBar()) {
				if (!PxaCookieBarHelper.settings.activeConsent) {
					PxaCookieBarHelper.markBarAsHidden();
				}

				this._initCookieBarClick();
			}
		},

		/**
		 * Check if bar is visible by cookie
		 *
		 * @returns {boolean}
		 * @private
		 */
		_isVisibleCookieBar: function () {
			return !PxaCookieBarHelper.isCookieSet();
		},

		/**
		 * Catch click on buttons
		 *
		 * @private
		 */
		_initCookieBarClick: function () {
			var that = this;

			var __clickHandler = function () {
				var attribute = this.getAttribute('id');

				if (attribute === 'accept-cookie') {
					PxaCookieBarHelper.markBarAsHidden();
				}

				that._hideCookieBar();
			};

			var buttons = document.getElementsByClassName('pxa-cookie-buttons');

			for (var i = 0; i < buttons.length; i++) {
				buttons[i].addEventListener('click', __clickHandler, false);
			}
		},

		/**
		 * Make cookie bar hidden
		 *
		 * @private
		 */
		_hideCookieBar: function () {
			var e = document.getElementById('pxa-cookie-bar');
			e.style.cssText = 'display:none';
		}
	};

	/**
	 * public method
	 */
	return {
		init: function () {
			if (_instance === null) {
				_instance = new PxaCookieWarning();
				_instance.init();
			}
		}
	}
})();

PxaCookieWarning.init();