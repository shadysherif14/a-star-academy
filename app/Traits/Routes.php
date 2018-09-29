<?php

namespace App\Traits;

use stdClass;

trait Routes
{

    public static function adminRoutes()
    {

        $routes = new stdClass;

        $routes->index = adminRoute(self::ROUTE . '.' . 'index');

        $routes->create = adminRoute(self::ROUTE . '.' . 'create');

        $routes->store = adminRoute(self::ROUTE . '.' . 'store');

        return $routes;
    }

    public function getAdminRoutesAttribute()
    {

        $routes = new stdClass;

        $routes->show = adminRoute(self::ROUTE . '.' . 'show', $this);

        $routes->edit = adminRoute(self::ROUTE . '.' . 'edit', $this);

        $routes->update = adminRoute(self::ROUTE . '.' . 'update', $this);

        $routes->destroy = adminRoute(self::ROUTE . '.' . 'destroy', $this);

        return $routes;
    }

    public function getUserRoutesAttribute()
    {

    }
}
