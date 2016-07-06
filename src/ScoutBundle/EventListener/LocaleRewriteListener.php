<?php
/**
 * Created by PhpStorm.
 * User: backend1
 * Date: 6/22/16
 * Time: 1:58 PM
 */


namespace ScoutBundle\EventListener;

use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\RouteCollection;

class LocaleRewriteListener implements EventSubscriberInterface
{
    /**
     * @var Symfony\Component\Routing\RouterInterface
     */
    private $router;

    /**
     * @var routeCollection \Symfony\Component\Routing\RouteCollection
     */
    private $routeCollection;

    /**
     * @var string
     */
    private $defaultLocale;

    /**
     * @var array
     */
    private $supportedLocales;

    /**
     * @var string
     */
    private $localeRouteParam;

    public function __construct(RouterInterface $router, $defaultLocale = 'en', array $supportedLocales = array('en'), $localeRouteParam = '_locale')
    {
        $this->router = $router;
        $this->routeCollection = $router->getRouteCollection();
        $this->defaultLocale = $defaultLocale;
        $this->supportedLocales = $supportedLocales;
        $this->localeRouteParam = $localeRouteParam;
    }

    public function isLocaleSupported($locale)
    {
        return in_array($locale, $this->supportedLocales);
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        //GOAL:
        // Redirect all incoming requests to their /locale/route equivlent as long as the route will exists when we do so.
        // Do nothing if it already has /locale/ in the route to prevent redirect loops

        $request = $event->getRequest();
        $path = $request->getPathInfo();

        $route_exists = false; //by default assume route does not exist.

        foreach($this->routeCollection as $routeObject){
            $routePath = $routeObject->getPath();
            if($routePath == "/{_locale}".$path){
                $route_exists = true;
                break;
            }
        }

        //If the route does indeed exist then lets redirect there.
        if($route_exists == true){
            //Get the locale from the users browser.
            $locale = $request->getPreferredLanguage();

            //If no locale from browser or locale not in list of known locales supported then set to defaultLocale set in config.yml
            if($locale==""  || $this->isLocaleSupported($locale)==false){
                $locale = $request->getDefaultLocale();
            }

            $event->setResponse(new RedirectResponse("/".$locale.$path));
        }

        //Otherwise do nothing and continue on~
    }

    public static function getSubscribedEvents()
    {
        return array(
            // must be registered before the default Locale listener
            KernelEvents::REQUEST => array(array('onKernelRequest', 17)),
        );
    }
}