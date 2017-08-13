<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Configuration file for Email library
 */
$config['protocol'] = 'smtp';
$config['charset'] = 'utf-8';
$config['mailtype'] = 'html';
// $config['smtp_timeout'] = 5;
$config['smtp_host'] = 'localhost';
$config['smtp_port'] = 587;
$config['smtp_user'] = 'EMAIL_ID';
$config['smtp_pass'] = 'PASSWORD';
$config['wordwrap'] = true;