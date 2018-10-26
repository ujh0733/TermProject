<?php
	class BoardDao{
		private $db;

		public function __construct(){
			try{
				$this->db = new PDO("mysql:host=localhost;dbname=termproject", "root", "");
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}catch(PDOException $e){
				exit($e->getMessage());
			}
		}

		public function getBoardCnt(){
			try{
				$sql = "select count(*) as 'count' from board";

				$pstmt = $this->db->prepare($sql);
				$pstmt->execute();
				$rs = $pstmt->fetchColumn();
			}catch(PDOException $e) {
				exit($e->getMessage());
			}
			return $rs;
		}
		public function getBoardPage(){
			try{
				$sql = "select * from board order by board_num desc";

				$pstmt = $this->db->prepare($sql);
				$pstmt->execute();

				$rs = $pstmt->fetchAll(PDO::FETCH_ASSOC);
			}catch(PDOException $e){
				exit($e->getMessage());
			}
			return $rs;
		}

		public function writeBoard($num, $title, $context, $writer, $opener, $start_day, $end_day, $place, $time, $genre, $price, $viewingClass, $picture){
				try{
					$sql = "insert into board values(:num, :title, :context, :writer, :opener, :start_day, :end_day, time(now()), 0, :place, :time, :viewingClass, :price, :genre, :picture)";

					$pstmt = $this->db->prepare($sql);
					$pstmt->bindValue(":num", $num, PDO::PARAM_STR);
					$pstmt->bindValue(":title", $title, PDO::PARAM_STR);
					$pstmt->bindValue(":context", $context, PDO::PARAM_STR);
					$pstmt->bindValue(":writer", $writer, PDO::PARAM_STR);
					$pstmt->bindValue(":opener", $opener, PDO::PARAM_STR);
					$pstmt->bindValue(":start_day", $start_day, PDO::PARAM_STR);
					$pstmt->bindValue(":end_day", $end_day, PDO::PARAM_STR);
					$pstmt->bindValue(":place", $place, PDO::PARAM_STR);
					$pstmt->bindValue(":time", $time, PDO::PARAM_INT);
					$pstmt->bindValue(":viewingClass", $viewingClass, PDO::PARAM_STR);
					$pstmt->bindValue(":price", $price, PDO::PARAM_INT);
					$pstmt->bindValue(":genre", $genre, PDO::PARAM_STR);
					$pstmt->bindValue(":picture", $picture, PDO::PARAM_STR);

					$pstmt->execute();
				}catch(PDOException $e){
					exit($e->getMessage());
				}
			}

			public function getPrint(){	//메인페이지에서 기간순으로 뿌리기
				try{
					$sql = "select * from board ORDER BY board_term_open desc";

					$pstmt = $this->db->prepare($sql);
					$pstmt->execute();

					$result = $pstmt->fetchAll(PDO::FETCH_ASSOC);
				}catch(PDOException $e) {
					exit($e->getMessage());
				}
				return $result;
			}

			public function getPrintViewed(){//메인페이지에서 조회수 순으로 뿌리기
				try{
					$sql = "select * from board ORDER BY board_viewed desc";

					$pstmt = $this->db->prepare($sql);
					$pstmt->execute();

					$result = $pstmt->fetchAll(PDO::FETCH_ASSOC);
				}catch(PDOException $e){
					exit($e->getMessage());
				}
				return $result;
			}

			public function deleteBoard($num){
				try{
					$sql = "delete from board where board_num = :board_num";

					$pstmt = $this->db->prepare($sql);
					$pstmt->bindValue(":board_num", $num, PDO::PARAM_INT);

					$pstmt->execute();
				}catch(PDOException $e){
					exit($e->getMessage());
				}
			}

			public function sortBoard($num){
				try{
					$sql = "update board set board_num = board_num -1 where board_num > :board_num";
					$pstmt = $this->db->prepare($sql);
					$pstmt->bindValue(":board_num", $num, PDO::PARAM_INT);
					$pstmt->execute();
				}catch(PDOException $e){
					exit($e->getMessage());
				}
			}

			public function updateBoard($num, $title, $context, $writer, $opener, $start_day, $end_day, $place, $time, $genre, $price, $viewingClass, $picture){
				try{
					$sql = "update board set board_title = :title, board_context = :context, board_writer = :writer, board_opener = :opener, board_term_open = :start_day, board_term_close = :end_day, board_place = :place, board_performanceTime = :time, board_viewingClass = :viewingClass, board_price = :price, board_genre = :genre, board_picture = :picture where board_num = :num";

					$pstmt = $this->db->prepare($sql);

					$pstmt->bindValue(":num", $num, PDO::PARAM_STR);
					$pstmt->bindValue(":title", $title, PDO::PARAM_STR);
					$pstmt->bindValue(":context", $context, PDO::PARAM_STR);
					$pstmt->bindValue(":writer", $writer, PDO::PARAM_STR);
					$pstmt->bindValue(":opener", $opener, PDO::PARAM_STR);
					$pstmt->bindValue(":start_day", $start_day, PDO::PARAM_STR);
					$pstmt->bindValue(":end_day", $end_day, PDO::PARAM_STR);
					$pstmt->bindValue(":place", $place, PDO::PARAM_STR);
					$pstmt->bindValue(":time", $time, PDO::PARAM_INT);
					$pstmt->bindValue(":viewingClass", $viewingClass, PDO::PARAM_INT);
					$pstmt->bindValue(":price", $price, PDO::PARAM_INT);
					$pstmt->bindValue(":genre", $genre, PDO::PARAM_STR);
					$pstmt->bindValue(":picture", $picture, PDO::PARAM_STR);

					$pstmt->execute();

				}catch(PDOException $e){
					exit($e->getMessage());
				}
			}

			public function getBoard($num){
				try{
					$sql = "select * from board where board_num = :num";

					$pstmt = $this->db->prepare($sql);
					$pstmt->bindValue(":num", $num, PDO::PARAM_INT);
					$pstmt->execute();

					$result = $pstmt->fetch(PDO::FETCH_ASSOC);

				}catch(PDOException $e){
					exit($e->getMessage());
				}
				return $result;
			}

			public function increaseViewed($num){
				try{
					$sql = "update board set board_viewed = board_viewed + 1 where board_num = :num";

					$pstmt = $this->db->prepare($sql);
					$pstmt->bindValue(":num", $num, PDO::PARAM_INT);
					$pstmt->execute();

				}catch(PDOException $e){
					exit($e->getMessage());
				}
			}

			public function selectSearch($txt){
				try{
					$sql = "select * from board where board_title LIKE '%$txt%'";

					$pstmt = $this->db->prepare($sql);
					//$pstmt->bindValue(":txt", $txt, PDO::PARAM_STR);
					$pstmt->execute();

					$result = $pstmt->fetchAll(PDO::FETCH_ASSOC);
				}catch (PDOException $e){
					exit($e->getMessage());
				}
				return $result;
			}

			public function getViewingClass($num){
				try{
					$sql = "select Class from viewingClass where viewingClass = :num";

					$pstmt = $this->db->prepare($sql);
					$pstmt->bindValue(":num", $num, PDO::PARAM_INT);
					$pstmt->execute();

					$rs = $pstmt->fetchColumn();
				}catch(PDOException $e) {
					exit($e->getMessage());
				}
				return $rs;
			}

			public function getBoardGenre($genre){
				try{
					$sql = "select Class from genre where genre = :genre";

					$pstmt = $this->db->prepare($sql);
					$pstmt->bindValue(":genre", $genre, PDO::PARAM_STR);
					$pstmt->execute();
					$rs = $pstmt->fetchColumn();

				}catch(PDOException $e) {
					exit($e->getMessage());
				}
				return $rs;
			}

			public function getBoardViewingClass($viewing){
				try{
					$sql = "select Class from viewingClass where viewingClass = :viewing";

					$pstmt = $this->db->prepare($sql);
					$pstmt->bindValue(":viewing", $viewing, PDO::PARAM_STR);
					$pstmt->execute();

					$rs = $pstmt->fetchColumn();
				}catch(PDOException $e) {
					exit($e->getMessage());
				}
				return $rs;
			}

	}
?>