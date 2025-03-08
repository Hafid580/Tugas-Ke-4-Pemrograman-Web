<?php
session_start();

// Cek apakah pengguna sudah login dan sudah mengisi form
if (!isset($_SESSION['user_email']) || !isset($_SESSION['form_data'])) {
    header("Location: Login.php");
    exit();
}

$data = $_SESSION['form_data'];

// Fungsi untuk memformat bulan dan tahun
function formatMonthYear($date) {
    if (empty($date)) return "Present";
    $dateObj = DateTime::createFromFormat('Y-m', $date);
    return $dateObj ? $dateObj->format('F Y') : "Invalid Date";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculum Vitae</title>
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
            padding: 2rem;
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

        .cv-container {
            max-width: 800px;
            width: 100%;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.18);
            padding: 2.5rem;
            color: white;
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .header h1 {
            font-size: 2.5rem;
            color: white;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .header p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .section {
            margin-bottom: 2rem;
        }

        .section h2 {
            color: white;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .section p {
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
        }

        .section ul {
            list-style-type: none;
            padding: 0;
        }

        .section ul li {
            background: rgba(255, 255, 255, 0.1);
            padding: 0.8rem;
            margin-bottom: 0.5rem;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .section ul li:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(5px);
        }

        .education-item, .experience-item {
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .education-item:hover, .experience-item:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-5px);
        }

        .education-item h3, .experience-item h3 {
            color: white;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .education-item p, .experience-item p {
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 0.5rem;
        }

        .education-item span, .experience-item span {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }
            
            .cv-container {
                padding: 1.5rem;
            }
            
            .header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="cv-container">
        <div class="header">
            <h1><?php echo htmlspecialchars($data['name']); ?></h1>
            <p><?php echo htmlspecialchars($data['birth_place']); ?> | <?php echo htmlspecialchars($data['date']); ?></p>
            <p>Phone: <?php echo htmlspecialchars($data['phone']); ?></p>
        </div>

        <div class="section">
            <h2>About Me</h2>
            <p><?php echo htmlspecialchars($data['about']); ?></p>
        </div>

        <div class="section">
            <h2>Contact Information</h2>
            <ul>
                <li>Phone: <?php echo htmlspecialchars($data['phone']); ?></li>
                <li>Place of Birth: <?php echo htmlspecialchars($data['birth_place']); ?></li>
                <li>Date of Birth: <?php echo htmlspecialchars($data['date']); ?></li>
            </ul>
        </div>
        
        <div class="section">
            <h2>Education History</h2>
            <div class="education-item">
                <h3>Senior High School</h3>
                <p><?php echo htmlspecialchars($data['school'][0]); ?></p>
                <span>
                    <?php echo formatMonthYear($data['start_date'][0]); ?> - 
                    <?php echo formatMonthYear($data['end_date'][0]); ?>
                </span>
            </div>

        <div class="education-item">
                <h3>University</h3>
                <p><?php echo htmlspecialchars($data['school'][1]); ?></p>
                <span>
                    <?php echo formatMonthYear($data['start_date'][1]); ?> - 
                    <?php echo formatMonthYear($data['end_date'][1]); ?>
                </span>
            </div>
        </div>

    </div>
</body>
</html>