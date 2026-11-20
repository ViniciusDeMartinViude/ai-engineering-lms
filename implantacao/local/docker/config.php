<?php
unset($CFG);
$CFG = new stdClass();
$CFG->dbtype = 'pgsql';
$CFG->dblibrary = 'native';
$CFG->dbhost = 'db';
$CFG->dbname = 'moodle';
$CFG->dbuser = 'moodle_app';
$CFG->dbpass = getenv('MOODLE_DB_PASSWORD');
$CFG->prefix = 'mdl_';
$CFG->wwwroot = getenv('MOODLE_URL');
$CFG->dataroot = '/srv/moodledata';
$CFG->admin = 'admin';
$CFG->routerconfigured = true;
$CFG->smtphosts = 'mailpit:1025';
require_once(__DIR__ . '/lib/setup.php');
