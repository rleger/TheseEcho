<?php

namespace These\Http\Controllers;

use App;
use Illuminate\Contracts\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\Response as IlluminateReponse;

/**
 * Class BaseApiController.
 */
class BaseApiController extends Controller
{
    /**
     * @var int
     */
    protected $statusCode = IlluminateReponse::HTTP_OK;

    /**
     * @param string $message
     *
     * @return mixed
     */
    protected function respondNotFound($message = 'Not Found')
    {
        return $this->setStatusCode(IlluminateReponse::HTTP_NOT_FOUND)->respondWithError($message);
    }

    /**
     * @param $message
     *
     * @return mixed
     */
    protected function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'code'    => $this->getStatusCode(),
            ],
        ]);
    }

    /**
     * @param       $data
     * @param array $headers
     *
     * @return mixed
     */
    protected function respond($data, $headers = [])
    {
        $response = App::make(ResponseFactory::class);

        return $response->json($data, $this->getStatusCode(), $headers);
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     *
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param string $message
     *
     * @return mixed
     */
    protected function respondWithInternalError($message = 'Internal Error')
    {
        return $this->setStatusCode(IlluminateReponse::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
    }
}
