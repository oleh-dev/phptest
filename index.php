<?php

class Login {
	public static $fields = ['ID', 'FirstName', 'LastName', 'Email', 'UserRole'];
	public static $populate = [
		'user' => [
			'class' => 'User',
			'option' => 'login/user option',
			'other_data' => ''
		], 
		'bank' => [
			'class' => 'Bank',
			'option' => 'login/bank option',
			'other_data' => ''
		]
	];
	
	public function action($key){
		test(get_class(), $key);
	}
}

class User {
	public static $fields = ['User', 'SSN', 'Street', 'City', 'State', 'Zip', 'Phone', 'BirthDay', 'Image'];
	public static $populate = [
		'login' => [
			'class' => 'Login',
			'option' => 'user/login option',
			'other_data' => ''
		]
	];
	
	public function action($key){
		test(get_class(), $key);
	}
}

class Bank {
	public static $fields = ['ID', 'BankID', 'Routing', 'CheckAccount', 'User'];
	public static $populate = [
		'login' => [
			'class' => 'Login',
			'option' => 'bank/login option',
			'other_data' => ''
		]
	];
	
	public function action($key){
		test(get_class(), $key);
	}
}

if (isset($_GET['r'])){
    switch($_GET['r']){
    case 'login':
        (new Login())->action($_GET['populate']);
        break;
    case 'user':
        (new User())->action($_GET['populate']);
        break;
    case 'bank':
        (new Bank())->action($_GET['populate']);
        break;
    } 
}

function test($class, $key){
	if (!isset($class::$populate[$key])){
		echo "Impossible action";
		return;
	}
	$a = $class::$populate[$key];
	echo $a['class']."<br/>";
	print_r( $a['class']::$fields ); // this is main point
}

?>
<br/>
<a href="?r=login&populate=bank">Login, Bank</a><br/>
<a href="?r=login&populate=user">Login, User</a><br/>
<a href="?r=bank&populate=login">Bank, Login</a><br/>
<br/>
<a href="?r=bank&populate=user">Bank, User - Impossible action</a><br/>