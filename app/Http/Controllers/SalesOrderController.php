<?php

namespace App\Http\Controllers;

use App\Models\SalesOrder;
use Asantibanez\LaravelEloquentStateMachines\Exceptions\TransitionNotAllowedException;
use Illuminate\Validation\ValidationException;

class SalesOrderController extends Controller
{
    public function newSalesOrder()
    {
        $salesOrder = SalesOrder::factory()->create();

        return redirect()->route('sales-orders.show', [$salesOrder]);
    }

    public function show(SalesOrder $salesOrder)
    {
        $salesOrder = $salesOrder ?? SalesOrder::factory()->create();

        return view('sales-orders.show')->with('salesOrder', $salesOrder);
    }

    public function updateStatus(SalesOrder $salesOrder)
    {
        request()->validate([
            'state' => 'required',
        ]);

        try {
            $salesOrder->status()->transitionTo(request('state'), [
                'comments' => request('comments'),
            ]);
        } catch (TransitionNotAllowedException $exception) {
            throw ValidationException::withMessages([
                'state' => 'Transition not allowed',
            ]);
        }

        return redirect()->route('sales-orders.show', [$salesOrder]);
    }
}
