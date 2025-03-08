<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: Login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['form_data'] = $_POST;
    header("Location: CV.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Personal Information Form</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            min-height: 100vh;
            background: url('https://images.unsplash.com/photo-1497864149936-d3163f0c0f4b?ixlib=rb-1.2.1') center/cover;
            position: relative;
            overflow: auto;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 1rem;
        }

        body::before {
            content: '';
            position: fixed;
            width: 100%;
            height: 100%;
            background: inherit;
            filter: blur(10px) brightness(0.8);
            z-index: -1;
        }

        .box {
            max-width: 600px;
            width: 90%;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.18);
            padding: 1.5rem;
            color: white;
            margin: 1rem 0;
        }

        h1 {
            text-align: center;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            position: relative;
        }

        h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #6366f1, #8b5cf6);
            border-radius: 2px;
        }

        .form-section {
            margin-bottom: 1.5rem;
        }

        h3 {
            color: white;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 1rem;
        }

        .input-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        input, textarea {
            width: 100%;
            padding: 0.7rem 1rem;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: rgba(99, 102, 241, 0.8);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        input::placeholder, textarea::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .education-item {
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .education-item h4 {
            color: white;
            margin-bottom: 0.8rem;
            font-size: 0.95rem;
            font-weight: 600;
        }

        button {
            width: 100%;
            padding: 0.8rem;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.8), rgba(139, 92, 246, 0.8));
            color: white;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            font-size: 0.9rem;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        @media (max-width: 768px) {
            body {
                padding: 0.5rem;
            }
            
            .box {
                padding: 1rem;
                max-width: 90%;
            }
            
            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="box" id="Form">
        <h1>Personal Information</h1>
        <form method="POST">
            <div class="form-section">
                <h3>About Me</h3>
                <div class="input-group">
                    <label for="about">Tell us about yourself:</label>
                    <textarea id="about" name="about" required></textarea>
                </div>
            </div>

            <div class="form-section">
                <h3>Personal Details</h3>
                <div class="input-group">
                    <label for="name">Full Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                
                <div class="input-group">
                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                
                <div class="input-group">
                    <label for="birth_place">Place of Birth:</label>
                    <input type="text" id="birth_place" name="birth_place" required>
                </div>
                
                <div class="input-group">
                    <label for="date">Date of Birth:</label>
                    <input type="date" id="date" name="date" required>
                </div>
            </div>

            <div class="form-section">
                <h3>Education History</h3>
                <div class="education-item">
                    <h4>Senior High School</h4>
                    <div class="input-group">
                        <label>School Name:</label>
                        <input type="text" name="school[]">
                    </div>
                    
                    <div class="input-group">
                        <label>Start Date:</label>
                        <input type="month" name="start_date[]">
                    </div>
                    
                    <div class="input-group">
                        <label>End Date:</label>
                        <input type="month" name="end_date[]">
                    </div>
                </div>

                <div class="education-item">
                    <h4>University</h4>
                    <div class="input-group">
                        <label>University Name:</label>
                        <input type="text" name="school[]">
                    </div>
                    
                    <div class="input-group">
                        <label>Start Date:</label>
                        <input type="month" name="start_date[]">
                    </div>
                    
                    <div class="input-group">
                        <label>End Date:</label>
                        <input type="month" name="end_date[]">
                    </div>
                </div>
            </div>

            <button type="submit">Generate CV</button>
        </form>
    </div>
</body>
</html>