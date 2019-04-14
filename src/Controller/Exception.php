<?php

namespace App\Controller;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class Exception
{
    public function __invoke()
    {
        throw new BadRequestHttpException('Method not allowed.');

        try {
            throw new \LogicException('Something is wrong.');
        } catch (\LogicException $e) {
            throw new \RuntimeException('Something is really wrong.', 0, $e);
        }
    }
}
