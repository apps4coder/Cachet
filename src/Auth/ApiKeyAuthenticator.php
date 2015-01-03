<?php

namespace CachetHQ\Cachet\Auth;

use CachetHQ\Cachet\Models\User;
use Dingo\Api\Routing\Route;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class ApiKeyAuthenticator extends \Dingo\Api\Auth\AuthorizationProvider
{
    public function authenticate(Request $request, Route $route)
    {
        if ($api_key = $request->input('api_key', false)) {
            try {
                if ($user = User::findByApiKey($api_key)) {
                    return $user->getId();
                }
            } catch (ModelNotFoundException $e) {
                throw new UnauthorizedHttpException(
                    null,
                    'The API key you provided was not correct.'
                );
            }
        }
    }

    /**
     * Get the providers authorization method.
     *
     * @return string
     */
    public function getAuthorizationMethod()
    {
        return 'api_key';
    }
}
