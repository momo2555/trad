<?php
class Movie{
	private $details = array(
		"Title"=>"",
		"Id" => 0,
		"Description");
	public function __construct() {

	}
	static function get_all_movies() {
		$db = new db();
		$movies = $db->get_all_movies();
		return $movies;
	}
}