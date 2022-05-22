<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Intipin Jombang</title>
    <link rel="stylesheet" href="{{ asset("assets/admin/css/main/app.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/admin/css/pages/auth.css") }}">
    <link rel="shortcut icon" href="{{ asset("assets/admin/images/logo/favicon.svg") }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset("assets/admin/images/logo/favicon.png") }}" type="image/png">
</head>

<body>
    <div id="auth">
        
<div class="row h-100 justify-content-center">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <div class="auth-logo">
                <a href="index.html"></a>
            </div>
            <h1 class="auth-title">Log in</h1>
            <form action="index.html">
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" class="form-control form-control-xl" placeholder="Username" required>
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" class="form-control form-control-xl" placeholder="Password" required>
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
                <a href="{{ url("admin") }}" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</a>
            </form>
        </div>
    </div>
</div>

    </div>
</body>

</html>
