<?php
declare(strict_types=1);

namespace UpcomingMovies\Actions;


use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\PhpRenderer;

/**
 * This is or home action
 * Class HomeAction
 * @package UpcomingMovies\Actions
 */
class HomeAction
{
    /**
     * @var PhpRenderer
     */
    private $renderer;

    /**
     * HomeAction constructor.
     * @param PhpRenderer $renderer
     */
    public function __construct(PhpRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Render the main page
     * @param Request $request
     * @param Response $response
     * @return ResponseInterface
     */
    public function __invoke(Request $request, Response $response)
    {
        return $this->renderer->render($response, 'index.html');
    }

}