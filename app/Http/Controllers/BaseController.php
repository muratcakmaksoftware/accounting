<?php

namespace App\Http\Controllers;

use Flasher\Prime\FlasherInterface;

abstract class BaseController extends Controller
{
    protected $service;

    protected FlasherInterface $flasher;
}
