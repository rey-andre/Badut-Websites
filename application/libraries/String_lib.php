<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class String_lib {
    public function escape_html($string) 
    {
        return htmlentities($string, ENT_QUOTES, 'UTF-8');
    }
}