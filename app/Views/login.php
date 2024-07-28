<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .form-group {
            position: relative;
        }
        .form-group input {
            width: 100%;
            padding-right: 40px;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
            cursor: pointer;
            outline: none;
        }
        .toggle-password:focus {
            outline: none !important;
            box-shadow: none !important;
        }
        .toggle-password svg {
            width: 24px;
            height: 24px;
            color: #6c757d;
            transition: opacity 0.3s ease, transform 0.3s ease;
            position: absolute;
            border: none;
            top: -12px;
            right: 0px;
        }
        .toggle-password .hidden {
            opacity: 0;
            transform: scale(0.5);
        }
        .toggle-password .visible {
            opacity: 1;
            transform: scale(1);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Sign In</h2>
        <!-- Display Success and Error Messages -->
        <?php if (isset($status)): ?>
            <div class="alert alert-success">
                <p><?= esc($status) ?></p>
            </div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <p><?= esc($error) ?></p>
            </div>
        <?php endif; ?>
        
        <form action="<?= base_url('login/authenticate') ?>" method="post">
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                <button type="button" id="toggleEye" class="toggle-password focus:outline-none">
                    <svg id="eyeOpen" class="hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3C6.48 3 2 12 2 12s4.48 9 10 9 10-9 10-9-4.48-9-10-9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5z" />
                    </svg>
                    <svg id="eyeClosed" class="visible" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12s2-5 9-5 9 5 9 5-2 5-9 5-9-5-9-5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12h.01M9 12h.01M3 3l18 18" />
                    </svg>
                </button>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            <a href="<?= base_url('signup') ?>" class="btn btn-link btn-block">Sign Up</a>
        </form>
    </div>

    <script>
        const toggleEye = document.getElementById('toggleEye');
        const eyeOpen = document.getElementById('eyeOpen');
        const eyeClosed = document.getElementById('eyeClosed');
        const passwordInput = document.getElementById('password');

        toggleEye.addEventListener('click', () => {
            if (eyeOpen.classList.contains('visible')) {
                eyeOpen.classList.remove('visible');
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
                eyeClosed.classList.add('visible');
                passwordInput.type = 'password';
            } else {
                eyeOpen.classList.remove('hidden');
                eyeOpen.classList.add('visible');
                eyeClosed.classList.remove('visible');
                eyeClosed.classList.add('hidden');
                passwordInput.type = 'text';
            }
        });
    </script>
</body>
</html>
