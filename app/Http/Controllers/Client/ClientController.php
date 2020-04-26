<?php

declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\RegisterService;
use App\Services\Validation\ClientForm\ClientValidationForm;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse|null
     */
    public function register(Request $request): ?JsonResponse
    {
        $form = new ClientValidationForm();
        if ($form->validate($request->get('data')) === false) {
            return new JsonResponse($form->getErrors(), 400);
        }

        $data = $request->get('data');
        $register = new RegisterService();
        $register->getUser($data['email'], $data['password']);

        return new JsonResponse(200);
    }
}
