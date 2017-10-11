<?php
namespace Symfony\Component\HttpKernel\Controller;
/**
 * Define your routes in this file.
 */

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;



interface ControllerResolverInterface
{
    function getController(Request $request);
    function ArgumentResolver(Request $request, $controller);
}

/**
 * @param null $year
 * @return bool
 */
function is_leap_year($year = null)
{
    if (null === $year) {
        $year = date('Y');
    }
    return 0 === $year % 400 || (0 === $year % 4 && 0 !== $year % 100);
}

$routes = new Routing\RouteCollection();

class LeapYearController
{
    public function indexAction($request)
    {
        if (is_leap_year($request->attributes->get('year'))) {
            return new Response('Yep, this is a leap year!');
        }
        if (empty($request->attributes->get('year'))) {
            return new Response('Year cant be empty !!!');
        }
        return new Response('Nope, this is not a leap year.');
    }
}

$routes->add('leap_year', new Routing\Route('/is_leap_year/{year}', array(
    'year' => null,
    '_controller' => 'LeapYearController::indexAction',
)));

$routes->add('home', new Routing\Route('/', array(
    '_controller' => function() {
        return new Response('Version 1.0 mphp');
    }
)));

return $routes;
