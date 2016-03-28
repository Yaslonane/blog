<?php 

class Config {
	
	var $sitename = "Test.local";
	var $address = "http://test.test/blog/";
	var $secret = "dog9999";
	var $host = "localhost";
	var $name_db = "site";
	var $db_prefix = "site_";
	var $user = "mysql";
	var $password = "mysql";
	var $dir_img = "img/articles/"; //путь к картинкам статей
	var $dir_tmpl = "tmpl/"; //путь к шаблону
	var $count_blog = 3; //количество статей на странице
	
	var $min_login = 3;
	var $max_login = 150;
}

?>