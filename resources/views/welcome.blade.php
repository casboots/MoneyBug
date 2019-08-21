@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title text-center">{{config('app.name', 'Laravel')}}</h1>
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Keep track of your expenses</h3>
                            <p class="card-text">
                                Always keep track of your expenses where and when ever you want.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Categories your expenses</h3>
                            <p class="card-text">
                                Categories your expenses to get a clear picture of your financial diet.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Share your expenses</h3>
                            <p class="card-text">
                                Share your expenses.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection