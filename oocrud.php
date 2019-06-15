<?php

class Crud {

	// Private Variables;

	private $_pdo;

	public function __construct($host, $name, $user, $pass) {

	        try {

                        $pdo = new PDO("mysql:host=".$host."; dbname=".$name.";",$user, $pass, array(PDO::MYSQL_ATTR_FOUND_ROWS => true) );

                } catch (PDOException $e) {

                        print "Erro: " . $e->getMessage();

                }

                $this->_pdo=$pdo;

        }

        public function where($strwhere = "") {

                if (strlen($strwhere)>0) {

                        $strwhere=" WHERE ".$strwhere;

                }

	        return $strwhere;

        }

       public function create ($strtable, $strfields, $strvalues = "") {

       		$count=-1;

       		$qry=trim("INSERT INTO ".$strtable." (".$strfields.") VALUES (".$strvalues.")");

                try {
                      $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                      $inc=$this->_pdo->prepare($qry);
                      $inc->execute();

                } catch(PDOException $e) {

                      return $e->getMessage();

                }

		$count=$inc->rowCount();

        	return $count;

       }

       public function read ($strfields, $strtable, $strwhere = "") {

       		$ret="";

       		$strwhere=self::where($strwhere);
       		$qry=trim("SELECT ".$strfields." FROM ".$strtable." ".$strwhere);

                try {

                        $query=$this->_pdo->query($qry);
                        $ret=$query->fetchAll(PDO::FETCH_NAMED);

                        return $ret;

                } catch(PDOException $e){

                        return $e->getMessage();

                }

        }

        public function update ($strtable, $strfields, $strwhere = "") {

        	$strwhere=self::where($strwhere);
        	$qry=trim("UPDATE ".$strtable." SET ".$strfields." ".$strwhere);

                try {
                        $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $upd=$this->_pdo->prepare($qry);
                        $upd->execute();

                } catch(PDOException $e) {

                	return $e->getMessage();

                }

		return 1;	

        }

        public function delete ($strtable, $strwhere ="") {

		$count=-1;

        	$strwhere=self::where($strwhere);
        	$qry=trim("DELETE FROM ".$strtable." ".$strwhere);

                try {
                        $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $del=$this->_pdo->prepare($qry);
                        $del->execute();

                } catch(PDOException $e) {

                        return $e->getMessage();
                }

        	$count=$del->rowCount();

        	return $count;

        }

}
