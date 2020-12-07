<?php

namespace App\Models;

use App\StateMachines\SalesOrders\StatusStateMachine;
use Asantibanez\LaravelEloquentStateMachines\Traits\HasStateMachines;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    use HasFactory;
    use HasStateMachines;

    public $stateMachines = [
        'status' => StatusStateMachine::class,
    ];
}
