@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') Anlagenregister :: @parent @stop

{{-- Content --}}
@section('main')

<div class="page-header">
    <h3>
        Select User
        <div class="pull-right">
            <div class="pull-right"> 
                <a href="{{url('admin/anlagenregister')}}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-backward"></span> Back</a>
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

        <form method="post" action="{{url('admin/anlagenregister/store')}}">
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
                        $users = App\User::all() ?>
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
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Warning!</strong> Maximum number of plants for client is 25!
                </div>
                <select data-placeholder="Choose a User..." class="chosen-select" style="width:200px;" tabindex="2" name="user_id">
                    @foreach($users as $user)
                    @if($user->hasRole('comment'))
                    <?php $plants = App\Plant::where('user_id', $user->id)->get(); ?>
                    <option value="{{$user->id}}">{{$user->name . ' ' . $user->last_name . ' (' .count($plants) . ')' }}</option>
                    @endif
                    @endforeach
                </select>



            </div>
            <div class="pull-right">
                <div class="pull-right"> 
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>

        </form>
    </div>
    @else
    <i>Please go <a href="{{url('admin/anlagenregister')}}">back</a> and enter the zip code and start selecting plants.</i>
    @endif
</div>


@stop

{{-- Scripts --}}
@section('scripts')

@parent

@stop
