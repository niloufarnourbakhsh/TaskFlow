<?php

namespace App;

enum TaskStatus:string
{
    case NotDone  = 'notdone';
    case Doing = 'doing';
    case Done = 'done';
}
