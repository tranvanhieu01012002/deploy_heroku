@extends('Layouts.master')
@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Đăng kí</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb">
                    <a href="/">Home</a> / <span>Đăng kí</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="container">
        <div id="content">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif
            <form action="{{route('user.sign-up')}}" method="post" class="beta-form-checkout">
                @csrf
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <h4>Đăng kí</h4>
                        <div class="space20">&nbsp;</div>

                        <div class="form-block">
                            <label for="email">Email address*</label>
                            <input name="email" type="email" id="email" required>
                        </div>

                        <div class="form-block">
                            <label for="your_last_name">Fullname*</label>
                            <input name="fullname" type="text" id="your_last_name" required>
                        </div>

                        <div class="form-block">
                            <label for="adress">Address*</label>
                            <input name="adress" type="text" id="adress" value="Street Address" required>
                        </div>

                        <div class="form-block">
                            <label for="phone">Phone*</label>
                            <input name="phone" type="text" id="phone" required>
                        </div>
                        <div class="form-block">
                            <label for="phone">Password*</label>
                            <input name="password" type="text" id="phone" required>
                        </div>
                        <div class="form-block">
                            <label for="phone">Re password*</label>
                            <input name="repassword" type="text" id="phone" required>
                        </div>
                        <div class="form-block">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </form>
        </div> <!-- #content -->
    </div>
@endsection
@include('Partial.LoginScript')
