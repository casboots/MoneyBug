@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-3">
        <div class="card-header">
            <a href="/table/create" class="btn btn-primary">Create Table</a>
        </div>
        <div class="card-body">
            @if(count($tables) > 0)
                @foreach($tables as $table)
                    <div class="card mb-3">
                    <a href="/table/{{$table->tableId}}" class="text-dark">
                        <div class="card-body">
                            <h5 class="card-title">{{$table->name}}</h5>
                            <p class="card-text"><small class="text-muted">Created at {{$table->created_at}}</small></p>
                        </div>
                    </a>
                    </div>
                @endforeach
                {{$tables->links()}}
            @else
                <p class="card-text">No table found</p>
            @endif
        </div>
    </div>    
</div>
@endsection
