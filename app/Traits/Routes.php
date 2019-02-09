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

        $ROUTES = defined('self::ROUTES') ? self::ROUTES : null;

        if (is_null($ROUTES)) {

            $routes->show = adminRoute(self::ROUTE . '.' . 'show', $this);

            $routes->edit = adminRoute(self::ROUTE . '.' . 'edit', $this);

            $routes->update = adminRoute(self::ROUTE . '.' . 'update', $this);

            $routes->destroy = adminRoute(self::ROUTE . '.' . 'destroy', $this);

        } else {

            foreach ($ROUTES as $route) {

                $routes->$route = adminRoute(self::ROUTE . '.' . $route, $this);
            }
        }

        return $routes;
    }

    public function getUserRoutesAttribute()
    {

    }
}
