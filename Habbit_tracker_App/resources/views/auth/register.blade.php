<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Decorative circles */
        .circle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.7;
        }

        .circle1 {
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            top: -100px;
            right: -50px;
        }

        .circle2 {
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            bottom: -50px;
            right: 10%;
        }

        .circle3 {
            width: 150px;
            height: 150px;
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            top: 20%;
            right: 15%;
        }

        .circle4 {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #30cfd0 0%, #330867 100%);
            bottom: 15%;
            right: 8%;
        }

        .circle5 {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            top: 30%;
            right: 5%;
            opacity: 0.8;
        }

        .navbar {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            z-index: 100;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 24px;
            font-weight: 600;
            color: white;
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            transition: opacity 0.3s;
        }

        .nav-links a:hover {
            opacity: 0.8;
        }

        .btn-learn {
            padding: 8px 20px;
            border: 2px solid white;
            border-radius: 20px;
            color: white;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s;
        }

        .btn-learn:hover {
            background: white;
            color: #667eea;
        }

        .register-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 50px 50px;
            width: 100%;
            max-width: 500px;
            z-index: 10;
            position: relative;
            max-height: 90vh;
            overflow-y: auto;
        }

        h1 {
            text-align: center;
            color: #5a5a5a;
            font-size: 36px;
            margin-bottom: 10px;
            position: relative;
            display: inline-block;
            width: 100%;
        }

        h1::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #f093fb 0%, #f5576c 100%);
            margin: 10px auto;
            border-radius: 2px;
        }

        .welcome-text {
            text-align: center;
            color: #888;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .login-link {
            color: #f5576c;
            text-decoration: none;
            transition: opacity 0.3s;
        }

        .login-link:hover {
            opacity: 0.8;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        label {
            display: block;
            color: #999;
            font-size: 13px;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s;
            background: #fafafa;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #f5576c;
            background: white;
            box-shadow: 0 0 0 3px rgba(245, 87, 108, 0.1);
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 25px;
        }

        input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #f5576c;
        }

        .checkbox-label {
            color: #666;
            font-size: 13px;
            text-transform: none;
            letter-spacing: 0;
            margin: 0;
        }

        .terms-link {
            color: #f5576c;
            text-decoration: none;
        }

        .terms-link:hover {
            text-decoration: underline;
        }

        .btn-register {
            width: 100%;
            padding: 16px;
            background: linear-gradient(90deg, #f093fb 0%, #f5576c 100%);
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(245, 87, 108, 0.4);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .arrow-icon {
            font-size: 18px;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 15px 20px;
            }

            .nav-links {
                gap: 15px;
                font-size: 12px;
            }

            .register-container {
                margin: 20px;
                padding: 40px 30px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .circle {
                display: none;
            }
        }

        /* Custom scrollbar */
        .register-container::-webkit-scrollbar {
            width: 8px;
        }

        .register-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .register-container::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #f093fb 0%, #f5576c 100%);
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <!-- Decorative circles -->
    <div class="circle circle1"></div>
    <div class="circle circle2"></div>
    <div class="circle circle3"></div>
    <div class="circle circle4"></div>
    <div class="circle circle5"></div>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <span>Sweet Habits</span>
        </div>
        <div class="nav-links">
            <a href="#">Schedule A Demo</a>
            <a href="#" class="btn-learn">LEARN MORE</a>
            <a href="#">Blog</a>
            <a href="#">Login</a>
        </div>
    </nav>

    <!-- Register Form -->
    <div class="register-container">
        <h1>Register</h1>
        <p class="welcome-text">
            Create your account to access the Habit Sweets.<br>
            Already have an account? <a href="#" class="login-link">Login here</a>
        </p>

        <form id="registerForm">
            <div class="form-row">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName" required>
                </div>

                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName" required>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" required>
                </div>
            </div>

            <div class="checkbox-group">
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms" class="checkbox-label">
                    I agree to the <a href="#" class="terms-link">Terms & Conditions</a> and <a href="#" class="terms-link">Privacy Policy</a>
                </label>
            </div>

            <button type="submit" class="btn-register">
                <span class="arrow-icon">➜</span>
                Create Account
            </button>
        </form>
    </div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (password !== confirmPassword) {
                alert('Passwords do not match!');
                return;
            }

            const firstName = document.getElementById('firstName').value;
            const lastName = document.getElementById('lastName').value;
            const email = document.getElementById('email').value;
            const username = document.getElementById('username').value;
            const terms = document.getElementById('terms').checked;

            if (firstName && lastName && email && username && password && terms) {
                alert('Registration functionality would be implemented here!');
            }
        });

        // Add floating animation to circles
        const circles = document.querySelectorAll('.circle');
        circles.forEach((circle, index) => {
            const duration = 15 + (index * 3);
            circle.style.animation = `float ${duration}s ease-in-out infinite`;
        });

        // Add keyframes for floating animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes float {
                0%, 100% { transform: translateY(0) rotate(0deg); }
                50% { transform: translateY(-20px) rotate(5deg); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
