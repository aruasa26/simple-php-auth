<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Register</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://cdn.tailwindcss.com"></script>

    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#f8f4f3]">
                <div>
                    <a href="/"></a>
                        <h2 class="font-bold text-3xl">CREATE <span class="bg-[#f84525] text-white px-2 rounded-md">ACCOUNT</span></h2>
                    </a>
                </div>

                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    <?php if (isset($_SESSION['errors'])): ?>
                        <div class="mb-4">
                            <?php foreach ($_SESSION['errors'] as $error): ?>
                                <div class="text-red-500 text-sm"><?php echo htmlspecialchars($error); ?></div>
                            <?php endforeach; ?>
                            <?php unset($_SESSION['errors']); // Clear errors after displaying ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="register.process.php">

                        <div class="py-8">
                            <center>
                                <span class="text-2xl font-semibold">Register</span>
                            </center>
                        </div>

                        <div class="mt-4">
                            <label class="block font-medium text-sm text-gray-700" for="email">Email</label>
                            <input type='email' 
                                name='email'
                                placeholder='Email'
                                class="w-full rounded-md py-2.5 px-4 border text-sm outline-[#f84525]" />                   
                        </div>

                        <div class="mt-4">
                            <label class="block font-medium text-sm text-gray-700" for="password">Password</label>
                            <div class="relative">
                                <input id="password" type="password" name="password" placeholder="Password" required autocomplete="new-password" class = 'w-full rounded-md py-2.5 px-4 border text-sm outline-[#f84525]'>

                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                    <button type="button" id="togglePassword" class="text-gray-500 focus:outline-none focus:text-gray-600 hover:text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.274.823-.642 1.6-1.086 2.3M15 12a3 3 0 01-6 0m6 0a3 3 0 01-6 0m6 0a3 3 0 01-6 0" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a class="hover:underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="login.php">
                                Already registered?
                            </a>

                            <button type="submit" class = 'ms-4 inline-flex items-center px-4 py-2 bg-[#f84525] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-800 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'>
                                Register
                            </button>
                        </div>
                        
                    </form>                
                </div>
            </div>
        </div>

    <script>
        const passwordInput = document.getElementById('password');
        const togglePasswordButton = document.getElementById('togglePassword');

        togglePasswordButton.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        });
    </script>   

    </body>
</html>