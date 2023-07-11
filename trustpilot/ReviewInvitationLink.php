<?php

use Illuminate\Support\Facades\Http;

class ReviewInvitationLink
{
    public function addInvitationInTrustpilot() {
        // Trustpilot product review invitation link example

        $baseUrl = 'https://api.trustpilot.com/v1';
        $businessUnitId = config('trustpilot.businessUnitId');
        $accessToken = $this->getAccessTokenInTrustpilot();

        if (empty($accessToken)) return null;

        // Build the URL for the invitation link
        $url = "$baseUrl/private/product-reviews/business-units/$businessUnitId/invitation-links?access_token=$accessToken";

        $products = [
            'productUrl' => 'product-url',
            'imageUrl' => 'product-image-url',
            'name' => 'product-name',
            'sku' => 'product-sku',
        ];

        $consumerTrustpilot = [
            'email' => 'customer-email',
            'name' => 'customer-name',
        ];

        // Send the invitation link request to Trustpilot
        $response = Http::withToken($accessToken)->post($url, [
            'consumer' => $consumerTrustpilot,
            'locale' => 'en-US',
            'redirectUri' => config('app.url'),
            'products' => $products,
        ]);

        if ($response->failed()) { // Throw an exception if the request failed
            throw new Exception('Failed to create invitation link');
        }

        // Parse the response body and return the review URL
        $body = $response->json();

        return $body['reviewUrl'];
    }

    public function addServiceInvitationInTrustpilot() {
        // Trustpilot service review invitation link example

        $baseUrl = 'https://invitations-api.trustpilot.com/v1';
        $businessUnitId = config('trustpilot.businessUnitId');
        $accessToken = $this->getAccessTokenInTrustpilot();

        if (empty($accessToken)) return null;

        // Build the URL for the invitation link
        $url = "$baseUrl/private/business-units/$businessUnitId/invitation-links";

        // Send the invitation link request to Trustpilot
        $response = Http::withToken($accessToken)->post($url, [
            'email' => 'customer-email',
            'name' => 'customer-name',
            'locale' => 'en-US',
            'redirectUri' => config('app.url'),
        ]);

        if ($response->failed()) { // Throw an exception if the request failed
            throw new Exception('Failed to create service invitation link');
        }

        // Parse the response body and return the review URL
        $body = $response->json();

        return $body['url'];
    }

    public function getAccessTokenInTrustpilot()
    {
        $apiKey = config('trustpilot.apiKey');
        $apiSecret = config('trustpilot.apiSecret');
        $username = config('trustpilot.username');
        $password = config('trustpilot.password');

        // Build the authorization header
        $authorization = 'Basic ' . base64_encode("$apiKey:$apiSecret");

        // Send the access token request to Trustpilot
        $response = Http::withHeaders([
            'Authorization' => $authorization,
        ])
            ->asForm()
            ->post('https://api.trustpilot.com/v1/oauth/oauth-business-users-for-applications/accesstoken', [
                'grant_type' => 'password',
                'username' => $username,
                'password' => $password
            ]);

        $accessToken = $response['access_token'] ?? null;

        if (!$accessToken) return null;

        // Subtracting 30 minutes from the value of 'expires_in' to refresh before it expires
        $expiresIn = (int)$response['expires_in'] - 600;

        // Store the access token in cache for future requests
        cache()->put('trustpilotAccessToken', $accessToken, $expiresIn);

        return $accessToken;
    }
}