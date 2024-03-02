<?php

namespace App\Services\Dialog;

abstract class DialogState
{
    abstract public function handle(DialogContext $dialogContext): void;
    abstract public function listen(DialogContext $dialogContext): void;

}
