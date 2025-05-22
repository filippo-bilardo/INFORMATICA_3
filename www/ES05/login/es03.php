<!-- http://204.216.213.176/inf3php/ES05/login/es03.php -->
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
        /* Stile per mantenere l'etichetta in alto quando l'input ha un valore o è in focus */
        .input-container input:not(:placeholder-shown) + label,
        .input-container input:focus + label {
            transform: translateY(-1.1rem) scale(0.85);
            color: #4a5568; /* Colore grigio scuro per l'etichetta attiva */
        }
        .input-container label {
            transition: all 0.2s ease-out;
            transform-origin: left top;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm">
        <h1 class="text-2xl font-semibold text-center text-gray-700 mb-6">Effettua il login</h1>

        <form action="#" method="POST">
            <div class="relative mb-6 input-container border border-gray-300 rounded-md shadow-sm bg-gray-50">
                <input type="email" id="email" name="email" placeholder=" " class="block w-full px-3 pt-5 pb-2 text-sm text-gray-900 bg-transparent focus:outline-none focus:ring-0 peer" value="filippo.bilardo@tiscali.it">
                <label for="email" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-3 scale-75 top-4 z-10 origin-[0] start-3 peer-focus:text-indigo-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-3">E-mail</label>
            </div>

            <div class="relative mb-4 input-container border border-gray-300 rounded-md shadow-sm bg-gray-50">
                <input type="password" id="password" name="password" placeholder=" " class="block w-full px-3 pt-5 pb-2 text-sm text-gray-900 bg-transparent focus:outline-none focus:ring-0 peer" value="••••••••">
                <label for="password" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-3 scale-75 top-4 z-10 origin-[0] start-3 peer-focus:text-indigo-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-3">Password</label>
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
        const passwordInput = document.getElementById('password'); // Rinominato per chiarezza
        const robotCheckbox = document.getElementById('robot-checkbox');

        togglePassword.addEventListener('click', function (e) {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye-slash');
            this.querySelector('i').classList.toggle('fa-eye');
        });

        robotCheckbox.addEventListener('click', function(e) {
            e.preventDefault();
            this.checked = true;
        });
        robotCheckbox.checked = true;

        // Script per gestire il comportamento delle etichette flottanti (opzionale, Tailwind gestisce molto con peer-*)
        // Potrebbe non essere strettamente necessario con l'approccio Tailwind 'peer' ma può dare più controllo
        // o essere utile se si tolgono le classi 'peer-*'
        document.querySelectorAll('.input-container input').forEach(inputElement => {
            const labelElement = inputElement.nextElementSibling; // Assume che l'etichetta sia il prossimo sibling
            if (labelElement && labelElement.tagName === 'LABEL') {
                 if (inputElement.value) {
                    labelElement.classList.add('label-floated');
                 }
                inputElement.addEventListener('focus', () => {
                    labelElement.classList.add('label-floated');
                });
                inputElement.addEventListener('blur', () => {
                    if (!inputElement.value) {
                        labelElement.classList.remove('label-floated');
                    }
                });
            }
        });

        // Aggiungiamo uno stile CSS per la classe 'label-floated' se si usa lo script JS qui sopra
        const styleSheet = document.createElement("style");
        styleSheet.type = "text/css";
        styleSheet.innerText = `.label-floated { transform: translateY(-1.1rem) scale(0.85); color: #4a5568; }`; // Mantieni questi stili coerenti
        document.head.appendChild(styleSheet);

    </script>
</body>
</html>