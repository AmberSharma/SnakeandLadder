<?php
session_start ();
require_once 'model.php';
ini_set ( "display_error", 'on' );
class Register extends model {
	protected $user;
	protected $avatar;
	protected $turn;
	protected $kickback;
	
	/**
	 * @return the $random1
	 */
	public function getKickback() {
		return $this->kickback;
	}

	/**
	 * @param field_type $random1
	 */
	public function setKickback($kickback) {
		$this->kickback = $kickback;
	}

	/**
	 *
	 * @return the $username
	 */
	public function getUser() {
		return $this->user;
	}
	
	/**
	 *
	 * @return the $password
	 */
	public function getAvatar() {
		return $this->avatar;
	}
	
	/**
	 *
	 * @param field_type $username        	
	 */
	public function setUser($user) {
		$this->user = $user;
	}
	
	/**
	 *
	 * @param field_type $password        	
	 */
	public function setTurn($turn) {
		$this->turn = $turn;
	}
	public function setAvatar($avatar) {
		$this->avatar = $avatar;
	}
	public function getTurn() {
		return $this->turn;
	}
	
	public function login() {
		$this->db->Fields ( array (
				"username",
				"password",
				"id" 
		) );
		$this->db->From ( "user" );
		$this->db->where ( array (
				"username" => $this->getUsername (),
				"password" => $this->getPassword () 
		) );
		$this->db->Select ();
		$result = $this->db->resultArray ();
		if ($result) {
			$_SESSION ['uid'] = $result [0] ['id'];
			$_SESSION ['username'] = $result [0] ['username'];
		}
		return count ( $result );
	}
	public function updateLogged() {
		$this->db->Fields ( array (
				"loggedin" => "Y" 
		) );
		$this->db->From ( "user" );
		$this->db->Where ( array (
				"username" => $_SESSION ['username'] 
		) );
		$result = $this->db->Update ();
		return $result;
	}
	
	public function fetchturnRandom() {
		$this->db->Fields ( array ("turnrandom"));
		$this->db->From ( "randomvalue" );
		$result = $this->db->Select ();
		return $result[0]["turnrandom"];
	}
	
	public function fetchslipRandom() {
		$this->db->Fields ( array ("sliprandom"));
		$this->db->From ( "randomvalue" );
		$this->db->Select ();
		$result = $this->db->resultArray ();
		return $result[0]["sliprandom"];
	}
	
	public function turnRandom() {
		$this->db->Fields ( array ("id"));
		$this->db->From ("randomvalue");
		$this->db->Select ();
		$result = $this->db->resultArray ();
		$this->db->From ("randomvalue");
		if(empty($result))
		{
			$this->db->Fields ( array ("turnrandom" => $this->getRandom1 ()));
			$result1 = $this->db->Insert ();
		}
		else
		{
			$this->db->Fields ( array ("turnrandom" => $this->getRandom1 ()) );
			$result1 = $this->db->Update ();
		}
	}
	
	public function insertUser() {
		$this->db->Fields ( array ("name" =>  $this->getUser () ,"turn" => $this->getTurn () , "kickback" => $this->getKickback () ,"avatar" => $this->getAvatar () , "playing" => "N" , "chance" => "N" , "position" => "0"));
		$this->db->From ( "user" );
		$result = $this->db->Insert ();
		return $result;
	}

	public function fetchUser() {
		$this->db->Fields (array("avatar" , "name"));
		$this->db->From ( "user where name != '".$this->getUser (). "' and turn = '".$this->getTurn ()."' and kickback = '".$this->getKickback ()."' and avatar != '".$this->getAvatar () ."' and playing = 'N' and chance = 'N' ");
		$this->db->Select ();
		$result = $this->db->resultArray();
		return $result;
	}
	public function updateUser($users) 
	{
		for($i =0 ; $i < count($users) ; $i ++)
		{
			$this->db->Fields (array("Playing"=>"Y"));
			$this->db->From ( "user" );
			$this->db->Where (array("name" => $users[$i]));
			$this->db->Update ();
		}
		if($i == count($users))
		return "1";
		
	}

	public function updateUserPosition($users , $user , $pos) 
	{

		$this->db->Fields (array("chance"=>"N" , "position" => $pos));
		$this->db->From ( "user" );
		$this->db->Where (array("name" => $user));
		$result = $this->db->Update ();
		if ($result)
		{
			$a = 0;
			for($i =0 ; $i < count($users) ; $i ++)
			{
				if(($users[$i] == $user) && ($i != (count($users) - 1)))
				{
					$a = 1;
				}
				if($users[$i] != $user && ($a == 1))
				{
					$this->db->Fields (array("chance" => "Y"));
					$this->db->From ( "user" );
					$this->db->Where (array("name" => $users[$i]));
					$result1 = $this->db->Update ();
				}
				if(($i == (count($users) - 1)) && ($a == 0))
				{
					$this->db->Fields (array("chance" => "Y"));
					$this->db->From ( "user" );
					$this->db->Where (array("name" => $users[0]));
					$result1 = $this->db->Update ();
				}
			}
			
		}
		if($result && $result1)
		{
			return $result1 ;
		}
		
	}

	public function getChance() 
	{
		$this->db->Fields (array("name"));
		$this->db->From ( "user" );
		$this->db->Where (array("chance" => 'Y'));
		$this ->db->Limit("1");
		$this->db->Select ();
		$result = $this->db->resultArray();
		return $result;
		
	}

	public function getPosition() 
	{
		$this->db->Fields (array("position" , "name" , "avatar"));
		$this->db->From ( "user where name !=".$this->getUser ());
		$this->db->Select ();
		$result = $this->db->resultArray();
		return $result;
		
	}

	public function setChance($users) 
	{
		for($i =0 ; $i < count($users) ; $i ++)
		{
			
			$this->db->Fields (array("chance" , "name"));
			$this->db->From ( "user" );
			$this->db->Where (array("name" => $users[$i]));
			$result = $this->db->Select ();
			$result = $this->db->resultArray();
			if($result[0]['chance'] == "Y")
			{
				break;
			}
		}
		if($i == count($users))
		{
			$this->db->Fields (array("chance" => "Y"));
			$this->db->From ( "user" );
			$this->db->Where (array("name" => $users[0]));
			$this->db->Update ();
		}		
	}

	public function userScoreTable() {
		$this->db->Fields ( array ("table_name") );
		$this->db->From ( "information_schema.tables" );
		$this->db->Where ( array ("table_schema" => "rvcsgame" , "table_name" =>$_SESSION ['user1'][0].$_SESSION ['user2'][0].$_SESSION ['user3'][0].$_SESSION ['user4'][0]."score" ) );
		$this->db->Select ();
		//$this ->db->Limit("4");
		$result = $this->db->resultArray ();
		if(empty($result))
		{
			$this->db->Create ("create table ".$_SESSION ['user1'][0].$_SESSION ['user2'][0].$_SESSION ['user3'][0].$_SESSION ['user4'][0]. "score (id int primary key auto_increment ," . $_SESSION ['user1'] . " int ," . $_SESSION ['user2'] . " int ,". $_SESSION ['user3'] . " int ," .$_SESSION ['user4'] . " int )");

			$this->db->Create ("create table ".$_SESSION ['user1'][0].$_SESSION ['user2'][0].$_SESSION ['user3'][0].$_SESSION ['user4'][0]. "message (id int primary key auto_increment , user varchar(40) ,message varchar(200) ,status char )");
		}
		
		}


	public function logOut() {
		$this->db->Fields ( array (
				"loggedin" => "N" , "playing"=>"N"
		) );
		$this->db->From ( "user" );
		$this->db->Where ( array (
				"username" => $_SESSION ['username'] 
		) );
		$result = $this->db->Update ();
		if ($result == "1") {
			session_destroy ();
			return $result;
		}
	}
	public function loggedinCount() {
		$this->db->Fields ( array (
				"username",
				"id" 
		) );
		$this->db->From ( "user where loggedin='Y' and playing <> 'Y'");
		$this ->db->Limit("4");
		$this->db->Select ();
		
		$result = $this->db->resultArray ();
		
		
		
		return (count($result));
	}

	public function getnewMessage() {
		$this->db->Fields ( array ("message","user") );
		$this->db->From ($_SESSION ['user1'][0].$_SESSION ['user2'][0].$_SESSION ['user3'][0].$_SESSION ['user4'][0]."message");
		$this->db->Where ( array ("status" => "n" ));
		$this->db->Select ();
		//$this ->db->Limit("4");
		$result = $this->db->resultArray ();
		return ($result);
	}
	
	public function fetchPlayingUser() {
		$this->db->Fields ( array ("username") );
		$this->db->From ("user");
		$this->db->Where ( array ("loggedin" => "Y" , "playing" => "Y" ));
		$this->db->Select ();
		$this ->db->Limit("4");
		$result = $this->db->resultArray ();
		for($i =0 ; $i < count($result) ; $i ++)
		{
			$_SESSION["user".$this->j] = $result[$i]['username'];
				$this->j ++;
		}
		return ($result);
	}
	
}


?>
