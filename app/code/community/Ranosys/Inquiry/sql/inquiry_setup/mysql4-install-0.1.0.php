<?php
/**
 * Cart inquiry 
 *
 * @category   Ranosys
 * @package    Ranosys_Inquiry
 * @author     Ranosys Technologies Pvt. Ltd. 
 */  
$installer = $this;

$installer->startSetup();

$installer->run("
    -- DROP TABLE IF EXISTS {$this->getTable('inquiry')};
    CREATE TABLE {$this->getTable('inquiry')} (
      `id` int(11) unsigned NOT NULL auto_increment,
      `firstname` varchar(255) NOT NULL default '',
      `lastname` varchar(255) NOT NULL default '',
      `email` varchar(255) NOT NULL default '',
      `phone` bigint(20) NOT NULL default '0',
      `message` text NOT NULL default '',
      `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
     `status` enum('0','1') NOT NULL DEFAULT '0',
     `pid` text NOT NULL default '',
     `pname` text NOT NULL default '',
     `psku` text NOT NULL default '',     
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
     
        ");
     
    $installer->endSetup();


