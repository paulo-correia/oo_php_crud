<?php

include "oocrud.php";

$host="localhost"; // MySQL HOST Name or IP
$name="testing";   // Database Name
$user="user";      // MySQL User
$pass="pass";      // MySQL User's pass

function retmysql ($int_ret, $type) {

	$utype=strtoupper($type);

	switch ($int_ret) {

        	case -1:

			echo "MYSQL FAIL";
			
        	break;

        	case 0:

			echo "FAIL ON ".$utype;

		break;

        	case 1:

                	echo "OK";

        	break;

	}

}

$crud= new Crud($host, $name, $user, $pass);

echo "CREATE ";

$res=$crud->create("t1","ID","2");

retmysql($res, "create");

echo "\n";

echo "READ\n";

var_dump($crud->read("*","t1"));

echo "UPDATE ";

$res=$crud->update("t1","ID=10","ID=0");

retmysql($res, "update");

echo "\n";

var_dump($crud->read("*","t1"));

echo "DELETE ";

$crud->delete("t1","ID=2");

var_dump($crud->read("*","t1"));
