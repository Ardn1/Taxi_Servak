<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['per_page']             = 20;
$config['reuse_query_string']   = TRUE;

$config['attributes']           = array('class' => 'page-link');

$config['full_tag_open']        = '<nav aria-label="Page pagination"><ul class="pagination justify-content-end pagination-sm">';
$config['full_tag_close']       = '</ul></nav>';

$config['first_link']           = 'First';
$config['first_tag_open']       = '<li class="page-item">';
$config['first_tag_close']      = '</li>';

$config['last_link']            = 'Last';
$config['last_tag_open']        = '<li class="page-item">';
$config['last_tag_close']       = '</li>';

$config['prev_link']            = '«';
$config['prev_tag_open']        = '<li class="page-item">';
$config['prev_tag_close']       = '</li>';

$config['next_link']            = '»';
$config['next_tag_open']        = '<li class="page-item">';
$config['next_tag_close']       = '</li>';

$config['cur_tag_open']         = '<li class="page-item active"><span class="page-link">';
$config['cur_tag_close']        = '</span></li>';

$config['num_tag_open']         = '<li>';
$config['num_tag_close']        = '</li>';