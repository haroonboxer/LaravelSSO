<?php

namespace App\Auth;

use Illuminate\Contracts\Auth\Guard;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtGuard implements Guard
{
    protected $user;

    public function user()
    {

        if ($this->user) {
            return $this->user;
        }

        $token =
            request()->query('token')
            ?? request()->bearerToken()
            ?? request()->cookie('access_token');

        if (!$token) return null;
        try {

            $decoded = JWT::decode(
                $token,
                new Key(
                    "7Fv9KpL2xQmR8uDz4NcYwAeT6hBjS1gX5VrUkM3pLfHs9QaWsdfgsdfgsdfgsdfgsdfgsdfgsdfgsdfg",
                    'HS256'
                )
            );
             
            // -------------------------
            // SAFE ROLE PARSING
            // -------------------------
            $rolesRaw = $decoded->Role ?? [];

            $roles = is_string($rolesRaw)
                ? json_decode($rolesRaw, true)
                : $rolesRaw;

            if (!is_array($roles)) {
                $roles = [];
            }

            // -------------------------
            // SAFE CLAIMS PARSING
            // -------------------------
          $claimsRaw = $decoded->role_claims ?? [];

                $claims = is_string($claimsRaw)
                    ? json_decode($claimsRaw, true)
                    : $claimsRaw;

                if (!is_array($claims)) {
                    $claims = [];
                }

                $claims = array_map(function ($c) {

                    return [
                        'type' => trim($c['ClaimType'] ?? ''),
                        'allowed' => filter_var($c['ClaimValue'] ?? false, FILTER_VALIDATE_BOOLEAN),
                    ];

                }, $claims);
                        
                        // -------------------------
            // CREATE USER
            // -------------------------
            $this->user = new SSOUser([
                'id' => $decoded->{'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/nameidentifier'} ?? null,

                'name' => $decoded->{'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/name'} ?? null,

                'roles' => $roles,

                'claims' => $claims,
            ]);
          
         
            return $this->user;
        } catch (\Exception $e) {

            // IMPORTANT: log error for debugging
            logger()->error('JWT ERROR: ' . $e->getMessage());

            return null;
        }
    }

    public function check()
    {
        return !is_null($this->user());
    }

    public function guest()
    {
        return !$this->check();
    }

    public function id()
    {
        return $this->user()?->id;
    }

    public function validate(array $credentials = [])
    {
        return false;
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
    public function hasUser()
    {
        return !is_null($this->user);
    }
}
