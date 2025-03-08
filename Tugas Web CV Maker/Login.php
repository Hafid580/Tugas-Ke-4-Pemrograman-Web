<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Format email tidak valid!'); window.location.href='Login.php';</script>";
        exit();
    }

    // Ambil domain
    $email_parts = explode('@', $email);
    if (count($email_parts) !== 2) {
        echo "<script>alert('Email tidak valid!'); window.location.href='Login.php';</script>";
        exit();
    }

    $domain = $email_parts[1];

    // Cek password sesuai dengan domain
    if ($password === $domain) {
        $_SESSION['user_email'] = $email;
        echo "<script>alert('Login berhasil!'); window.location.href='Form.php';</script>";
    } else {
        echo "<script>alert('Login gagal! Periksa email dan password Anda.'); window.location.href='Login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glassmorphism Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* Body Styling */
        body {
            min-height: 100vh;
            background: url('https://images.unsplash.com/photo-1497864149936-d3163f0c0f4b?ixlib=rb-1.2.1') center/cover;
            position: relative;
            overflow: hidden;
        }

        /* Background Overlay */
        body::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: inherit;
            filter: blur(15px) brightness(0.8);
            z-index: -1;
        }

        /* Container Styling */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* Glass Card */
        .glass-card {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px) saturate(180%);
            -webkit-backdrop-filter: blur(12px) saturate(180%);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
        }

        /* Welcome Message */
        .welcome-message {
            text-align: center;
            margin-bottom: 35px;
            color: white;
        }

        .welcome-message h2 {
            font-size: 2rem;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .welcome-message p {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        /* Form Elements */
        .input-group {
            margin-bottom: 25px;
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.8);
            font-size: 18px;
        }

        .input-field {
            width: 100%;
            padding: 14px 20px 14px 45px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 8px;
            color: white;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .input-field::placeholder {
            color: rgba(255,255,255,0.6);
        }

        .input-field:focus {
            outline: none;
            background: rgba(255,255,255,0.2);
            border-color: rgba(255,255,255,0.4);
            box-shadow: 0 0 8px rgba(255,255,255,0.2);
        }

        /* Button Styling */
        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, rgba(255,255,255,0.2), rgba(255,255,255,0.1));
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, rgba(255,255,255,0.25), rgba(255,255,255,0.15));
            box-shadow: 0 4px 15px rgba(255,255,255,0.1);
        }

        /* Footer Text */
        .footer-text {
            text-align: center;
            margin-top: 25px;
            color: rgba(255,255,255,0.8);
            font-size: 14px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .glass-card {
                padding: 30px;
                border-radius: 12px;
            }
            
            .welcome-message h2 {
                font-size: 1.75rem;
            }
            
            .input-field {
                padding: 12px 20px 12px 45px;
                font-size: 15px;
            }
            
            .btn-login {
                padding: 12px;
                font-size: 15px;
            }
        }

        @media (hover: none) {
            .glass-card:hover {
                transform: none;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="glass-card">
            <div class="welcome-message">
                <h2>Welcome Back</h2>
                <p>Please login to continue</p>
            </div>
            
            <form action="Login.php" method="POST">
                <div class="input-group">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" name="email" class="input-field" placeholder="Email Address" required>
                </div>
                
                <div class="input-group">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="password" class="input-field" placeholder="Password" required>
                </div>
                
                <button type="submit" class="btn-login">Sign In</button>
                
                <p class="footer-text">*Password is your email domain</p>
            </form>
        </div>
    </div>
</body>
</html>