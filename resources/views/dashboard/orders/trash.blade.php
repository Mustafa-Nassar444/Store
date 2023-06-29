@extends('layouts.dashboard')
@section('title','Trashed Orders')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Trashed Orders</li>
@endsection
@section('content')
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
                Deleted At
            </th>
            <th colspan="2">
                Operations
            </th>
        </tr>
        </thead>
        <tbody>
        @if($orders->count()>0)
            @foreach($orders as $order)
                <tr>
                    <td>
                    </td>
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
                        {{$order->deleted_at}}
                    </td>
                        <td>
                            <form action="{{route('orders.restore',$order->id)}}" method="post">
                                @method('PUT')
                                @csrf
                                <button class="btn btn-outline-info" type="submit">Restore</button>
                            </form>
                        </td>
                    <td>
                        <form action="{{route('orders.forceDelete',$order->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-outline-danger" type="submit">Delete</button>
                        </form>
                    </td>

                </tr>
            @endforeach
        @else
            <td class="alert alert-danger">No Orders Found</td>
        @endif

        </tbody>
    </table>
    {{$orders->withQueryString()->links()}}
@endsection
