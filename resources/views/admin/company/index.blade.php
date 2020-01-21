@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('admin.alerts')
                <div class="card">
                    <div class="card-header">{{ trans('sentence.companies_listing')}} <a class="float-right" href="{{ route('admin::company.create') }}">{{ trans('sentence.add_new')}}</a></div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ trans('sentence.ID')}}</th>
                                <th scope="col">{{ trans('sentence.Name')}}</th>
                                <th scope="col">{{ trans('sentence.Email')}}</th>
                                <th scope="col">{{ trans('sentence.Logo')}}</th>
                                <th scope="col">{{ trans('sentence.Website')}}</th>
                                {{--<th scope="col">Created at</th>--}}
                                {{--<th scope="col">Updated at</th>--}}
                                <th scope="col">{{ trans('sentence.Actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($companies) > 0)
                                @foreach($companies as $company)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $company->id }}</td>
                                    <td>{{ $company->name }}</td>
                                    <td>&nbsp;{{ $company->email }}</td>
                                    <td>
                                        @if($company->logo)
                                        <a href="{{asset('storage/'.$company->logo) }}" target="_blank">{{ trans('sentence.View')}}</a>
                                        @endif
                                    </td>
                                    <td>&nbsp;{{ $company->website }}</td>
                                    {{--<td>&nbsp;{{ $company->created_at }}</td>--}}
                                    {{--<td>&nbsp;{{ $company->updated_at }}</td>--}}
                                    <td>
                                        <a href="{{ route('admin::company.edit',['id'=>$company->id]) }}">{{ trans('sentence.Edit')}}</a>
                                        <form method="POST" action="{{ route('admin::company.destroy',['id'=>$company->id]) }}" >
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="submit" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                <div class="pagination-container">
                                    <nav class="pagination">
                                        {{$companies->appends(request()->query())->links()}}
                                    </nav>
                                </div>

                            @else
                                <tr><td colspan="8">{{ trans('sentence.No Record Found')}}</td></tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
