<?php
require_once getcwd()."/../libraries/constant.php";
//echo SITE_URL;die;
require_once getcwd().'/../libraries/validate.php';

ini_set("display_errors", "1");

$route = array();

class MyClass 
{
	public function handleLogin() 
	{
//echo "hrflkjs";die;

        
        /* Validate username password */
		$obj = new validate();
		$obj->validator("username",$_POST ["username"], 'required#username#maxlength=25','Username Required# Username is not valid#Username should not be more than 25 chracter long');
		$obj->validator("password",$_POST ["password"], 'required#minlength=5#maxlength=25','Password Required#Password should not be less than 5 characters long#Password should not be more than 25 chracter long');
        //$authObject->validateLogin ();
    		$error=$obj->result();
		//print_r($error);
		if(!empty($error['username']))
		{			
			header("Location:../View/comment.php?user=".$error['username']);
		}
		else if(!empty($error['password']))
		{
			header("Location:../View/comment.php?password=".$error['password']);
		}
		else
		{
			require_once SITE_PATH.'/../model/gettersettermodel.php';
        		/* Getting rid of sql injection */
			$objInitiateUser = new Register ();
			$objInitiateUser->setUsername($_POST['username']);
			$objInitiateUser->setPassword($_POST['password']);
        		
        	$a=$objInitiateUser->login () ;
        	if ($a == 1) 
			{
				$b=$objInitiateUser->updateLogged () ;
				//print_r($a);die;
            	$this->showUserPanel();
        	}
        	else 
			{
            	require_once(SITE_PATH);
        	}
		}
    }
    
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
		$objInitiateUser->setKickback($_REQUEST['kick']);
		$objInitiateUser->setAvatar($_REQUEST['avatar']);
		$b = $objInitiateUser->insertUser () ;
		if($b)
		{
			die("1");
		}
	
	}

	public function fetchUser ()
	{
		require_once SITE_PATH.'/../model/gettersettermodel.php';
		$objInitiateUser = new Register ();
		$objInitiateUser->setUser($_REQUEST['user']);
		$objInitiateUser->setTurn($_REQUEST['turn']);
		$objInitiateUser->setKickback($_REQUEST['kick']);
		$objInitiateUser->setAvatar($_REQUEST['avatar']);
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
			$arr[] = $b[0]['name'];
			$arr[] = $b[0]['avatar'];
			$arr[] = $b[0]['position'];
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
