@extends('home.master')
@section('headerjs')
@endsection()

@section('content')

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h2 class="font-bold">Welcome to Xchange</h2>

                <p>
                    Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
                </p>

                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                </p>

                <p>
                    When an unknown printer took a galley of type and scrambled it to make a type specimen book.
                </p>

                <p>
                    <small>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</small>
                </p>

            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                    <form class="m-t" role="form" name="reset-form" id="reset-form" action="#">
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="New Password" >
                        </div>
                        <div class="form-group">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password" >
                        </div>
                        <input type="hidden" value="{{$token}}" name="token">
                        <button type="submit" class="btn btn-primary block full-width m-b res-pwd">Reset</button>

                        

                        <p class="text-muted text-center">
                            <small>Do you have an account?</small>
                        </p>
                        <a class="btn btn-sm btn-white btn-block" href="{{url('/secure/login')}}">Back to login</a>
                    </form>
                    <p class="m-t">
                        <small> &copy; 2018</small>
                    </p>
                </div>
            </div>
        </div>
        <hr/>
        
    </div>

           


@endsection()
@section('footerjs')
    <script>
       

    </script>
@endsection()
