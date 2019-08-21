@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            {!! Form::open(['action' => 'TableController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('persons', 'Persons')}}
            {{Form::select('persons', ['1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5], null, ['class' => 'form-control', 'placeholder' => 'Select amount of persons'])}}
        </div>
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>    
</div>
@endsection
