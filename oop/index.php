<?php

class User
{

    protected $id;
    protected $username;
    protected $email;

    private $repository;
    protected $userData;

    public function __construct($username)
    {
        $this->username = $username;
    }

    public function setRepository(UserRepostiryInterface $repository)
    {
        $this->repository = $repository;
        return $this;
    }

    public function authenticate($password)
    {
        if (!$this->repository->isUserExist($this->username)) {
            return false;
        }

        $valid = $this->repository->validatePassword($password);
        if ($valid) {
            $this->userData = $this->repository->getUserData($this->username);
            $this->id = (int) $this->userData['id'];
            $this->email = $this->userData['email'];
        }

        return $valid;
    }
}

interface UserRepostiryInterface
{
    public function isUserExists($username);
    public function validatePassword($password);
    public function getUserData($username);
}

abstract class Storage implements UserRepostiryInterface
{
    protected $storage;
    protected $userData;

    public function __construct()
    {
        $this->initStorage();
    }

    abstract protected function initStorage();
    abstract protected function findUser();
    protected function loadUser()
    {
    }

    public function isUserExists($username)
    {
        return $this->findUser($username);
    }

    public function getUserData($username)
    {
        if (empty($this->userData)) {
            $this->loadUser($username);
        }
        
        return $this->userData;
    }

    public function validatePassword($password)
    {
        if (empty($this->userData)) {
            $this->loadUser($username);
        }
        
        return password_verify(
            $password,
            $this->userData['password_hash']
        );
    }
}

class ArrayStorage extends Storage
{
    protected function initStorage()
    {
        $buffer = file_get_content('storage.txt');
        $this->storage = array_map('unserialize', $buffer);
    }

    protected function findUser($username)
    {
        return array_key_exists(
            $username,
            $this->storage
        );
    }

    protected function loadUser($username)
    {
        $this->userData = $this->storage[$username];
    }
}

class DatabaseStorage extends Storage
{
    private $userData;

    protected function initStorage()
    {
        $dsn = 'mysql:host=localhost;dbname=academy';
        $this->storage = new PDO($dsn, 'academy', 'acad3my');
    }

    protected function findUser($username)
    {
        $query = 'SELECT * FROM user
            WHERE login = :login && status = 1';
        $st = $this->db->prepare($query);
        $st->bindParam(':login', $username, PDO::PARAM_STR);
        $st->execute();

        if ($st->rowCount()) {
            $this->userData = $st->fetch(PDO::FETCH_ASSOC);
        }
    }
}

class FacebookUserRepository implements UserRepostiryInterface
{
    public function isUserExists($username)
    {

    }

    public function validatePassword($password)
    {

    }

    public function getUserData($username)
    {

    }
}
$repo = new FacebookUserRepository();

$user = (new User('admin'))->setRepository($repo);
if ($user->authenticate('s3cr3t')) {
    echo 'OK!';
}