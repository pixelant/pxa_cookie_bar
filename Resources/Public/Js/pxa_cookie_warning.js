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
				if (!PxaCookieBarHelper.settings.activeConsent && PxaCookieBarHelper.settings.oneTimeVisible) {
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

			var __clickHandler = function (e) {
				e.preventDefault();
				var attribute = this.getAttribute('id');

				if (attribute === 'accept-cookie') {
					var url = this.getAttribute('href');
					that._sendCloseCookieRequest(url);
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
			PxaCookieBarHelper.removeDocumentClass(PxaCookieBarHelper.visibleCookieBarClass);

			if (!PxaCookieBarHelper.settings.activeConsent && !PxaCookieBarHelper.settings.oneTimeVisible) {
				PxaCookieBarHelper.markBarAsHidden();
			}
		},

		/**
		 * Send ajax request for close bar
		 *
		 * @param url
		 * @private
		 */
		_sendCloseCookieRequest: function (url) {
			var x = this._getXhr();

			x.open('GET', url, true);
			x.send();
		},

		/**
		 * Initialize xhr
		 *
		 * @returns object
		 * @private
		 */
		_getXhr: function () {
			if (typeof XMLHttpRequest !== 'undefined') {
				return new XMLHttpRequest();
			}

			var versions = [
				"MSXML2.XmlHttp.6.0",
				"MSXML2.XmlHttp.5.0",
				"MSXML2.XmlHttp.4.0",
				"MSXML2.XmlHttp.3.0",
				"MSXML2.XmlHttp.2.0",
				"Microsoft.XmlHttp"
			];

			var xhr;

			for (var i = 0; i < versions.length; i++) {
				try {
					xhr = new ActiveXObject(versions[i]);
					break;
				} catch (e) {
				}
			}

			return xhr;
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
