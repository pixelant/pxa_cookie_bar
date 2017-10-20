#
# Table structure for table 'tx_pxacookiebar_domain_model_cookiewarning'
#
CREATE TABLE tx_pxacookiebar_domain_model_cookiewarning (

  uid              INT(11)                         NOT NULL AUTO_INCREMENT,
  pid              INT(11) DEFAULT '0'             NOT NULL,

  name             VARCHAR(55) DEFAULT ''          NOT NULL,
  warning_message  TEXT                            NOT NULL,
  link_text        VARCHAR(255) DEFAULT ''         NOT NULL,
  link_target      VARCHAR(55) DEFAULT ''          NOT NULL,
  active_consent   TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  one_time_visible TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,

  tstamp           INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  crdate           INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  cruser_id        INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  deleted          TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  hidden           TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,
  starttime        INT(11) UNSIGNED DEFAULT '0'    NOT NULL,
  endtime          INT(11) UNSIGNED DEFAULT '0'    NOT NULL,

  t3_origuid       INT(11) DEFAULT '0'             NOT NULL,
  sys_language_uid INT(11) DEFAULT '0'             NOT NULL,
  l10n_parent      INT(11) DEFAULT '0'             NOT NULL,
  l10n_diffsource  MEDIUMBLOB,

  PRIMARY KEY (uid),
  KEY parent (pid),
  KEY language (l10n_parent, sys_language_uid)
);
