<?php

namespace Iamprincesly\GoogleVertexAI;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Google\Auth\CredentialsLoader;
use Google\Auth\HttpHandler\HttpHandlerFactory;
use Iamprincesly\GoogleVertexAI\Resources\ModelResponse;

class GoogleVertexAIClient
{
    protected Client $client;

    protected string $project;

    protected string $location;

    protected string $api_version;
    protected string $credentials_path;

    public function __construct()
    {
        $this->project = config('googlevertexai.project_id');

        $this->location = config('googlevertexai.location');
        
        $this->api_version = config('googlevertexai.api_version');

        $this->credentials_path = config('googlevertexai.credentials_path');

        $this->client = $this->getClient($this->getAccessToken());
    }

    public function setAPIVersion(string $api_version): self
    {
        $this->api_version = $api_version;
        return $this;
    }

    public function setProject(string $project): self
    {
        $this->project = $project;
        return $this;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;
        return $this;
    }

    private function getAccessToken(): string
    {
        $scopes = ['https://www.googleapis.com/auth/cloud-platform'];

        $credentials = CredentialsLoader::makeCredentials($scopes, json_decode(file_get_contents($this->credentials_path), true));
        
        $credentials->fetchAuthToken(HttpHandlerFactory::build(new Client()));

        return $credentials->getLastReceivedToken()['access_token'];
    }

    private function getClient(string $authToken): Client
    {
        $endpoint = "https://{$this->location}-aiplatform.googleapis.com/{$this->api_version}/projects/{$this->project}/locations/{$this->location}/publishers/google/";

        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . $authToken,
                'Content-Type' => 'application/json',
            ],
            'base_uri' => $endpoint,
            // 'timeout'  => 9.0,
        ]);

        return $client;
    }

    public function sendRequest(string $url, $data): ModelResponse
    {
        // dd($data);
        $request = new Request(method: 'POST', uri: $url, body: $data);

        $response = $this->client->send($request);

        return new ModelResponse(json_decode($response->getBody(), true));
    }
}
