<?php

namespace App\Core\Form;

use App\Core\Model;

class Form
{
    public static function start( $action = "", $method = "post" )
    {
        echo sprintf( '<form action="%s" method="%s" class="space-y-4" novalidate>', $action, $method );
        return new Form;
    }

    public static function end()
    {
        echo "</form>";
    }

    public function field( Model $model, string $attribute )
    {
        return new Field( $model, $attribute );
    }
}
