<?php

namespace App\Models;

use App\Core\Application;
use App\Core\Model;

class Login extends Model
{
    public string $email    = '';
    public string $password = '';

    public function tableName(): string
    {
        return "users";
    }

    public function rules(): array
    {
        return [
            'email'    => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED],
        ];
    }

    public function login()
    {
        $user = $this->findOrFail( "email", $this->email );
        if ( !$user ) {
            return false;
        }
        if ( password_verify( $this->password, $user[1]['password'] ) ) {
            Application::$app->session->set( 'user', $user[1]['id'] );
            return $user;
        }
    }
}
