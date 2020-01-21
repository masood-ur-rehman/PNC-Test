@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if (Auth::user())
                        <ul>
                            <li>
                                <a href="{{ route('admin::company.index') }}">{{ trans('sentence.manage_companies')}}</a>
                            </li>
                            <li>
                                <a href="{{ route('admin::employee.index') }}">{{ trans('sentence.manage_employees')}}</a>
                            </li>
                        </ul>
                        <p>{{ trans('sentence.welcome')}}</p>
                        @else
                        <a href="{{ route('login') }}">{{ trans('sentence.login')}}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
