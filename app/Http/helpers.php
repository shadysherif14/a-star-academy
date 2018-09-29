<?php

    function jsonResponse($status)
    {
        return response()->json(compact('status'));
    }

    function adminRoute($route, $params = null) {

        return route("admin.{$route}", $params);
    }

    function adminStaticRoute($model, $action = 'index')
    {

        $model = str_start(str_singular($model), 'App\\');

        return $model::adminRoutes()->$action;
    }