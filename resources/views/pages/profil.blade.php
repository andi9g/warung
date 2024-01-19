@extends('layouts.admin')


@section("warnaprofil", "active")


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>UBAH PASSWORD</h3></div>
                <form action="{{ route('ubah.password', []) }}" method="post" >
                    @csrf
                    <div class="card-body">
                       <input type="number" value="{{ Auth::user()->idusers }}" hidden name="iduser" id="">
                        
                       <div class="form-group">
                        <label for="password">Password Baru</label>
                        <input id="password" class="form-control" type="password" name="password">
                       </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">UABAH PASSWORD</button>
                    </div>
                
                </form>
            </div>
        </div>
    </div>
</div> 

@endsection