
CREATE TABLE tx_njcollection_domain_model_comment (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	fe_cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
  	endtime int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL, 
	
	author int(11) unsigned DEFAULT '0' NOT NULL,
	content text NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	foreign_table varchar(255) DEFAULT '' NOT NULL,
	foreign_uid int(11) DEFAULT '0' NOT NULL,
	name varchar(255) DEFAULT '' NOT NULL,
	title varchar(255) DEFAULT '' NOT NULL,
	url varchar(255) DEFAULT '' NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_njcollection_domain_model_content'
#

CREATE TABLE tx_njcollection_domain_model_content (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,
	fe_cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	l18n_diffsource mediumblob NOT NULL,
	l18n_parent int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,

    t3_origuid int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(30) DEFAULT '' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,
	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_stage tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
    
	headline varchar(255) DEFAULT '' NOT NULL,
	headline_hidden tinyint(1) DEFAULT '0' NOT NULL,
	headline_style varchar(255) DEFAULT '' NOT NULL,
	
	code text NOT NULL,
	code_lang varchar(25) DEFAULT '' NOT NULL,
	code_starting_line int(11) DEFAULT '1' NOT NULL,
	code_highlight_class varchar(255) DEFAULT '' NOT NULL,
	code_highlight_lines varchar(255) DEFAULT '' NOT NULL,
	code_highlight_style varchar(255) DEFAULT '' NOT NULL,
	


	content text NOT NULL,
	ctype varchar(25) DEFAULT '' NOT NULL,
	
	description text NOT NULL,

	foreign_uid int(11) unsigned DEFAULT '0' NOT NULL,
	foreign_table varchar(255) DEFAULT '' NOT NULL,

	gallery varchar(255) DEFAULT '' NOT NULL,

	html text NOT NULL,
	
	img varchar(255) DEFAULT '' NOT NULL,
	img_copyright varchar(255) DEFAULT '' NOT NULL,
	img_adjustment varchar(25) DEFAULT '' NOT NULL,
	img_width int(11) NOT NULL DEFAULT '0',
	img_height int(11) NOT NULL DEFAULT '0',
	img_use_thumb tinyint(1) NOT NULL DEFAULT '0',
	
	message text NOT NULL,
	message_type varchar(25) DEFAULT '' NOT NULL,
	
	vid_additional varchar(255) DEFAULT '' NOT NULL,
	vid_fullscreen tinyint(1) DEFAULT '0' NOT NULL,
	vid_id varchar(255) DEFAULT '' NOT NULL,
	vid_ratio tinyint(1) DEFAULT '0' NOT NULL,
	vid_type varchar(25) DEFAULT '' NOT NULL,
	vid_width int(11) DEFAULT '0' NOT NULL,
	yt_proposals tinyint(1) DEFAULT '0' NOT NULL,
	 
	PRIMARY KEY (uid),
	KEY parent (pid)
);


#  
# Table structure for table 'tx_njcollection_domain_model_form'
#

CREATE TABLE tx_njcollection_domain_model_form (
    uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    fe_cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,
    sorting int(11) unsigned DEFAULT '0' NOT NULL, 

    sender varchar(255) DEFAULT '' NOT NULL,
    ftype varchar(255) DEFAULT '' NOT NULL,
    fdata text NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid)
);


CREATE TABLE tx_njcollection_domain_model_rating (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	fe_cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
  	endtime int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL, 
	
	voter int(11) unsigned DEFAULT '0' NOT NULL,
	foreign_table varchar(255) DEFAULT '' NOT NULL,
	foreign_uid int(11) DEFAULT '0' NOT NULL,
	ip varchar(25) DEFAULT '' NOT NULL,
	rating int(11) DEFAULT '' NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#  
# Table structure for table 'tx_njcollection_domain_model_testimonial'
#

CREATE TABLE tx_njcollection_domain_model_testimonial (
    uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    fe_cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
    hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,
    sorting int(11) unsigned DEFAULT '0' NOT NULL, 

    sys_language_uid int(11) DEFAULT '0' NOT NULL,
    l18n_parent int(11) DEFAULT '0' NOT NULL,
    l18n_diffsource mediumblob NOT NULL,

    author varchar(255) DEFAULT '' NOT NULL,
    firm varchar(255) DEFAULT '' NOT NULL,
    image varchar(255) DEFAULT '' NOT NULL,
	position varchar(255) DEFAULT '' NOT NULL,
    testimonial text NOT NULL,
    title varchar(255) DEFAULT '' NOT NULL,
    
    t3ver_oid int(11) DEFAULT '0' NOT NULL,
    t3ver_id int(11) DEFAULT '0' NOT NULL,
    t3ver_wsid int(11) DEFAULT '0' NOT NULL,
    t3ver_label varchar(30) DEFAULT '' NOT NULL,
    t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
    t3ver_stage tinyint(4) DEFAULT '0' NOT NULL,
    t3ver_count int(11) DEFAULT '0' NOT NULL,
    t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
    t3_origuid int(11) DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid)
);