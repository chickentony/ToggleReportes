<?php

declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Responses\ResponseFactory;
use App\Services\Clients\ClientForm\ClientValidationForm;
use App\Services\Clients\RegisterService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse|null
     * @throws GuzzleException
     */
    public function register(Request $request): ?JsonResponse
    {
        $form = new ClientValidationForm();
        if ($form->validate($request->get('data')) === false) {
            return new JsonResponse($form->getErrors(), 400);
        }

        $data = $request->get('data');
        $register = new RegisterService();
        $register->getClient($data['email'], $data['password']);
        try {
            $register->storeClient();
        } catch (QueryException $e) {
            return ResponseFactory::create(
                $request, [], 400, false, "Client with email {$data['email']} already exist"
            );
        }

        return ResponseFactory::create($request);
    }
}
