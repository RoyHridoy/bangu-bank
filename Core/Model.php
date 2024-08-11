<?php

namespace App\Core;

define( "DB_PATH", BASE_PATH . "/Database//" );
abstract class Model
{
    const RULE_REQUIRED = 'required';
    const RULE_EMAIL    = 'email';
    const RULE_MAX      = 'max';
    const RULE_MIN      = 'min';
    const RULE_MATCH    = 'match';
    const RULE_UNIQUE   = 'unique';

    public array $errors = [];
    protected $tablePath;
    protected array $allData;
    abstract public function rules(): array;
    abstract public function tableName(): string;

    public function __construct()
    {
        $this->tablePath = DB_PATH . $this->tableName() . ".txt";
        $this->fetchAllData();
    }

    private function fetchAllData(): void
    {
        $this->allData = json_decode( file_get_contents( $this->tablePath ) );
    }

    public function loadData( $data )
    {
        foreach ( $data as $key => $value ) {
            if ( property_exists( $this, $key ) ) {
                $this->{$key} = $value;
            }
        }
    }

    public function validate(): bool
    {
        foreach ( $this->rules() as $attribute => $rules ) {
            $value = $this->{$attribute};
            foreach ( $rules as $rule ) {
                $ruleName = $rule;
                if ( is_array( $rule ) ) {
                    $ruleName = $rule[0];
                }

                if ( self::RULE_REQUIRED === $ruleName && !$value ) {
                    $this->addError( $attribute, self::RULE_REQUIRED );
                }

                if ( self::RULE_EMAIL === $ruleName && !filter_var( $value, FILTER_VALIDATE_EMAIL ) ) {
                    $this->addError( $attribute, self::RULE_EMAIL );
                }

                if ( self::RULE_MIN === $ruleName && ( strlen( $value ) < $rule['min'] ) ) {
                    $this->addError( $attribute, self::RULE_MIN, $rule['min'] );
                }

                if ( self::RULE_MAX === $ruleName && ( strlen( $value ) > $rule['max'] ) ) {
                    $this->addError( $attribute, self::RULE_MAX, $rule['max'] );
                }

                if ( self::RULE_MATCH === $ruleName && ( $value !== $this->{$rule['match']} ) ) {
                    $this->addError( $attribute, self::RULE_MATCH, $rule['match'] );
                }

                if ( self::RULE_UNIQUE === $ruleName && in_array( $value, $this->getAllByPropertyName( $attribute ) ) ) {
                    $this->addError( $attribute, self::RULE_UNIQUE );
                }
            }
        }
        return empty( $this->errors );
    }

    public function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL    => 'This field is must be a valid email address',
            self::RULE_MIN      => 'Min length of this field must be {min}',
            self::RULE_MAX      => 'Max length of this field must be {max}',
            self::RULE_MATCH    => 'This field must be the same as {match}',
            self::RULE_UNIQUE   => 'Already exists',
        ];
    }

    public function hasError( string $attribute ): bool | array
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError( string $attribute ): string | bool
    {
        return $this->errors[$attribute][0] ?? false;
    }

    private function addError( string $attribute, string $errorType, string | int $placeholder = '' ): void
    {
        $errorMsg = $this->errorMessages()[$errorType];
        if ( $placeholder ) {
            $errorMsg = str_replace( "{{$errorType}}", $placeholder, $this->errorMessages()[$errorType] );
        }
        $this->errors[$attribute][] = $errorMsg;
    }

    public function getAllByPropertyName( string $property ): array
    {
        return array_column( $this->allData, $property );
    }
}
