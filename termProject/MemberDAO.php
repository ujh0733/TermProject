<?php
	class MemberDao{
		private $db;


		public function __construct(){
			try{
				$this->db = new PDO("mysql:host=localhost;dbname=termproject", "root", "");
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}catch(PDOException $e){
				exit($e->getMessage());
			}
		}

		public function getDB(){
			return $this->db;
		}
		
		public function authCheck($id){
			try{
				$sql = "select * from member where user_id = :id";

				$pstmt = $this->db->prepare($sql);
				$pstmt->bindValue(":id", $id, PDO::PARAM_STR);
				$pstmt->execute();
				$result = $pstmt->fetch(PDO::FETCH_ASSOC);

				$auth = $result["user_auth"];

			}catch(PDOException $e){
				exit($e->getMessage());
			}
			return $auth;
		}

		public function getMember($id){
			try{
				$sql = "select * from member where user_id = :id";

				$pstmt = $this->db->prepare($sql);
				$pstmt->bindValue(":id", $id, PDO::PARAM_STR);
				$pstmt->execute();
				$result = $pstmt->fetch(PDO::FETCH_ASSOC);

			}catch(PDOException $e){
				exit($e->getMessage());
			}
			return $result;
		}

		public function insertIP($id, $ip){
			try{
				$sql = "update member set user_ip = :ip where user_id = :id";

				$pstmt = $this->db->prepare($sql);
				$pstmt->bindValue(":ip", $ip, PDO::PARAM_STR);
				$pstmt->bindValue(":id", $id, PDO::PARAM_STR);
				$pstmt->execute();
				
			}catch(PDOException $e){
				exit($e->getMessage());
			}
		}

		public function getProfile($id){
			try{
				$sql = "select * from member where user_id = :id";

				$pstmt = $this->db->prepare($sql);
				$pstmt->bindValue(":id", $id, PDO::PARAM_STR);
				$pstmt->execute();
				$result = $pstmt->fetch(PDO::FETCH_ASSOC);

				$profile = $result["user_profile"];

			}catch(PDOException $e){
				exit($e->getMessage());
			}
				return $profile;
		}

		public function updateMember($id, $pwd, $name, $email, $phone, $birth, $profile){
			try{
				$sql = "update member set user_pwd = :pwd, user_name = :name, user_email = :email, user_phone = :phone, user_birth = :birth, user_profile = :profile where user_id = :id";

				$pstmt = $this->db->prepare($sql);
				$pstmt->bindValue(":id", $id, PDO::PARAM_STR);
				$pstmt->bindValue(":pwd", $pwd, PDO::PARAM_STR);
				$pstmt->bindValue(":name", $name, PDO::PARAM_STR);
				$pstmt->bindValue(":email", $email, PDO::PARAM_STR);
				$pstmt->bindValue(":phone", $phone, PDO::PARAM_STR);
				$pstmt->bindValue(":birth", $birth, PDO::PARAM_STR);
				$pstmt->bindValue(":profile", $profile, PDO::PARAM_STR);

				$pstmt->execute();

			}catch(PDOException $e){
				exit($e->getMessage());
			}
		}

		public function insertMember($id, $pwd, $name, $email, $phone, $birth){
			try{
				$sql = "insert into member(user_id, user_pwd, user_name, user_email, user_phone, user_birth, user_auth, user_profile) values(:id, :pwd, :name, :email, :phone, :birth, 'B', 'base.jpg')";

				$pstmt = $this->db->prepare($sql);
				$pstmt->bindValue(":id", $id, PDO::PARAM_STR);
				$pstmt->bindValue(":pwd", $pwd, PDO::PARAM_STR);
				$pstmt->bindValue(":name", $name, PDO::PARAM_STR);
				$pstmt->bindValue(":email", $email, PDO::PARAM_STR);
				$pstmt->bindValue(":phone", $phone, PDO::PARAM_STR);
				$pstmt->bindValue(":birth", $birth, PDO::PARAM_STR);

				$pstmt->execute();

			}catch(PDOException $e){
				exit($e->getMessage());
			}
		}

	}
?>