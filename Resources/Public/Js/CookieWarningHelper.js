(function (w, undefined) {
	var document = w.document,
		PxaCookieBar = w.PxaCookieBar || {};

	PxaCookieBar.Helper = {
		cookieName: 'pxa_cookie_warning',

		cookieIsSet: null,

		pxaPreventJsFromSettingCookies: function () {
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

		setCookie: function (cName, value, exdays) {
			var exdate = new Date();
			exdate.setDate(exdate.getDate() + exdays);
			var cValue = encodeURI(value) + ((exdays === null) ? '' : '; expires=' + exdate.toUTCString()) + '; path=/';
			document.cookie = cName + '=' + cValue;
		},

		isCookieSet: function () {
			if (this.cookieIsSet === null) {
				this.cookieIsSet = parseInt(this.getCookie(this.cookieName)) === 1;
			}

			return this.cookieIsSet;
		},

		setDocumentClass: function (className) {
			document.documentElement.className += (document.documentElement.className === '' ? '' : ' ') + className;
		}
	}
})(window);