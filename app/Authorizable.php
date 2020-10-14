<?php

namespace App;

trait Authorizable
{
    private $abilities = [
        'index' => 'Show',
        'edit' => 'Edit',
        'show' => 'Show',
        'update' => 'Edit',
        'create' => 'Add',
        'store' => 'Add',
        'destroy' => 'Delete'
    ];
    /**
    * Override of callAction to perform the authorization before
    *
    * @param $method
    * @param $parameters
    * @return mixed
    */

    public function callAction($method, $parameters)
    {
        $ability = $this->getAbility($method);
        if(!is_null($ability)) {
            $this->authorize($ability);
        }

        return parent::callAction($method, $parameters);
    }

    public function getAbility($method)
    {
        $routeName = explode('.', \Request::route()->getName());
        $action = array_get($this->getAbilities(), $method);
        // dd($method, $routeName,$action, $action ? $action . ' ' . ucfirst($routeName[0]) : null);
        return $action ? $action . ' ' . ucfirst($routeName[0]) : null;
    }

    private function getAbilities()
    {
        return $this->abilities;
    }

    public function setAbilities($abilities)
    {
        $this->abilities = $abilities;
    }
}
