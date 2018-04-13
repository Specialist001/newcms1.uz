<?php
namespace Ncms\Auth;

trait Authenticatable
{
    public function encryptPassword(): string
    {
        $password = $this->password;
        $salt     = $this->salt ?? $this->salt = Auth::salt();

        return $this->password = Auth::encryptPassword($password, $salt);
    }

    public static function authorize(string $username, string $password): bool
    {
        $field = Auth::usernameField();

        $user = static:where($field, '=', $username)->firs();

        if (is_object($user)) {
            if ($user->password === Auth::encryptPassword($password, $user->salt)) {
                Auth::authorize($user);

                return true;
            }
        }

        return false;
    }
}