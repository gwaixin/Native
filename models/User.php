<?php
require_once 'Database.php';
class User extends Database {

	private $table = 'users';

	private $id = 'id';
	private $username = 'username';
	private $password = 'password';
	private $fullname = 'full_name';
	private $gender = 'gender';

	public function __construct() {
		parent::__construct();
	}

	public function insert($data) {
		$data[$this->password] = md5($data[$this->password]);
		return $this->insertQuery($this->table, $data);
	}

	public function delete($id) {
		return $this->deleteQuery($this->table, array($this->id => $id));
	}

	public function update($data) {
		return $this->updateQuery($this->table, $data);
	}

	public function isExist($username, $password) {
		return $this->viewQuery($this->table, array($this->username => $username, $this->password -> $password));
	}

	public function view($id) {
		return $this->viewQuery($this->table, array($this->id => $id));
	}

	public function viewAll() {
		return $this->viewQuery($this->table);
	}

	public function getTable() { return $this->table; }
	public function getId() { return $this->id; }
	public function getUsername() { return $this->username; }
	public function getPassword() { return $this->password; }
	public function getFullname() { return $this->fullname; }
	public function getGender() { return $this->gender; }
}