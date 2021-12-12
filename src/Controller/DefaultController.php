<?php

namespace App\Controller;

use App\Service\NipValidatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /** @var NipValidatorService $nipValidatorService */
    public NipValidatorService $nipValidatorService;

    public function __construct(NipValidatorService $nipValidatorService)
    {
        $this->nipValidatorService = $nipValidatorService;
    }

    /**
     * @Route("/")
     */
    public function index(Request $request): Response
    {
        $value = $request->get('nip');

        return new Response(
            $this->nipValidatorService->validate($value)
        );
    }
}