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

function removeAdminFromURL($value)
{
    $value = str_replace('admin.', '', $value);

    $value = str_replace('localhost/', '', $value);

    return $value;
}

function imageIcon($name)
{
    return asset_path("/images/icons/{$name}.png");
}

if (!function_exists('asset_path')) {
    function asset_path($path)
    {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? secure_asset($path) : asset($path);
    }
}