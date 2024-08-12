<?php

namespace App\Core;

class Controller
{

    public function render( string $templateName, array $params = [], string $layout = "main" )
    {
        return Application::$app->router->renderView( $templateName, $params, $layout );
    }

    public function redirect( string $address )
    {
        Application::$app->router->redirect( $address );
    }

    public function setFlash( string $key, string $message ): void
    {
        Application::$app->session->setFlash( $key, $message );
    }

    public function destroySession(): void
    {
        Application::$app->session->remove( 'user' );
    }

    public function getUser()
    {
        $user = Application::$app->getUser() ?? false;
        if ( !$user ) {
            return false;
        }
        $userWithoutPassword = array_filter( $user, fn( $key ) => $key !== 'password', ARRAY_FILTER_USE_KEY );
        return [
             ...$userWithoutPassword,
            'img' => strtoupper( $userWithoutPassword['firstName'][0] . $userWithoutPassword['lastName'][0] ),
        ];
    }

    public function getUserById(int $id)
    {
        return Application::$app->getUserBy('id', $id);
    }
}
