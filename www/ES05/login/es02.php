<!-- http://204.216.213.176/inf3php/ES05/login/es02.php -->
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm">
        <h1 class="text-2xl font-semibold text-center text-gray-700 mb-6">Effettua il login</h1>

        <form action="#" method="POST">
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 sr-only">E-mail</label>
                <input type="email" id="email" name="email" placeholder="filippo.bilardo@tiscali.it" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="filippo.bilardo@tiscali.it">
            </div>

            <div class="mb-4 relative">
                <label for="password" class="block text-sm font-medium text-gray-700 sr-only">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="••••••••">
                <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                    <i class="fas fa-eye text-gray-500"></i>
                </button>
            </div>

            <div class="mb-4">
                <a href="#" class="text-sm text-indigo-600 hover:text-indigo-500">Password smarrita?</a>
            </div>

            <div class="mb-6 p-3 border border-gray-300 rounded-md flex items-center justify-between bg-gray-50">
                <div class="flex items-center">
                    <input id="robot-checkbox" type="checkbox" class="h-5 w-5 text-green-500 border-gray-300 rounded focus:ring-green-400" checked>
                    <label for="robot-checkbox" class="ml-2 text-sm text-gray-700">Non sono un robot</label>
                </div>
                <div class="text-xs text-gray-500 text-center">
                    <img src="https://www.gstatic.com/recaptcha/api2/logo_48.png" alt="reCAPTCHA logo" class="h-8 w-8 mx-auto mb-1">
                    <p class="text-xxs">reCAPTCHA</p>
                    <p class="text-xxs_tight"><a href="#" class="hover:underline">Privacy</a> - <a href="#" class="hover:underline">Termini</a></p>
                </div>
            </div>


            <div>
                <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-full shadow-sm text-sm font-medium text-white bg-indigo-900 hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    ACCEDI
                </button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">Sei un nuovo utente?</p>
            <button type="button" class="w-full mt-2 flex justify-center py-2.5 px-4 border border-gray-300 rounded-full shadow-sm text-sm font-medium text-indigo-900 bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                REGISTRATI
            </button>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const robotCheckbox = document.getElementById('robot-checkbox');

        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.querySelector('i').classList.toggle('fa-eye-slash');
            this.querySelector('i').classList.toggle('fa-eye');
        });

        // Ensure the "Non sono un robot" checkbox is checked by default
        // and cannot be unchecked by the user for visual representation.
        // For a real reCAPTCHA, you would use Google's API.
        robotCheckbox.addEventListener('click', function(e) {
            e.preventDefault();
            this.checked = true;
        });
        robotCheckbox.checked = true; // Ensure it's checked on load
    </script>
</body>
</html>