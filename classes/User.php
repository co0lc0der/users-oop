<?php

class User {
    private $db, $data, $sessionName, $isLoggedIn, $cookieName;


    public function __construct($user = null) {
        $this->db = Database::getInstance();
        $this->sessionName = Config::get('session.user_session');
        $this->cookieName = Config::get('cookie.cookie_name');

        if(!$user) {
            if(Session::exists($this->sessionName)) {
                $user = Session::get($this->sessionName); //id

                if($this->find($user)) {
                    $this->isLoggedIn = true;
                }
            }
        } else {
            $this->find($user);
        }
    }

    public function create($fields = []) {
        $this->db->insert('users', $fields);
    }

    /**
     * @param string|null $email
     * @param string|null $password
     * @param bool $remember
     * @return bool
     */
    public function login(string $email = null, string $password = null, bool $remember = false) {
        if(!$email && !$password && $this->exists()) {
            Session::put($this->sessionName, $this->data()->id);
        } else {
            $user = $this->find($email);
            if($user) {
                if(password_verify($password, $this->data()->password)) {
                    Session::put($this->sessionName, $this->data()->id);

                    if($remember) {
                        $hash = hash('sha256', uniqid());

                        $hashCheck = $this->db->get('user_sessions', ['user_id', '=', $this->data()->id]);

                        if(!$hashCheck->count()) {
                            $this->db->insert('user_sessions', [
                                'user_id'   =>  $this->data()->id,
                                'hash'  =>  $hash
                            ]);
                        } else {
                            $hash = $hashCheck->first()->hash;
                        }

                        Cookie::put($this->cookieName, $hash, Config::get('cookie.cookie_expiry'));

                    }

                    return true;
                }
            }
        }
        return false;

    }

    public function find($value = null) {
        if(is_numeric($value)) {
            $this->data = $this->db->get('users', ['id', '=', $value])->first();
        } else {
            $this->data = $this->db->get('users', ['email', '=', $value])->first();
        }

        if($this->data) {
            return true;
        }

        return false;
    }

    public function data() {
        return $this->data;
    }

    public function isLoggedIn() {
        return $this->isLoggedIn;
    }

    public function logout() {
        $this->db->delete('user_sessions', ['user_id', '=', $this->data()->id]);
        Session::delete($this->sessionName);
        Cookie::delete($this->cookieName);
    }

    public function exists() {
        return (!empty($this->data())) ? true : false;
    }

    public function update($fields = [], $id = null) {

        if(!$id && $this->isLoggedIn()) {
            $id = $this->data()->id;
        }

        $this->db->update('users', $id, $fields);
    }

    public function hasPermissions($key = null) {

        if($key) {
            $group = $this->db->get('groups', ['id', '=', $this->data()->group_id]);

            if($group->count()) {
                $permissions = $group->first()->permissions;
                $permissions = json_decode($permissions, true);

                if($permissions[$key]) {
                    return true;
                }
            }
        }

        return false;
    }
}