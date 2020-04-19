<?php
/* data base parameters*/

class db {
	private $username = "root";
	private $password = "";
	private $servername = "localhost";
	private $dbname = "trad";
	private $conn;
	/*
	*constructeur objet
	*/
	public function __construct () {
		//conexion à la base de donnée
		$this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
		//activation du mode d'erreur
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//$this->create_tables();
	}
	public function create_tables(){
		//verifier l'existabce de des différentes tables (que l'on fera plus tard)
		 $sql = "CREATE TABLE trad_movies(
                        Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        Title VARCHAR(200) NOT NULL,
                        Description VARCHAR(200) NOT NULL,
                        Type VARCHAR(100) NOT NULL,
                        Actors VARCHAR(200) NOT NULL,
                        Producers VARCHAR(200) NOT NULL,
                        Directors VARCHAR(200) NOT NULL,
                        Country VARCHAR(30) NOT NULL,
                        Release_date INT UNSIGNED NOT NULL,
                        Mark INT UNSIGNED NOT NULL,
                        Words VARCHAR(1000) NOT NULL,
                        Image VARCHAR(200) NOT NULL,
                        Slug VARCHAR(200) NOT NULL,
                        DateSave TIMESTAMP)
                        ";
                
        $this->conn->exec($sql);
        $sql = "CREATE TABLE trad_vocs(
        				Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        				Word VARCHAR(200) NOT NULL)
       					";
       	$this->conn->exec($sql);
	}
	public function add_movie($args) {

	}
	public function add_word($args) {
		$sql = $this->conn->prepare("INSERT INTO trad_vocs(Word) VALUES(:Word)");
		$sql->execute(array('Word' => $args["Word"]));

	}
	public function add_words($words) {
		ini_set('max_execution_time', 0);
		$sql = $this->conn->prepare("INSERT INTO trad_vocs(Word) VALUES(:Word)");
		foreach ($words as $word) {
			$sql->execute(array('Word' => $word));
		}
	} 

	public function get_all_movies() {

		$req = $this->conn->prepare('SELECT * FROM trad_movies');
		$req->execute();
		$i = 0;
		$return = array();
		while($data = $req->fetch()) {
			$return[$i] = $data;
			$i++;
		}
		return $return;
	}
	public function test() {
		ini_set('max_execution_time', 0);
		$path = __DIR__ . "/../sub/the-hangover-sub.srt";
		$res = fopen($path, 'r');
		$content = fread($res, filesize($path));
		$content = preg_replace("/[0-9]{2}:[0-9]{2}:[0-9]{2},[0-9]{3}/", "", $content);
		$content = preg_replace("/ --> /", "", $content);
		$content = preg_replace("/[0-9]/", "", $content);
		$sql = $this->conn->prepare('SELECT Word,Id FROM trad_vocs');
		$sql->execute();
		$data = array();
		$i=0;
		$words = array();
		while ($fetch = $sql->fetch()) {

			$data[$i] = '(' . preg_replace("/,/", "|", $fetch['Word']) . ')';
			if(preg_match('/\b'.$data[$i].'\b/', $content)) {
				array_push($words, $fetch['Id']);
				echo $fetch['Id'] . ',';
			}
			$i++;
		}
		print_r($words);
		

	} 
	
}