<?php

namespace PragmaGoTech\Interview;

use Psr\Container\ContainerInterface;

class App
{
    public function __construct(
        protected ContainerInterface $container,
        protected ?Router $router = null,
        protected array $request = [],
    ) {}

    public function boot(): static
    {
        return $this;
    }

    public function run()
    {
        try {
            echo $this->router->resolve($this->request['uri'], strtolower($this->request['method']));
        } catch (\Exception) {
            http_response_code(404);

            echo 'Not Found';
        }
    }
}
