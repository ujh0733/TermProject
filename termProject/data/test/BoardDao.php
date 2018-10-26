<?php
class BoardDAO{
	private $db;

	public function __construct(){
		try {
			$this->db = new PDO("mysql:host=localhost;dbname=login", "root", "");

			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			exit($e->getMessage());
		}
	}

	public function insertMsg($title, $writer, $content){
		//sql문 만들고.. insert문
		//prepare 시키고
		//넘어온 값 binding 시키고
		//실행요청하고...
		try{
			$sql = "insert into board2(Title, Writer, Content) values(:title, :writer, :content)";

			$pstmt = $this->db->prepare($sql);
			$pstmt->bindValue(":title", $title, PDO::PARAM_STR);
			$pstmt->bindValue(":writer", $writer, PDO::PARAM_STR);
			$pstmt->bindValue(":content", $content, PDO::PARAM_STR);
			$pstmt->execute();
			
		}catch (PDOException $e) {
			exit($e->getMessage());	
		}
	}

	public function getManyMsgs($start, $rows){
		try{
			/*
				1. sql:select * from board;
				2. prepare
				3. binding X, execute O
			*/
				
			$sql = "select * from board2 order by Num desc limit :start, :rows";

			$query = $this->db->prepare($sql);
			/*$pstmt->execute();
			$msgs = $pstmt->fetchAll(PDO::FETCH_ASSOC);*/
			
			/*
			$query = $this->db->prepare("select * from board2 order by Num desc limit :start, :rows");*/
			$query->bindValue(":start", $start, PDO::PARAM_INT);
			$query->bindValue(":rows", $rows, PDO::PARAM_INT);
			$query->execute();

			$msgs = $query->fetchAll(PDO::FETCH_ASSOC);

		}catch (PDOException $e) {
			exit($e->getMessage());
		}
		return $msgs;
	}

	public function getMsgs(){
		try{
			/*
				1. sql:select * from board;
				2. prepare
				3. binding X, execute O
			*/
			$sql = "select * from board2";

			$pstmt = $this->db->prepare($sql);
			$pstmt->execute();
			$msgs = $pstmt->fetchAll(PDO::FETCH_ASSOC);

		}catch (PDOException $e) {
			exit($e->getMessage());
		}
		return $msgs;
	}

	public function updateMsg($num, $title, $writer, $content){
		try{
			$sql = "update board2 set Title = :title, Writer = :writer, Content = :content where Num = :num ";

			$pstmt = $this->db->prepare($sql);
			$pstmt->bindValue(":num", $num, PDO::PARAM_INT);
			$pstmt->bindValue(":title", $title, PDO::PARAM_INT);
			$pstmt->bindValue(":writer", $writer, PDO::PARAM_INT);
			$pstmt->bindValue(":content", $content, PDO::PARAM_INT);
			
			$pstmt->execute();
		}catch(PDOException $e){
			exit($e->getMessage());
		}
	}

	public function getNumMsgs(){
		try{
			/*
			$query = $this->db->prepare("select count(*) from board2");

			$query->execute();

			$numMsgs = $query->fetchColumn();*/
			$sql = "select count(*) from board2";

			$pstmt = $this->db->prepare($sql);

			$pstmt->execute();

			$numMsgs = $pstmt->fetchColumn();
		}catch(PDOException $e) {
			exit($e->getMessage());
		}
		return $numMsgs;
	}
}
?>