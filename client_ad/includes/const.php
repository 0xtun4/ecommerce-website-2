<?php
	/*************************Default parameters**********************************/
    const SUPER_USER = 'VDS13';                                       //Superuser/administrator login
    const SECRET_KEY = 'haha';                                         //Secret key
    const COMPANY = 'Coolmate';                                     //Company name
    const LOGO_COMPANY = 'socketgram.io.min.png';                     //Company logo(PNG)
    const LOGO_COMPANY_SVG = 'socketgram.io.svg';                     //Company logo(SVG)
    const HASHTYPE = 'md5';                                           //Room hashing type
    const DOMEN = 'http://localhost/client_ad/';                                 //URL of the admin panel folder
    const SOCKETIO = 'http://localhost:3000/socket.io/socket.io.js'; //URL of socket.io library on chat server
	
	/*************************Authentication**********************************/
	/*
	There are two types of authentication to choose from: LDAP and MySQL
	To run a specific type, you need to uncomment the desired 'LOG_IN' and enter constant values
	*/
	//////////////////////////LDAP Authentication////////////////////////////////
//    const LOG_IN = '../../config/auth_type/ldap.php';
//    const USER_LDAP = 'uid=reader,ou=people,dc=test';                 //LDAP reader-user qualifier
//    const PASSWORD_LDAP = 'superreader';                              //LDAP reader password
//    const HOST_LDAP = '192.168.1.1';                                  //LDAP server host
//    const PORT_LDAP = 389;                                            //LDAP server port
//    const BASEDB_LDAP = 'dc=test';                                    //Base DN
//    const GROUP_LDAP = 'cn=allow,ou=groups,o=socketgram,dc=test';     //LDAP user group with chat access
//
//	//////////////////////////MySQL Authentication///////////////////////////////
//	//define("LOG_IN",'../../config/auth_type/mysql.php');
//    const HOST_ADMIN = '192.168.2.6';                                 //Database IP host
//    const DB_ADMIN = 'admin';                                         //Database name
//    const USER_ADMIN = 'admin';                                       //Database user
//    const PSWD_ADMIN = 'qwerty';                                      //Database password
//    const HASHTYPE_ADMIN = 'md5';                                     //Administrator password hash type
//    const MYSQL_QUERY_ADMIN = 'SELECT COUNT(*) AS col FROM admin WHERE login = ? AND LOWER(password) = ?';                                                                   //Query to check if an administrator exists in the database
	
	/*************************Chat server**********************************/
	/*
	At the moment the chat server only runs on MySQL
	*/
	//////////////////////////MySQL start config//////////////////////////////
    const START_PAGE = 'mysql.php';
    const HOST_CHAT = 'store.cpllnfpfhhm8.ap-southeast-1.rds.amazonaws.com:3307';                                  //Chat Server IP host
    const DB_CHAT = 'cuahang';                                           //Chat Server Database name
    const USER_CHAT = 'tuqtuo';                                     //Chat Server Database user
    const PSWD_CHAT = 'Root1234';                                    //Chat Server Database password

	/*************************Defalft function**********************************/
	function hashroom($str) {
		return hash(HASHTYPE, $str);
	}
	function dropsession() {
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}
		session_destroy();
	}