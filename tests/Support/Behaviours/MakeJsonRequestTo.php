<?php declare(strict_types=1);

namespace App\Tests\Support\Behaviours;

use RuntimeException;
use function dump;
use function in_array;
use function json_decode;
use function json_encode;
use function property_exists;
use function sprintf;

trait MakeJsonRequestTo
{
    use GenerateRouteTo;

    /**
     * Makes a request into the Kernel, checks the response status code and returns the payload
     *
     * To send files, add a `files` key that contains instances of SF\UploadedFile assigned to
     * the appropriate key.
     *
     * To send JSON payloads, add a `json` key with an array of args to be JSON encoded and sent
     * to the controller.
     *
     * Bad responses i.e. not matching expected code will trigger a `dump()` of the decoded JSON
     * response.
     *
     * The decoded JSON is returned on success as an associative array or single scalar depending
     * on the response.
     *
     * @param string $uri
     * @param string $method
     * @param array  $payload
     * @param int    $expectedStatusCode
     *
     * @return mixed
     */
    protected function makeJsonRequestTo(string $uri, string $method = 'GET', array $payload = [], int $expectedStatusCode = 200)
    {
        if (!property_exists($this, '__kernelBrowserClient')) {
            throw new RuntimeException(sprintf('Missing booted Kernel client, did you include %s ?', BootTestClient::class));
        }

        $content = null;
        $files   = $server = [];
        $client  = $this->__kernelBrowserClient;

        if (isset($payload['files'])) {
            $files = $payload['files'];
            $server['CONTENT_TYPE'] = 'multipart/form-data';
            unset($payload['files']);
        }
        if (isset($payload['json'])) {
            $content = json_encode($payload['json']);
            $payload = [];
        }

        $client->request($method, $uri, $payload, $files, $server, $content);
        $response = $client->getResponse();

        if ($response->getStatusCode() != $expectedStatusCode) {
            if (in_array('--debug', $_SERVER['argv'])) {
                dump(json_decode($response->getContent(), true));
            }
        }

        $this->assertEquals($expectedStatusCode, $response->getStatusCode());

        return json_decode($response->getContent(), true);
    }

    /**
     * Uses routeTo() to generate a route from the named route
     *
     * @param string $route
     * @param array  $params
     * @param string $method
     * @param array  $payload
     * @param int    $expectedStatusCode
     *
     * @return mixed
     */
    protected function makeJsonRequestToNamedRoute(string $route, array $params = [], string $method = 'GET', array $payload = [], int $expectedStatusCode = 200)
    {
        return $this->makeJsonRequestTo($this->routeTo($route, $params), $method, $payload, $expectedStatusCode);
    }
}
