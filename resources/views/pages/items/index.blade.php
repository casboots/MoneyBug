@extends('layouts.app')

@section('content')
<div class="container">
    @if($money['total'] > 0)
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="card-title">{{$money['info']['title']}}</h5>
        </div>
        <div class="card-body">
            
            <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Total</th>
                    <th scope="col">Open</th>
                </tr>
            </thead>
            <tbody>
                @foreach($persons as $personId => $name)
                <tr>
                    <td scope="row">{{$name}}</td>
                    <td>€ {{$money['person']['total'][$personId]}}</td>
                    <td>€ {{$money['person']['open'][$personId]}}</td>
                </tr>
                @endforeach
            </tbody>
            </table>
            <p class="card-text">
            @foreach($money['debt'] as $key => $value)
                {{$persons[$value[0]]}} owes € {{$value[1]}} to {{$persons[$value[2]]}}<br>
            @endforeach
            </p>
            <p class="card-text"><small class="text-muted"><a href="#" class="link">See more</a></small></p>
        </div>
    </div>
    @endif
    <div class="card mb-3">
        <div class="card-header">
            <a href="/table/{{$tableId}}/create" class="btn btn-primary">Create Item</a>
        </div>
        <div class="card-body">
            @if(count($items) > 0)
            <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Date</th>
                    <th scope="col">Payer</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Category</th>
                    <th scope="col">Store</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <th scope="row">{{$item->id}}</th>
                    <td>{{$item->date}}</td>
                    <td>{{$persons[$item->personId]}}</td>
                    <td>€ {{$item->amount}}</td>
                    <td>{{$item->categoryId}}</td>
                    <td>{{$item->store}}</td>
                </tr>    
                @endforeach   
            </tbody>
            </table>
            {{$items->links()}}
            @else
                <p class="card-text">No item found</p>
            @endif
        </div>
    </div>    
</div>
@endsection
