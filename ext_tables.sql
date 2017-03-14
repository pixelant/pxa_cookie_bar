#
# Table structure for table 'tx_pxacookiebar_domain_model_cookiewarning'
#
CREATE TABLE tx_pxacookiebar_domain_model_cookiewarning (

  uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	warningmessage text NOT NULL,
	linktext varchar(255) DEFAULT '' NOT NULL,
	page varchar(55) DEFAULT '' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3_origuid int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY language (l10n_parent,sys_language_uid)
);
