<?php

namespace App\Http\Controllers;

use Flasher\Prime\FlasherInterface;

abstract class BaseController extends Controller
{
    /**
     * @var mixed
     */
    protected $service;

    /**
     * @var FlasherInterface
     */
    protected FlasherInterface $flasher;

    /**
     * @param string|null $message
     * @param $title
     * @return void
     */
    public function addFlashSuccess(string $message = null, $title = null)
    {
        $this->flasher->addSuccess($message ?? __('success'), $title ?? __('successTitle'));
    }

    /**
     * @param string|null $message
     * @param $title
     * @return void
     */
    public function addFlashError(string $message = null, $title = null)
    {
        $this->flasher->addError($message ?? __('badRequest'), $title ?? __('errorTitle'));
    }
}
