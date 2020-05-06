@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <form method="POST" action="{{route('code.store')}}" name="code">
            @csrf

            <div class="form-row" style="margin-bottom: 3%;">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Name Visitor</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name Visitor">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Surname Visitor</label>
                    <input type="text" class="form-control" name="surname" id="surname" placeholder="Surname Visitor">
                </div>
            </div>
            <div class="form-row" style="margin-bottom: 3%;">
                <div class="form-group col-sm-3 offset-3">
                    <p><label for="type">Type of code</label></p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="inlineRadio1" checked="checked" value="one">
                        <label class="form-check-label" for="inlineRadio1">One</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="inlineRadio2" value="multi">
                        <label class="form-check-label" for="inlineRadio2">Multi</label>
                    </div>
                </div>
                <div class="form-group col-sm-3">
                    <label for="datepicker">Expiration Date</label><input type="text" placeholder="Expiration Date" class="form-control" name="expiration" id="datepicker">
                </div>

            </div>
            <input type="submit" class="btn btn-primary btn-block" value="Create" />
        </form>
    </div>
@endsection
