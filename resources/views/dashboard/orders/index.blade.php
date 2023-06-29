@extends('layouts.dashboard')
@section('title','Show Orders')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Orders Page</li>
@endsection
@section('content')
    <div class="mb-5">

        <a href="{{route('orders.trashed')}}" class="btn btn-sm btn-outline-info">Trash</a>

    </div>

<x-alert type="success" />
    <table class="table">
        <thead>
        <tr>
            <td></td>
            <th>
                ID
            </th>
            <th>
                Store
            </th>
            <th>
                User
            </th>
            <th>
                Order #
            </th>
            <th>
                Status
            </th>
            <th>
                Payment Method
            </th>
            <th>
                Payment Status
            </th>
            <th>
                Created At
            </th>
            <th colspan="2">
                Operations
            </th>
        </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td></td>
                    <td>
                        {{$order->id}}                    <td>
                        {{$order->store->name}}
                    </td>
                    <td>
                        {{$order->user->name}}
                    </td>
                    <td>
                        <a href="{{route('orders.show',$order->id)}}" >{{$order->number}}</a>
                    </td>
                    <td>
                        {{$order->status}}
                    </td>
                    <td>
                        {{$order->payment_method}}
                    </td>
                    <td>
                        {{$order->payment_status}}
                    </td>
                    <td>
                        {{$order->created_at}}
                    </td>
                        <td>
                            @can('order.delete')
                        <form action="{{route('orders.destroy',$order->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-outline-danger" type="submit">Delete</button>

                        </form>
                            @endcan
                    </td>
                </tr>
            @empty
                <tr>
                <td colspan="5" class="alert alert-danger">No Orders Found</td>
                </tr>
            @endforelse



        </tbody>
    </table>
    {{$orders->withQueryString()->links()}}
@endsection
