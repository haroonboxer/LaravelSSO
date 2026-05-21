<?php

// namespace App\Auth;

// class SSOUser
// {
//     public $id;
//     public $name;
//     public $roles;
//     public $claims;

//     public function __construct($data)
//     {
//         $this->id = $data['id'] ?? null;
//         $this->name = $data['name'] ?? null;
//         $this->roles = $data['roles'] ?? [];
//         $this->claims = $data['claims'] ?? [];
//     }
// }


namespace App\Auth;

use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class SSOUser implements Authenticatable, AuthorizableContract
{
    use Authorizable;

    public $id;
    public $name;
    public $email;
    public $roles;
    public $claims;
    public $image;

    public function __construct($data)
    {
        $this->id = $data['id'] ?? null;

        $this->name = $data['name'] ?? null;

        $this->image = $data['image'] ?? null; // 👈 ADD THIS
        $this->email = $data['email'] ?? null;

        $this->roles = $data['roles'] ?? [];

        $this->claims = $data['claims'] ?? [];
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    public function getAuthPassword()
    {
        return null;
    }

    public function getRememberToken()
    {
        return null;
    }

    public function setRememberToken($value) {}

    public function getRememberTokenName()
    {
        return null;
    }
}
