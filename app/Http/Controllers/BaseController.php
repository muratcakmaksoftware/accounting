<?php

namespace App\Http\Controllers;

use Flasher\Prime\FlasherInterface;

abstract class BaseController extends Controller
{
    protected $service;

    protected FlasherInterface $flasher;

    public function addFlashSuccess(string $message = null, $title = null)
    {
        $this->flasher->addSuccess($message ?? __('success'), $title ?? __('successTitle'));
    }

    public function addFlashError(string $message = null, $title = null)
    {
        $this->flasher->addError($message ?? __('badRequest'), $title ?? __('errorTitle'));
    }
}
