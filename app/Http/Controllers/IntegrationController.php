<?php

namespace App\Http\Controllers;

use Commercetools\Api\Client\ApiRequestBuilder;
use Commercetools\Api\Client\ClientCredentialsConfig;
use Commercetools\Api\Client\Config;
use Commercetools\Client\ClientCredentials;
use Commercetools\Client\ClientFactory;
use Illuminate\Http\Request;

class IntegrationController extends Controller
{
    public function index()
    {
        $projectKey = env('E_TOOL_PROJECT_KEY');
        $client = $this->getClient();

        $builder =  new ApiRequestBuilder($client);
        $request = $builder
            ->withProjectKey("projectKey")
            ->customerGroups()
            ->get();
        dd();
        $request = $builder->withProjectKey($projectKey)->get();
        dd($request);
    }

    public function getClient()
    {
        $clientId = env('E_TOOL_CLIENT_ID');
        $clientSecret = env('E_TOOL_SECRET');
        $authConfig = new ClientCredentialsConfig(new ClientCredentials($clientId, $clientSecret));

        $client = ClientFactory::of()->createGuzzleClient(
            new Config(),
            $authConfig
        );

        return $client;
    }
}
