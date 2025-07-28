<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

class MultiLanguageRoutesTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('route:clear');
        $this->artisan('config:clear');
    }

    protected function disableMultilanguage()
    {
        Config::set('app.multilang', false);
        Config::set('app.locale', 'en');
        
        $this->refreshRoutes();
    }

    protected function enableMultilanguage()
    {
        Config::set('app.multilang', true);
        Config::set('app.locale', 'en');
        Config::set('app.locale', 'en,ru');
        
        $this->refreshRoutes();
    }

    protected function refreshRoutes()
    {
        $router = $this->app->make('router');
        $routes = new \Illuminate\Routing\RouteCollection();
        $router->setRoutes($routes);
        require base_path('routes/web.php');
    }

    function testMultiLanguageDisabled200()
    {
        $this->disableMultilanguage();
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    function testMultiLanguageDisabled404()
    {
        $this->disableMultilanguage();
        $response = $this->get('/en');
        $response->assertStatus(404);
    }

    function testMultiLanguageEnabled200()
    {
        $this->enableMultilanguage();
        $response = $this->get('/ru');
        $response->assertStatus(200);
    }

    function testMultiLanguageEnabled301()
    {
        $this->enableMultilanguage();
        $response = $this->get('/');
        $response->assertStatus(301);
    }

    function testMultiLanguageEnabled404()
    {
        $this->enableMultilanguage();
        $response = $this->get('/lv');
        $response->assertStatus(404);
    }
}