<?php

use Illuminate\Support\Facades\URL;

function jsonResponse($status)
{
    return response()->json(compact('status'));
}

function adminRoute($route, $params = null)
{

    return route("admin.{$route}", $params);
}

function adminStaticRoute($model, $action = 'index')
{

    $model = str_start(str_singular($model), 'App\\');

    return $model::adminRoutes()->$action;
}

function getSubdomain()
{

    $url = URL::current();

    $urlArray = explode('.', $url);

    if (sizeof($urlArray) === 3 && $urlArray[1] === 'astaracademy') {

        $subdomainArray = explode('//', $urlArray[0]);

        $subdomain = $subdomainArray[1];

        return $subdomain;
    }

    return null;
}
