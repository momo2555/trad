<?php
class Word {
	public function __construct () {

	}
	static function read_xml() {
		$fichier = __DIR__ .'/dico.xml';
  		$contenu = simplexml_load_file($fichier);
  		$words = [];
  		
  		if(isset($contenu->entry)) {

  			foreach($contenu->entry as $entry) {
  				$word = array();
  				if(isset($entry->lemma)) {
  					array_push($word, str_replace('\\', '', $entry->lemma));
  				}
  				if(isset($entry->inflected)) {
  					foreach ($entry->inflected as $inflected) {
  						if(isset($inflected->form)) {
  							array_push($word, str_replace('\\', '', $inflected->form));
  						}
  					}
  				}
  				array_push($words, join(",",$word));
  				
  			}
  			$db = new db();
  			//$args = array("Word" => join(",",$word));
  			$db->add_words($words);
  		}

  		
	}
}