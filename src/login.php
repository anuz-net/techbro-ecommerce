<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <style>
        .container {
            width: 100%;
            height: 100%;
            --color: rgba(225, 225, 225, 0.1);
            background-color: #F3F3F3;
            background-image: linear-gradient(0deg, transparent 24%, var(--color) 25%, var(--color) 26%, transparent 27%, transparent 74%, var(--color) 75%, var(--color) 76%, transparent 77%, transparent),
                linear-gradient(90deg, transparent 24%, var(--color) 25%, var(--color) 26%, transparent 27%, transparent 74%, var(--color) 75%, var(--color) 76%, transparent 77%, transparent);
            background-size: 55px 55px;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center container">
    <div class="border border-gray-100 shadow w-full max-w-md mx-4 p-6 md:p-10 rounded-md bg-white">
        <div class="flex flex-col sm:flex-row sm:justify-between gap-4 text-sm">
            <div class="flex items-center gap-2">
                <img src="Image/logo.png" class="h-6 w-auto" alt="Logo" />
            </div>
        </div>

        <div class="mt-8 md:mt-10">
            <h1 class="text-xl md:text-2xl font-semibold">
                Login Into Your Account
            </h1>
        </div>

        <p class="text-sm mt-4">
            Please enter your email and password to login to your account.
        </p>

        <?php if(isset($_GET['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mt-4">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>
        
        <?php if(isset($_GET['success'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mt-4">
                <?php echo htmlspecialchars($_GET['success']); ?>
            </div>
        <?php endif; ?>

        <form action="auth.php" method="POST">
            <input type="hidden" name="action" value="login">
            <div class="mt-6">
                <input placeholder="Email" type="email" name="email" required
                    class="p-2 px-3 border-b-[2px] focus:border-red-400 w-full outline-none bg-white transition duration-300" />
                <input placeholder="Password" type="password" name="password" required
                    class="p-2 px-3 mt-3 border-b-[2px] focus:border-red-400 w-full outline-none bg-white transition duration-300" />
            </div>
            
            <div class="text-center sm:text-right mt-5">
                <p>
                    Don't have an account?
                    <a href="signup.html" class="font-semibold text-red-600 hover:underline">Sign Up</a>
                </p>
            </div>

            <button type="submit"
                class="bg-red-600 text-white text-sm h-10 w-full sm:w-[130px] rounded-md font-semibold mt-5 shadow-md hover:bg-red-700 transition duration-300 hover:scale-105">
                Login
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</body>

</html>