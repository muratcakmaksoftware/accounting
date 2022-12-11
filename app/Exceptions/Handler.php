<?php

namespace App\Exceptions;

use App\Helpers\ResponseHelper;
use Flasher\Prime\FlasherInterface;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * @var FlasherInterface
     */
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
     * @return void
     * @throws Throwable
     */
    public function report(Throwable $e)
    {
        parent::report($e);
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) { //Report fonksiyonu ile aynidir
            if (!($e instanceof ValidationException)) { //Bu if de belirli istisnalar haricinde hata olusmus ise slack bildirimi gonder
                $this->toSlack($e->getTraceAsString());
            }
        });

        $this->renderable(function (ValidationException $e, Request $request) { //Render sirasinda hata donusu yapilacaksa bunun yerine render() fonksiyonuda kullanılabilir.
            if ($request->wantsJson()) { //Ajax Detected
                return ResponseHelper::badRequest(['errorMessages' => $this->getValidationErrorMessagesByAjax($e)], __('errorTitle'));
            } else {
                $this->flasher = $this->container->make(FlasherInterface::class);
                $this->flasher->addError($this->getValidationErrorMessages($e), __('errorTitle'));
                return redirect()->back();
            }
        });
    }

    /**
     * @param ValidationException $e
     * @return string
     */
    public function getValidationErrorMessages(ValidationException $e): string
    {
        $html = '';
        foreach ($e->validator->getMessageBag()->getMessages() as $key => $errorMessages) {
            foreach ($errorMessages as $errorMessage) {
                $html .= '<li>' . $key . ': ' . $errorMessage . '</li>';
            }
        }
        return $html;
    }


    public function getValidationErrorMessagesByAjax(ValidationException $e): array
    {
        $ajaxErrorMessages = [];
        foreach ($e->validator->getMessageBag()->getMessages() as $key => $errorMessages) {
            foreach ($errorMessages as $errorMessage) {
                $ajaxErrorMessages[] = $key . ': ' . $errorMessage;
            }
        }
        return $ajaxErrorMessages;
    }

    /**
     * @param $errorMessage
     * @return void
     */
    public function toSlack($errorMessage)
    {
        (new SlackMessage)->error()->content($errorMessage);
    }


}
