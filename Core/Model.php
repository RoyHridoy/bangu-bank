<?php

namespace App\Core;

use PDO;

define( "DB_PATH", BASE_PATH . "/Database//" );
abstract class Model
{
    const RULE_REQUIRED      = 'required';
    const RULE_EMAIL         = 'email';
    const RULE_MAX           = 'max';
    const RULE_MIN           = 'min';
    const RULE_MATCH         = 'match';
    const RULE_UNIQUE        = 'unique';
    const RULE_NUMBER        = 'number';
    const RULE_POSITIVE      = 'positive';
    const RULE_EXIST         = 'exist';
    const RULE_RESTRICT_SELF = 'restrict_self';

    public array $errors = [];
    protected $pdo;
    protected $tablePath;
    protected array $allData;
    abstract public function rules(): array;
    abstract public function tableName(): string;

    public function __construct()
    {
        try {
            ENVReader::load();
            if ( strtolower( $_ENV['DB_TYPE'] ) === 'file' ) {

                $this->tablePath = DB_PATH . $this->tableName() . ".txt";
                $this->fetchAllData();

            } elseif ( strtolower( $_ENV['DB_TYPE'] ) === 'mysql' ) {

                $db        = Database::getInstance();
                $this->pdo = $db->getPdo();
                $this->fetchAllData();

            } else {
                echo "Unable to connect Database. Check .env file configuration.";
            }

        } catch ( \Throwable $e ) {
            echo $e->getMessage();
        }
    }

    private function fetchAllData(): void
    {
        if ( strtolower( $_ENV['DB_TYPE'] ) === 'file' ) {

            $this->allData = json_decode( file_get_contents( $this->tablePath ), true );

        } elseif ( strtolower( $_ENV['DB_TYPE'] ) === 'mysql' ) {

            $stmt = $this->pdo->prepare( "SELECT * FROM {$this->tableName()}" );
            $stmt->execute();
            $this->allData = $stmt->fetchAll();

        } else {
            echo "Unable to connect Database. Check .env file configuration.";
        }
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

                if ( self::RULE_REQUIRED === $ruleName && empty( $value ) && $value !== 0 ) {
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

                if ( self::RULE_NUMBER === $ruleName && !is_numeric( $value ) ) {
                    $this->addError( $attribute, self::RULE_NUMBER );
                }

                if ( self::RULE_POSITIVE === $ruleName && $value < 0 ) {
                    $this->addError( $attribute, self::RULE_POSITIVE );
                }

                if ( self::RULE_EXIST === $ruleName && !in_array( $value, Application::$app->getAllUser( $attribute ) ) ) {
                    $this->addError( $attribute, self::RULE_EXIST );
                }

                if ( self::RULE_RESTRICT_SELF === $ruleName && ( $value === Application::$app->getUser()[$attribute] ) ) {
                    $this->addError( $attribute, self::RULE_RESTRICT_SELF );
                }
            }
        }
        return empty( $this->errors );
    }

    public function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED      => 'This field is required',
            self::RULE_EMAIL         => 'This field is must be a valid email address',
            self::RULE_NUMBER        => 'This field is must be a valid number',
            self::RULE_POSITIVE      => 'Value must be greater than 0',
            self::RULE_MIN           => 'Min length of this field must be {min}',
            self::RULE_MAX           => 'Max length of this field must be {max}',
            self::RULE_MATCH         => 'This field must be the same as {match}',
            self::RULE_UNIQUE        => 'Already exists',
            self::RULE_EXIST         => 'This value is not found in database',
            self::RULE_RESTRICT_SELF => 'This is you',
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

    public function findOrFail( string $property, string | int $value ): array | bool
    {
        $user = array_filter( (array) $this->allData, fn( array $user ) => $user[$property] === $value );
        if ( empty( $user ) ) {
            return false;
        }
        foreach ( $user as $index => $value ) {
            return [$index, $value];
        }
    }

    protected function getDbColumnNames( string $tableName ): array
    {
        $stmt = $this->pdo->query( "SHOW COLUMNS FROM $tableName" );
        return array_diff( $stmt->fetchAll( PDO::FETCH_COLUMN ), ['id', 'created_at'] );
    }
}
