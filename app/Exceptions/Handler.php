<?php

namespace App\Exceptions;

use Flasher\Laravel\Facade\Flasher;
use Flasher\Prime\FlasherInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    private FlasherInterface $flasher;

    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * @param Throwable $e
     * @return RedirectResponse|void
     * @throws Throwable
     * @throws BindingResolutionException
     */
    public function report(Throwable $e)
    {
        parent::report($e);
        //TODO: Ajax exception ayrimi yapilacak

        $this->flasher = $this->container->make(FlasherInterface::class);
        if ($e instanceof ValidationException) {
            $this->flasher->addError($this->getValidationErrorMessages($e), __('errorTitle'));
            return redirect()->back();
        }
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {

        });
    }

    /**
     * @param Throwable $e
     * @return string
     */
    public function getValidationErrorMessages(Throwable $e): string
    {
        $html = '';
        foreach ($e->validator->getMessageBag()->getMessages() as $key => $errorMessages) {
            foreach ($errorMessages as $errorMessage) {
                $html .= '<li>'.$key.': '.$errorMessage.'</li>';
            }
        }
        return $html;
    }
}
