<?php

namespace App\Models;

use App\Core\DbModel;

class User extends DbModel
{
    public string $firstName       = '';
    public string $lastName        = '';
    public string $email           = '';
    public string $password        = '';
    public string $confirmPassword = '';

    public function rules(): array
    {
        return [
            'firstName'       => [self::RULE_REQUIRED],
            'lastName'        => [self::RULE_REQUIRED],
            'email'           => [self::RULE_REQUIRED, self::RULE_EMAIL, self::RULE_UNIQUE],
            'password'        => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function tableName(): string
    {
        return "users";
    }

    public function register()
    {
        $user = [
            'id'        => $this->generateId(),
            'email'     => $this->email,
            'firstName' => $this->firstName,
            'lastName'  => $this->lastName,
            'password'  => password_hash( $this->password, PASSWORD_DEFAULT, ['cost' => 12] ),
            'role'      => 'user',
        ];
        $isRegister = $this->save( $user );
        if ( !$isRegister ) {
            return false;
        }
        return true;
    }

    public function getCurrentUser( int $id )
    {
        if ( !$id ) {
            return false;
        }
        return $this->findOrFail( 'id', $id )[1];
    }

    public function isAdmin( int $id )
    {
        if ( !$id ) {
            return false;
        }
        return $this->getCurrentUser( $id )['role'] === 'admin';
    }

    public function isCustomer( int $id )
    {
        if ( !$id ) {
            return false;
        }
        return $this->getCurrentUser( $id )['role'] === 'user';
    }

    public function getAllOfColumn( string $property )
    {
        return array_column( $this->allData, $property );
    }

    public function getUserBy( string $property, $value )
    {
        return $this->findOrFail( $property, $value );
    }

    public function getAllUsers()
    {
        return $this->allData;
    }
}
