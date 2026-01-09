


<?php
// Start the session
session_start();

// Check if user is already logged in, redirect to dashboard
if (isset($_SESSION['username'])) {
    header("Location: udashboard.php");
    exit;
}

// Handle Login Logic
$error_message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Changed from email to username
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

    // In a real app, check database here. 
    // For this demo, we accept any non-empty input.
    if (!empty($username) && !empty($password)) {
        // Set session variables directly using the username provided
        $_SESSION['username'] = ucfirst($username); // Capitalize first letter
        
        // Redirect to Dashboard
        header("Location: udashboard.php");
        exit;
    } else {
        $error_message = "Please enter both username and password.";
    }
}
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Login - TaskMaster</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "primary": "#137fec",
                    "primary-hover": "#0f6bd1",
                    "background-light": "#f6f7f8",
                    "background-dark": "#101922",
                    "surface-light": "#ffffff",
                    "surface-dark": "#1a2632",
                    "text-main": "#0d141b",
                    "text-secondary": "#4c739a",
                    "border-light": "#e7edf3",
                    "border-dark": "#2a3b4d"
                },
                fontFamily: {
                    "display": ["Inter", "sans-serif"],
                    "body": ["Inter", "sans-serif"]
                },
                borderRadius: {
                    "DEFAULT": "0.25rem",
                     "lg": "0.5rem",
                    "xl": "0.75rem",
                },
            },
        },
    }
</script>
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-text-main dark:text-white antialiased flex items-center justify-center min-h-screen p-4">

<div class="w-full max-w-md">
    <!-- Logo Area -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center rounded-lg bg-primary/10 p-3 text-primary mb-4">
            <span class="material-symbols-outlined text-4xl">check_box</span>
        </div>
        <h1 class="text-2xl font-bold text-text-main dark:text-white">TaskMaster</h1>
        <p class="text-sm text-text-secondary mt-1">Sign in to your workspace</p>
    </div>
    <div class="rounded-xl border border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark p-8 shadow-lg">
        
        <?php if ($error_message): ?>
            <div class="mb-4 p-3 rounded bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">error</span>
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="ulogin.php" class="space-y-5">
            <div>
                <!-- Updated Label to Username -->
                <label for="username" class="block text-sm font-medium text-text-main dark:text-white mb-1.5">Username</label>
                <div class="relative">
                    <!-- Updated Icon to 'person' -->
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-text-secondary text-xl">person</span>
                    <!-- Updated Input Type and Name -->
                    <input type="text" id="username" name="username" required 
                           class="w-full h-11 pl-10 pr-4 rounded-lg border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-sm text-text-main dark:text-white placeholder-text-secondary focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none transition-all"
                           placeholder="Enter your username">
                </div>
            </div>

            <div>
                  <div class="flex items-center justify-between mb-1.5">
                    <label for="password" class="block text-sm font-medium text-text-main dark:text-white">Password</label>
                    <a href="#" class="text-xs font-medium text-primary hover:text-primary-hover">Forgot password?</a>
                </div>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-text-secondary text-xl">lock</span>
                    <input type="password" id="password" name="password" required 
                           class="w-full h-11 pl-10 pr-4 rounded-lg border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-sm text-text-main dark:text-white placeholder-text-secondary focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none transition-all"
                           placeholder="••••••••">
                </div>
            </div>

            <div class="flex items-center">
                <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded border-border-light text-primary focus:ring-primary/50 cursor-pointer">
                <label for="remember-me" class="ml-2 block text-sm text-text-secondary dark:text-gray-400 cursor-pointer">Remember me</label>
            </div>

            <button type="submit" 
                    class="w-full flex items-center justify-center gap-2 rounded-lg bg-primary py-3 px-4 text-white font-semibold hover:bg-primary-hover transition-colors shadow-sm shadow-blue-200 dark:shadow-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                <span class="material-symbols-outlined text-[20px]">login</span>
                Sign In
            </button>
        </form>
        <div class="mt-6 pt-6 border-t border-border-light dark:border-border-dark text-center">
            <p class="text-sm text-text-secondary">
                Don't have an account? 
                <a href="#" class="font-medium text-primary hover:text-primary-hover transition-colors">Sign up</a>
            </p>
        </div>
    </div>

    <p class="mt-8 text-center text-xs text-text-secondary">
        © 2023 TaskMaster Inc. All rights reserved.
    </p>
</div>

</body>
</html>
```