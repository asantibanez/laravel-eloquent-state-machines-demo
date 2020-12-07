@extends('layout')

@section('content')
    <div class="space-y-8">
        <div class="bg-white shadow">
            <div class="px-4 py-5">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Sales Order Information
                </h3>
            </div>
            <div class="border-t border-gray-200 sm:p-0">
                <dl>
                    <div class="py-5 grid grid-cols-3 gap-4 px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            #Number
                        </dt>
                        <dd class="text-sm text-gray-900 col-span-2">
                            {{ $salesOrder->id }}
                        </dd>
                    </div>
                    <div class="py-5 grid grid-cols-3 gap-4 px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Customer
                        </dt>
                        <dd class="text-sm text-gray-900 col-span-2">
                            {{ $salesOrder->customer_name }}
                        </dd>
                    </div>
                    <div class="py-5 grid grid-cols-3 gap-4 px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Total
                        </dt>
                        <dd class="text-sm text-gray-900 col-span-2">
                            $ {{ $salesOrder->total }}
                        </dd>
                    </div>
                    <div class="py-5 grid grid-cols-3 gap-4 px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Status
                        </dt>
                        <dd class="text-sm text-gray-900 col-span-2">
                            <span class="bg-indigo-400 py-1 px-3 text-sm text-white rounded-full">
                            {{ $salesOrder->status }}
                            </span>
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="p-5">
                <div class="flex justify-end">
                    <a
                        href="{{ route('sales-orders.new') }}"
                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600">
                        New
                    </a>
                </div>
            </div>
        </div>


        <div class="space-y-4">
            <h1 class="text-lg font-medium">
                Update Status
            </h1>

            <div class="shadow bg-white rounded-lg p-6">
                <form action="/sales-orders/{{ $salesOrder->id }}/update-status" method="post">
                    @csrf
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                New Status
                            </label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <select name="state" class="border w-full rounded py-2 px-2">
                                    <option value="">Choose New Status</option>
                                    @foreach(\App\StateMachines\SalesOrders\StatusStateMachine::STATES as $state)
                                        <option value="{{ $state }}">{{ $state }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('state')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Comments
                            </label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <textarea name="comments" rows="5" class="py-2 px-2 border rounded w-full"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="pt-5">
                        <div class="flex justify-end">
                            <button type="reset" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700">
                                Reset
                            </button>
                            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

        <div class="space-y-4">
            <h1 class="text-lg font-medium">
                Status History
            </h1>
            <div class="shadow border-b border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Date
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            From
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            To
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Comments
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($salesOrder->status()->history()->get() as $stateHistory)
                        <tr>
                            <td class="px-5 py-3 text-sm font-medium text-gray-900">
                                {{ $stateHistory->created_at }}
                            </td>
                            <td class="px-5 py-3 text-sm text-gray-500">
                                {{ $stateHistory->from ?? 'N/A' }}
                            </td>
                            <td class="px-5 py-3 text-sm text-gray-500">
                                {{ $stateHistory->to }}
                            </td>
                            <td class="px-5 py-3 text-sm text-gray-500">
                                {{ $stateHistory->getCustomProperty('comments') ?? 'N/A' }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
