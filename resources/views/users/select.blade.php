@extends('app')

@section('title') Home :: @parent @stop

@section('content')
@include('notifications')


<div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
        @include('users.partials.nav')
    </div>
    <div id="loading"  class="spinner">
        Loading...
    </div>
    <div class="col-sm-9 col-md-10 main">

        <div class="page-header">
            <h3>
                Confirm
                <div class="pull-right">
                    <div class="pull-right"> 
                        <a href="{{url('user/anlagenregister')}}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-backward"></span> Back</a>
                    </div>
                </div>
            </h3>
        </div>
        <div class="row">
            @foreach($errors->all() as $error)
            {{ $error }}
            @endforeach
            <div class="alert alert-danger none" role="alert"></div>
            @if(Session::has('ids'))
            <div class="col-lg-12">

                <form method="post" action="{{url('user/anlagenregister/store')}}">
                    <div class="form-group">
                        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <table id="data" class="table table-striped table-hover ">
                            <thead>
                                <tr>

                                    <th>Postleitzahl</th>
                                    <th>Ort</th>
                                    <th>Strasse</th>
                                    <th>Anlagentyp</th>
                                    <th>Anlagenschluessel</th>                            
                                </tr>

                            </thead>
                            <tbody>
                                @foreach(Session::get('ids') as $id)
                                <?php $address = App\Plant::find($id);
                                $users = App\User::all()
                                ?>
                                <tr>

                                    <td><input type="text" class="form-control" readonly  name="plz" value="{{ $address->PLZ }}" >
                                        <input type="hidden" name="id[]"  value="{{$address->id}}" /></td>
                                    <td><input type="text" class="form-control" readonly name="ort" value="{{ $address->Ort }}" placeholder="{{ $address->Ort }}"></td>
                                    <td><input type="text" class="form-control" readonly name="strasse" value="{{ $address->Strasse }}"></td>
                                    <td><input type="text" class="form-control" readonly name="anlagentyp" value="{{ $address->Anlagentyp }}"></td>
                                    <td><input type="text" class="form-control" readonly name="anlagenschluessel" value="{{ $address->Anlagenschluessel }}"></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>                
                        
                    </div>
                    <div class="pull-right">
                        <div class="pull-right"> 
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                    </div>

                </form>
            </div>
            @else
            <i>Please go <a href="{{url('user/anlagenregister')}}">back</a> and enter the zip code and start selecting plants.</i>
            @endif
        </div>
    </div>

    @stop

    {{-- Scripts --}}
    @section('scripts')

    @parent

    @stop
