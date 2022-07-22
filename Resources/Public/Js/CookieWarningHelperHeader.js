var PxaCookieBarHelper = {
	/**
	 * Cookie name
	 */
	cookieName: 'pxa_cookie_warning',

	/**
	 * Is cookie set
	 */
	cookieIsSet: null,

	/**
	 * Class of html
	 */
	visibleCookieBarClass: 'visible-cookie-warning',

	/**
	 * Settings of bar
	 */
	settings: null,

	/**
	 * init all we need at start
	 */
	init: function () {
		if (this.settings.activeConsent && !this.isCookieSet()) {
			this.preventJsFromSettingCookies();
		}
		if (!this.isCookieSet()) {
			this.setDocumentClass(this.visibleCookieBarClass);
		}
	},

	/**
	 * This will prevent browser from settings cookies using JS
	 */
	preventJsFromSettingCookies: function () {
		if (!document.__defineGetter__) {
			Object.defineProperty(document, 'cookie', {
				get: function () {
					return '';
				},
				set: function () {
					return true
				}
			});
		} else {
			document.__defineGetter__('cookie', function () {
				return '';
			});
			document.__defineSetter__('cookie', function () {
			});
		}
	},

	/**
	 * Get cookie value
	 * @param c_name
	 * @returns string
	 */
	getCookie: function (c_name) {
		var i, x, y, ARRcookies = document.cookie.split(';');
		for (i = 0; i < ARRcookies.length; i++) {
			x = ARRcookies[i].substr(0, ARRcookies[i].indexOf('='));
			y = ARRcookies[i].substr(ARRcookies[i].indexOf('=') + 1);
			x = x.replace(/^\s+|\s+$/g, '');
			if (x === c_name) {
				return decodeURI(y);
			}
		}
	},

	/**
	 * Check if cookie is set (Bar is visible or not)
	 * @returns {null}
	 */
	isCookieSet: function () {
		if (this.cookieIsSet === null) {
			this.cookieIsSet = parseInt(this.getCookie(this.cookieName)) === 1;
		}

		return this.cookieIsSet;
	},

	/**
	 * Set class for document
	 *
	 * @param className
	 */
	setDocumentClass: function (className) {
		document.documentElement.className += (document.documentElement.className === '' ? '' : ' ') + className;
	},

	/**
	 * Set settings from outside
	 *
	 * @param settings
	 */
	setSettings: function (settings) {
		this.settings = settings;
	}
};
