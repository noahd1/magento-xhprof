<?php

$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS `{$this->getTable('xhprof/record')}`;
CREATE TABLE IF NOT EXISTS `{$this->getTable('xhprof/record')}` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `path_info` varchar(255) NOT NULL DEFAULT '',
  `request_method` varchar(255) NOT NULL DEFAULT '',
  `controller` varchar(255) NOT NULL DEFAULT '',
  `action` varchar(255) NOT NULL DEFAULT '',
  `route` varchar(255) NOT NULL DEFAULT '',
  `module` varchar(255) NOT NULL DEFAULT '',
  `parameters` varchar(1000),
  `raw_data` mediumblob,
  `pmu` int(11) unsigned DEFAULT NULL,
  `wt` int(11) unsigned DEFAULT NULL,
  `cpu` int(11) unsigned DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `cpu` (`cpu`),
  KEY `wt` (`wt`),
  KEY `pmu` (`pmu`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

$installer->endSetup();
