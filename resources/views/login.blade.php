<!DOCTYPE html>
<html lang="en">
<head>
    <!-- required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login Panel</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="images/favicon/favicon.png">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- include style -->
    <link rel="stylesheet" href="{{asset('backend')}}/style/credential.css">
</head>

<body>
<section class="credential_section">
    <div class="section_cover">
        <div class="credential_div">
            <div class="form_box">
                @if(Session::has('warning'))
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Warning!</h4>
                        <p>{{Session::get('warning')}}</p>
                    </div>

                @endif

                <h2>Login <span></span></h2>
                <form action="{{route('admin.login')}}" method="POST">
                    @csrf
                    <div class="form_group">
                        <input type="text" name="username" class="form_control" placeholder="Username" autocomplete="off" autofocus>
                    </div>
                    <div class="form_group">
                        <input type="password" name="password" class="form_control" placeholder="Password" autocomplete="off">
                    </div>
                    <div class="form_group form-remeber">
                        <div class="form-check">
                            <input type="checkbox" id="remember">
                            <label for="remember">Remember me</label>
                        </div>
                        <a href="#">Forgot password</a>
                    </div>
                    <button type="submit" class="submit_btn">Login</button>
                </form>
            </div>
        </div>
    </div>
</section>
</body>
</html>
