<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugasaurus - Your Friendly Task Manager</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f0f2f5;
        }

        .navbar {
            background-color: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #4a90e2;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.5rem 1.5rem;
            border-radius: 20px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-login {
            background-color: transparent;
            color: #4a90e2;
            border: 2px solid #4a90e2;
        }

        .btn-register {
            background-color: #4a90e2;
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .hero {
            margin-top: 80px;
            padding: 4rem 2rem;
            text-align: center;
        }

        .hero h1 {
            font-size: 3rem;
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.2rem;
            color: #7f8c8d;
            margin-bottom: 2rem;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-card {
            background-color: white;
            padding: 2rem;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .feature-card img {
            width: 200px;
            height: 200px;
            margin-bottom: 1rem;
        }

        .feature-card h3 {
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .feature-card p {
            color: #7f8c8d;
        }

        .cta {
            text-align: center;
            padding: 4rem 2rem;
            background-color: #4a90e2;
            color: white;
            margin-top: 2rem;
        }

        .cta h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .cta p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        .btn-cta {
            background-color: white;
            color: #4a90e2;
            font-size: 1.2rem;
            padding: 1rem 3rem;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }
            
            .features {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="path/to/logo.png" alt="Tugasaurus Logo">
        </div>        
        <div class="nav-buttons">
            <a href="{{ route('login') }}" class="btn btn-login">Login</a>
            <a href="{{ route('register') }}" class="btn btn-register">Start for Free</a>
        </div>
        
    </nav>

    <section class="hero">
        <h1>Manage Your Tasks with Dino-mite Style! 🦕</h1>
        <p>Tugasaurus makes task management fun and efficient with our friendly dinosaur companions</p>
        <img src="/api/placeholder/400/300" alt="Dino mascot" data-aos="fade-up">
    </section>

    <div class="features">
        <div class="feature-card" data-aos="fade-up">
            <img src="/api/placeholder/200/200" alt="Task organization">
            <h3>Smart Task Organization</h3>
            <p>Organize your tasks efficiently with our intuitive dinosaur-themed interface</p>
        </div>
        <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
            <img src="/api/placeholder/200/200" alt="Collaboration">
            <h3>Team Collaboration</h3>
            <p>Work together with your team members like a pack of friendly velociraptors</p>
        </div>
        <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
            <img src="/api/placeholder/200/200" alt="Reminders">
            <h3>Smart Reminders</h3>
            <p>Never miss a deadline with our T-Rex reminder system that roars when tasks are due</p>
        </div>
    </div>

    <section class="cta">
        <h2>Ready to Start Your Prehistoric Adventure?</h2>
        <p>Join thousands of users who are already managing their tasks with Tugasaurus</p>
        <button class="btn btn-cta">Start for Free</button>
    </section>

    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
</body>
</html>