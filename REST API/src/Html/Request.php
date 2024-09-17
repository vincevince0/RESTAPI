<?php

namespace App\Html;

use App\Repositories\CountyRepository;
class Request
{

    static function handle()
    {
        switch ($_SERVER["REQUEST_METHOD"]) {
            case "POST":
                self::postRequest();
                break;
            case "PUT":
                self::putRequest();
                break;
            case "GET":
                self::getRequest();
                break;
            case "DELETE":
                self::deleteRequest();
                break;
            default:
                echo 'Unknown request type';
                break;
        }
    }

    private static function getRequest()
    {
        $resourceName = self::getResourceName();
        switch ($resourceName) {
            case 'counties':
                $db = new CountyRepository();
                $code = 200;

                $entities = $db->getAll();
                if (empty($entities))
                {
                    $code = 404;
                }
                Response::response($entities, $code);
                break;
            default:
                Response::response(
                    [],
                    404,
                    $_SERVER['REQUEST_URI'] . "not found");
                
        }


    }

    public static function getArraUri(string $requestUri)
    {
        return explode("/", $requestUri) ?? null;
    }

    public static function getResourceName()
    {
        $arraUri = self::getArraUri($_SERVER['REQUEST_URI']);
        $result = $arraUri[count($arraUri) - 1];
        if (is_numeric($result)) {
            $result = $arraUri[count($arraUri) - 2];
        }

        return $result;
    }

    public static function getResourceId()
    {
        $arraUri = self::getArraUri($_SERVER['REQUEST_URI']);
        $result = 0;
        if (is_numeric($arraUri[count($arraUri)]-1)) {
            $result = $arraUri[count($arraUri) - 1];
        }

        return $result; 
    }

}
