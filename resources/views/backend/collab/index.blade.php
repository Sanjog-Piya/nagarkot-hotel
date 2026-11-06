@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3">{{translate('All collabs')}}</h1>
        </div>
        <div class="col text-right">
            <a href="{{ route('collab.create') }}" class="btn btn-circle btn-info">
                <span>{{translate('Add New collab')}}</span> 
            </a>
        </div>
    </div>
</div>
<br>

<div class="card">
    <form class="" id="sort_blogs" action="" method="GET">
        <div class="card-header row gutters-5">
            <div class="col text-center text-md-left">
                <h5 class="mb-md-0 h6">{{ translate('All collabs posts') }}</h5>
            </div>
            
            <div class="col-md-2">
                <div class="form-group mb-0">
                    <input type="text" class="form-control form-control-sm" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type & Enter') }}">
                </div>
            </div>
        </div>
        </from>
        <div class="card-body">
            <table class="table mb-0 aiz-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{translate('Title')}}</th>
                        <th data-breakpoints="lg">{{translate('Description')}}</th>
                      
                        <th class="text-right">{{translate('Options')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($collabs as $key => $collab)
                    <tr>
                          <td>{{ $key+1}} </td>
                        <td>
                            {{ $collab->title }}
                        </td>
                        <td>
                            {!! $collab->short_description !!}
                        </td>

                          
                      
                        <td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('collab.edit',$collab->id)}}" title="{{ translate('Edit') }}">
                                <i class="las la-pen"></i>
                            </a>
                            
                            <a href="{{route('collabdestory', $collab->id)}}" class="btn btn-soft-danger btn-icon btn-circle btn-sm" >
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
         
        </div>
</div>

@endsection

