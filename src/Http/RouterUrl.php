<?php

namespace App\Http;

use FastRoute\RouteParser;
use FastRoute\RouteParser\Std as StdParser;
use InvalidArgumentException;
use League\Route\Router;

/**
 * Creating URLs for a named route.
 */
final class RouterUrl
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @var RouteParser
     */
    private $routeParser;

    /**
     * @var string Base path used in pathFor()
     */
    private $basePath = '';

    /**
     * Constructor.
     *
     * @param Router $router The router
     * @param RouteParser|null $parser The route parser
     */
    public function __construct(Router $router, ?RouteParser $parser = null)
    {
        $this->router = $router;
        $this->routeParser = $parser ?: new StdParser();
    }

    /**
     * Set the base path used in pathFor.
     *
     * @param string $basePath The base path
     *
     * @return void
     */
    public function setBasePath(string $basePath): void
    {
        $this->basePath = $basePath;
    }

    /**
     * Get the base path used in pathFor().
     *
     * @return string
     */
    public function getBasePath(): string
    {
        return $this->basePath;
    }

    /**
     * Build the path for a named route excluding the base path.
     *
     * @param string $name The route name
     * @param array $data The named argument replacement data
     * @param array $queryParams The optional query string parameters
     *
     * @throws InvalidArgumentException
     *
     * @return string The url
     */
    private function relativePathFor(string $name, array $data = [], array $queryParams = []): string
    {
        $pattern = $this->router->getNamedRoute($name)->getPath();
        $routeItems = $this->routeParser->parse($pattern);

        // $routeStrings is an array of all possible routes that can be made. There is
        // one route item for each optional parameter plus one for no optional parameters.
        //
        // The most specific is last, so we look for that first.
        $routeItems = array_reverse($routeItems);
        $segments = [];
        $segmentName = '';

        foreach ($routeItems as $routeItems) {
            foreach ($routeItems as $item) {
                if (is_string($item)) {
                    // this segment is a static string
                    $segments[] = $item;
                    continue;
                }

                // This segment has a parameter: first element is the name
                if (!array_key_exists($item[0], $data)) {
                    // we don't have a data element for this segment: cancel
                    // testing this routeData item, so that we can try a less
                    // specific routeData item.
                    $segments = [];
                    $segmentName = $item[0];
                    break;
                }
                $segments[] = $data[$item[0]];
            }

            if (!empty($segments)) {
                // we found all the parameters for this route data, no need to check
                // less specific ones
                break;
            }
        }

        if (empty($segments)) {
            throw new InvalidArgumentException('Missing data for URL segment: ' . $segmentName);
        }

        $url = implode('', $segments);

        if ($queryParams) {
            $url .= '?' . http_build_query($queryParams);
        }

        return $url;
    }

    /**
     * Build the path for a named route including the base path.
     *
     * @param string $name Route name
     * @param array $data Named argument replacement data
     * @param mixed[] $queryParams Optional query string parameters
     *
     * @throws InvalidArgumentException
     *
     * @return string url
     */
    public function pathFor(string $name, array $data = [], array $queryParams = []): string
    {
        $url = $this->relativePathFor($name, $data, $queryParams);

        if ($this->basePath) {
            $url = $this->basePath . $url;
        }

        return $url;
    }
}
