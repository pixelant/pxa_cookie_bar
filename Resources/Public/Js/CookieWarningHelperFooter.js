(function (w, undefined) {
	var document = w.document,
		PxaCookieBarHelper = w.PxaCookieBarHelper || {};

	PxaCookieBarHelper.markBarAsHidden = markBarAsHidden;
	PxaCookieBarHelper.setCookie = setCookie;

	/**
	 * Set cooke
	 * @param cName
	 * @param value
	 * @param exdays
	 */
	function setCookie(cName, value, exdays) {
		var exdate = new Date();
		exdate.setDate(exdate.getDate() + exdays);
		var cValue = encodeURI(value) + ((exdays === null) ? '' : '; expires=' + exdate.toUTCString()) + '; path=/';
		document.cookie = cName + '=' + cValue;
	}

	function markBarAsHidden() {
		setCookie(PxaCookieBarHelper.cookieName, 1, 365);
	}

	w.PxaCookieBarHelper = PxaCookieBarHelper;
})(window);