@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            @if(count($items) > 0)
                @foreach($items as $item)

                @endforeach
            @else
                <p class="card-text">No item found</p>
            @endif
        </div>
    </div>    
</div>
@endsection
