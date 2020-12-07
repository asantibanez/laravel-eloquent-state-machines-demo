<?php

namespace App\StateMachines\SalesOrders;

use Asantibanez\LaravelEloquentStateMachines\StateMachines\StateMachine;

class StatusStateMachine extends StateMachine
{
    const PENDING = 'pending';
    const APPROVED = 'approved';
    const DECLINED = 'declined';
    const PROCESSED = 'processed';

    const STATES = [
        self::PENDING,
        self::APPROVED,
        self::DECLINED,
        self::PROCESSED,
    ];

    public function recordHistory(): bool
    {
        return true;
    }

    public function transitions(): array
    {
        return [
            self::PENDING => [self::APPROVED, self::DECLINED],
            self::APPROVED => [self::PROCESSED],
            self::DECLINED => [self::APPROVED],
        ];
    }

    public function defaultState(): ?string
    {
        return self::PENDING;
    }
}
