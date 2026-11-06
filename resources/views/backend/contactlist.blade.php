@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3">{{translate('Contact List')}}</h1>
        </div>

    </div>
</div>
<br>

<div class="card">
    <form class="" id="sort_blogs" action="" method="GET">
        <div class="card-header row gutters-5">
            <div class="col text-center text-md-left">
                <h5 class="mb-md-0 h6">{{ translate('Contact Lists') }}</h5>
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
                        <th>{{translate('First Name')}}</th>
                        <th data-breakpoints="lg">{{translate('Last Name')}}</th>
                          <th data-breakpoints="lg">{{translate('Email')}}</th>
                            <th data-breakpoints="lg">{{translate('Number')}}</th>
                              <th data-breakpoints="lg">{{translate('Message')}}</th>
                      
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $key => $contact)
                    <tr>
                          <td>{{ $key+1}} </td>
                        <td>
                            {{ $contact->fname }}
                        </td>
                            <td>
                            {{ $contact->lname }}
                        </td>
                            <td>
                            {{ $contact->email }}
                        </td>
                            <td>
                            {{ $contact->number }}
                        </td>
                            <td>
                            {{ $contact->message }}
                        </td>
                     
                          
                      

                    </tr>
                    @endforeach
                </tbody>
            </table>
         
        </div>
</div>

@endsection

