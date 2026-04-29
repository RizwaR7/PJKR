<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Universitas Palangka Raya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        body {
            background: linear-gradient(135deg, #056262, rgb(64, 134, 134));
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            margin: 0 15px; /* Tambahkan margin kiri dan kanan */
        }


        .login-container h5 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            color: #333;
        }

        .form-group {
            position: relative;
            margin-bottom: 15px;
        }

        .form-control {
            border-radius: 8px;
            padding-left: 40px;
        }

        .input-group-text {
            background: transparent;
            border: none;
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #888;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #888;
        }

        .btn-primary {
            background: rgb(11, 107, 107);
            border: none;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: rgb(71, 71, 71);
        }
    </style>
</head>
<body>

    <div class="login-container">
        <img src="https://upr.ac.id/wp-content/uploads/2023/03/uprlogo-150x150.png" alt="Logo UPR" class="d-block mx-auto">
        <hr>
        <p style="font-size : 11px">
            Silakan menghubungi UPT Teknologi Informasi dan Komunikasi jika ada kendala melalui Support and Helpdesc ICT Support.
        </p>
        <form id="formLogin" method="POST" action="{{ route('login_admin') }}">
            @csrf
            <div class="form-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" class="form-control" id="sid" name="sid" placeholder="Username">
            </div>

            <div class="form-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <span class="toggle-password" onclick="togglePassword()"><i class="fas fa-eye"></i></span>
            </div>

            <div class="form-group form-check mt-3">
                <input type="checkbox" class="form-check-input" id="customCheck">
                <label class="form-check-label" for="customCheck">Ingat Saya</label>
            </div>

            <button type="submit" id="btnLogin" class="btn btn-primary btn-block w-100">Masuk</button>

            <hr>
            <p class="text-center" style="font-size : 11px">
                Universitas Palangka Raya
                <br>
                <a href="https://sso.upr.ac.id/support" target="_blank" class="text-center" style="text-decoration: none;">
                    <b style="color: rgb(11, 107, 107);">
                        <i>Support and Helpdesk : ICT Support.</i>
                    </b>
                </a>

            </a>
            </p>

        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const toggleIcon = document.querySelector(".toggle-password i");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
    </script>

</body>
</html>
