<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\Resource;

class BaseResource extends Resource
{
    use ResourceMeta;

    /**
     * BaseResource constructor.
     * @param $resource
     */
    public function __construct($resource = null)
    {
        if (is_null($resource)) {
            $resource = collect();
        }

        if (is_array($resource)) {
            $resource = collect($resource);
        }

        parent::__construct($resource);
    }

    /**
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode) {
        $this->statusCode = $statusCode;
        if ($this->statusCode >= 400) {
            $this->message = 'Failure!!';
        }
        return $this;
    }

    public static function collection($resource)
    {
        return new AnonymousResourceCollection($resource, get_called_class());
    }

    public static function create($resource)
    {
        return new self($resource);
    }

    public static function errors($errors = [], $message = 'An error has occured!', $statusCode = 500, $errorString = "UNKNOWN_ERROR")
    {
        $instance = new static;


        $errorMeta = [
            'errorMessage' => $message,
            'errorString' => $errorString,
        ];
        $errorsArray = $errors ?? $errorMeta;

        $instance->setStatusCode($statusCode);

        $instance->additionalMerge([
            'meta' => $errorMeta,
            'errors' => $errorsArray
        ]);

        return $instance;
    }

    public static function validationErrors($errors) {
        return static::errors(
            $errors,
            'Validation error',
            422,
            ErrorString::VALIDATION_ERROR
        );
    }

    public static function ok($message = 'Success!', $statusCode = 200)
    {
        $instance = new static;
        $instance->message = $message;
        $instance->statusCode = $statusCode;

        return $instance;
    }
}
