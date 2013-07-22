<?php
require_once getcwd()."/../libraries/constant.php";
//echo SITE_URL;die;
require_once getcwd().'/../libraries/validate.php';

ini_set("display_errors", "1");

$route = array();

class MyClass 
{
	
    
    /* -----------------------------------------------------
         Function to add FAQ called from faq.php
       -----------------------------------------------------
    */
    public function loggedinCount ()
	{	
			
		require_once SITE_PATH.'/../model/gettersettermodel.php';
		$objInitiateUser = new Register ();
		$b=$objInitiateUser->loggedinCount () ;
		print_r($b);
		
	}
	
	public function assignUserspace ()
	{
		require_once SITE_PATH.'/../model/gettersettermodel.php';
		$objInitiateUser = new Register ();
		$b=$objInitiateUser->assignUserSpace () ;
	}

	public function deleteUser ()
	{
		require_once SITE_PATH.'/../model/gettersettermodel.php';
		$objInitiateUser = new Register ();
		$objInitiateUser->setUser($_REQUEST['user']);
		$b=$objInitiateUser->deleteUser() ;
		
	}

	public function uniqueUser ()
	{
		require_once SITE_PATH.'/../model/gettersettermodel.php';
		$objInitiateUser = new Register ();
		$objInitiateUser->setUser($_REQUEST['user']);
		$b=$objInitiateUser->uniqueUser() ;
		if(count($b) > 0)
		{
			echo  "0";
		}
		else
		{
			echo "1";
		}
	}
	
	public function fetchPlayingUser ()
	{
		require_once SITE_PATH.'/../model/gettersettermodel.php';
		$objInitiateUser = new Register ();
		$b=$objInitiateUser->fetchPlayingUser () ;
		
		if(count($b) == 4)
		$objInitiateUser->userScoreTable () ;
		require_once SITE_PATH.'/../View/try.php';
		
		
	}
	
	public function turnRandom ()
	{
		require_once SITE_PATH.'/../model/gettersettermodel.php';
		$objInitiateUser = new Register ();
		$objInitiateUser->setRandom1($_REQUEST['r1']);
		$objInitiateUser->turnRandom () ;
		
	}
	
	
	
	public function fetchturnRandom ()
	{
		require_once SITE_PATH.'/../model/gettersettermodel.php';
		$objInitiateUser = new Register ();
		$b = $objInitiateUser->fetchturnRandom () ;
	
	}

	public function insertUser ()
	{
		require_once SITE_PATH.'/../model/gettersettermodel.php';
		$objInitiateUser = new Register ();
		$objInitiateUser->setUser($_REQUEST['user']);
		$objInitiateUser->setTurn($_REQUEST['turn']);
		$objInitiateUser->setAvatar($_REQUEST['avatar']);
		$objInitiateUser->setMethod($_REQUEST['method1']);
		$objInitiateUser->setDice($_REQUEST['dice']);
		$b = $objInitiateUser->insertUser () ;
		if($b)
		{
			die("1");
		}
		else
		{
			die("-1");
		}
	
	}

	public function fetchUser ()
	{
		require_once SITE_PATH.'/../model/gettersettermodel.php';
		$objInitiateUser = new Register ();
		$objInitiateUser->setUser($_REQUEST['user']);
		$objInitiateUser->setTurn($_REQUEST['turn']);
		$objInitiateUser->setAvatar($_REQUEST['avatar']);
		$objInitiateUser->setMethod($_REQUEST['method1']);
		$objInitiateUser->setDice($_REQUEST['dice']);
		$b = $objInitiateUser->fetchUser () ;
		if($b)
		{
			if(count($b) >= $_REQUEST['opponent'])
			{
				for($i = 0 ; $i < $_REQUEST['opponent'] ; $i ++ )
				{
					$arr[] = $b[$i]['name'];
					$arr[] = $b[$i]['avatar'];
				}
				echo json_encode($arr);
			}
			else
			{
				die("1");
			}
		}
		else
		{
			die("1");
		}
	
	}
	
	public function updateUser ()
	{
		require_once SITE_PATH.'/../model/gettersettermodel.php';
		$objInitiateUser = new Register ();
		$abc = explode("," , $_REQUEST['users']);
		$b = $objInitiateUser->updateUser ($abc) ;
		die($b);
	}
	public function updateUserPosition ()
	{
		require_once SITE_PATH.'/../model/gettersettermodel.php';
		$objInitiateUser = new Register ();
		$abc = explode("," , $_REQUEST['users']);
		$b = $objInitiateUser->updateUserPosition ($abc ,  $_REQUEST['user'] , $_REQUEST['pos']) ;
		die($b);
	}
	
	public function getChance ()
	{
		require_once SITE_PATH.'/../model/gettersettermodel.php';
		$objInitiateUser = new Register ();
		$b = $objInitiateUser->getChance () ;
		if(!empty($b[0]['name']))
		{
			echo json_encode($b[0]['name']);
		}
		else
		{
			return "-1" ;
		}
	
	}

	public function getPosition ()
	{
		require_once SITE_PATH.'/../model/gettersettermodel.php';
		$objInitiateUser = new Register ();
		$objInitiateUser->setUser($_REQUEST['user']);
		$b = $objInitiateUser->getPosition () ;
		if(!empty($b[0]['name']))
		{
			for($i = 0 ; $i < count($b) ; $i++)
			{
				$arr[] = $b[$i]['name'];
				$arr[] = $b[$i]['avatar'];
				$arr[] = $b[$i]['position'];
			}
			echo json_encode($arr);
		}
		else
		{
			return "-1" ;
		}
	
	}

	public function setChance ()
	{
		require_once SITE_PATH.'/../model/gettersettermodel.php';
		$objInitiateUser = new Register ();
		$abc = explode("," , $_REQUEST['users']);
		$objInitiateUser->setChance ($abc) ;	
	}
	public function logout ()
	{	
		require_once SITE_PATH.'/../model/gettersettermodel.php';
		$objInitiateUser = new Register ();
		$b=$objInitiateUser->logOut () ;
		if($b == "1")
		{
			header("Location:".SITE_URL);
		}
	}
	
	public function showUserPanel ()
	{
		
		require_once("../View/playgame.php");
	}
	


}


$request = "";
if (isset($_GET["method"])) {

    $request = $_GET["method"];
}

$obj = new MyClass();

if (!empty($request)) {
    $obj->$request();
}

?>
