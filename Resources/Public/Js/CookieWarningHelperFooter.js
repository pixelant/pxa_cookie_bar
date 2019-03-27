(function (w, undefined) {
	var document = w.document,
		PxaCookieBarHelper = w.PxaCookieBarHelper || {};

	PxaCookieBarHelper.markBarAsHidden = markBarAsHidden;
	PxaCookieBarHelper.setCookie = setCookie;
	PxaCookieBarHelper.removeDocumentClass = removeDocumentClass;

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

	/**
	 * Set cookie that marks cookie bar as hidden
	 */
	function markBarAsHidden() {
		setCookie(PxaCookieBarHelper.cookieName, 1, 365);
	}

	/**
	 * Remove document class
	 *
	 * @param className
	 */
	function removeDocumentClass(className) {
		document.documentElement.classList.remove(className);
	}

	w.PxaCookieBarHelper = PxaCookieBarHelper;
})(window);