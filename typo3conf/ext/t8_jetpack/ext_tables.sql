#
# Modifying pages table
# add fields to set if pagetitle should be visible in frontend and how its aligned
#
CREATE TABLE pages (
    tx_t8jetpack_showpagetitle smallint(5) unsigned DEFAULT '0' NOT NULL,
    tx_t8jetpack_pagetitlealignment varchar(255) DEFAULT '' NOT NULL,
);

#
# add columns to tt_content
#
CREATE TABLE tt_content (
    tx_t8jetpack_headerhyphenation smallint(5) unsigned DEFAULT '1' NOT NULL,
    tx_t8_jetpack_headerstyle varchar(255) DEFAULT '' NOT NULL,
    tx_t8_jetpack_imageratio varchar(255) DEFAULT '' NOT NULL,
);

#
# add columns to sys_file_reference
#
CREATE TABLE sys_file_reference (
    image_alignment_vertical varchar(255) DEFAULT '' NOT NULL,
    image_alignment_horizontal varchar(255) DEFAULT '' NOT NULL,
    banner_text text,
);
