<?php

namespace App\Core\Form;

use App\Core\Model;

class Field
{
    private const TYPE_TEXT     = 'text';
    private const TYPE_EMAIL    = 'email';
    private const TYPE_PASSWORD = 'password';
    private const TYPE_NUMBER   = 'number';

    private string $type  = self::TYPE_TEXT;
    private string $label = '';
    public Model $model;
    public string $attribute;
    private string $placeholder = '';
    private string $classes     = "block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-sm sm:leading-6 p-2";

    public function __construct( Model $model, string $attribute )
    {
        $this->model     = $model;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        return sprintf( '
            <div>
              <label for="%s" class="block text-sm font-medium leading-6 text-gray-900">%s</label>
              <input type="%s" name="%s" id="%s" value="%s" class="%s %s" placeholder="%s" required>
              <div class="text-sm text-red-500"> %s </div>
            </div>
        ',
            $this->attribute,
            $this->label,
            $this->type,
            $this->attribute,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->classes,
            $this->model->hasError( $this->attribute ) ? 'border-red-300 dark:border-red-600' : 'border-gray-300 dark:border-gray-600',
            $this->placeholder,
            $this->model->getFirstError( $this->attribute )
        );
    }

    public function addLabel( string $labelText ): self
    {
        $this->label = $labelText;
        return $this;
    }

    public function passwordField(): self
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function numberField(): self
    {
        $this->type = self::TYPE_NUMBER;
        return $this;
    }

    public function emailField(): self
    {
        $this->type = self::TYPE_EMAIL;
        return $this;
    }

    public function setClasses( string $classes )
    {
        $this->classes = $classes;
        return $this;
    }

    public function setPlaceholder( string $placeholder )
    {
        $this->placeholder = $placeholder;
        return $this;
    }
}
