<!-- http://204.216.213.176/inf3php/ES05/login/es01.php -->
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Effettua il login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        .eye-icon {
            cursor: pointer;
            transition: opacity 0.2s;
        }
        .eye-icon:hover {
            opacity: 0.7;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow-sm">
        <!-- Titolo -->
        <div class="text-center">
            <h2 class="text-2xl font-semibold text-gray-900 mb-8">Effettua il login</h2>
        </div>

        <!-- Form di login -->
        <form class="space-y-6" action="login_process.php" method="POST" id="loginForm">
            <!-- Campo E-mail -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-600 mb-2">E-mail</label>
                <input 
                    id="email" 
                    name="email" 
                    type="email" 
                    required 
                    class="w-full px-3 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="filippo.bilardo@tiscali.it"
                    value="filippo.bilardo@tiscali.it"
                >
            </div>

            <!-- Campo Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-600 mb-2">Password</label>
                <div class="relative">
                    <input 
                        id="password" 
                        name="password" 
                        type="password"
                        required 
                        class="w-full px-3 py-3 pr-10 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        value="........"
                    >
                    <button 
                        type="button" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center eye-icon"
                        onclick="togglePassword()"
                    >
                        <svg id="eyeIcon" class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Link Password dimenticata -->
            <div class="text-left">
                <a href="#" class="text-blue-600 hover:text-blue-500 text-sm">Password smarrita?</a>
            </div>

            <!-- reCAPTCHA -->
            <div class="flex items-center space-x-3">
                <div class="flex items-center">
                    <input 
                        id="recaptcha-checkbox" 
                        type="checkbox" 
                        class="h-6 w-6 text-green-600 focus:ring-green-500 border-gray-300 rounded"
                        onchange="toggleRecaptcha()"
                    >
                    <label for="recaptcha-checkbox" class="ml-3 text-sm text-gray-700">Non sono un robot</label>
                </div>
                <div class="flex flex-col items-center">
                    <img src="/api/placeholder/40/40" alt="reCAPTCHA" class="w-10 h-10">
                    <div class="text-xs text-gray-500 mt-1">
                        <div>reCAPTCHA</div>
                        <div class="text-xs">Privacy - Termini</div>
                    </div>
                </div>
            </div>

            <!-- Pulsante Accedi -->
            <div>
                <button 
                    type="submit" 
                    id="loginButton"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-full text-sm font-medium text-white bg-blue-900 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200"
                    disabled
                >
                    ACCEDI
                </button>
            </div>
        </form>

        <!-- Separatore e link registrazione -->
        <div class="text-center mt-8">
            <p class="text-gray-600 mb-4">Sei un nuovo utente?</p>
            <a 
                href="register.php" 
                class="inline-flex justify-center py-3 px-8 border border-gray-300 rounded-full text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
            >
                REGISTRATI
            </a>
        </div>
    </div>

    <script>
        // Funzione per mostrare/nascondere la password
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L8.464 8.464M14.12 14.12l1.415 1.415M14.12 14.12L9.88 9.88"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18"></path>
                `;
            } else {
                passwordField.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                `;
            }
        }

        // Funzione per gestire il reCAPTCHA
        function toggleRecaptcha() {
            const checkbox = document.getElementById('recaptcha-checkbox');
            const loginButton = document.getElementById('loginButton');
            
            loginButton.disabled = !checkbox.checked;
        }

        // Validazione del form
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const recaptcha = document.getElementById('recaptcha-checkbox').checked;
            
            if (!email || !password) {
                e.preventDefault();
                alert('Inserisci email e password');
                return false;
            }
            
            if (!recaptcha) {
                e.preventDefault();
                alert('Completa il reCAPTCHA');
                return false;
            }
            
            // Qui puoi aggiungere ulteriore logica di validazione
            console.log('Form inviato con:', { email, password });
        });

        // Gestione responsive del form
        window.addEventListener('resize', function() {
            // Eventuale logica per adattamenti responsive
        });
    </script>

    <?php
    // Parte PHP per la gestione del login
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sanitizzazione e validazione dei dati
        $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'] ?? '';
        
        // Validazione email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Email non valida";
        }
        
        // Validazione password (esempio base)
        if (strlen($password) < 6) {
            $error = "La password deve essere di almeno 6 caratteri";
        }
        
        // Se non ci sono errori, procedi con l'autenticazione
        if (!isset($error)) {
            // Qui inseriresti la logica per verificare le credenziali nel database
            // Esempio di controllo (da sostituire con query al database)
            if ($email === 'filippo.bilardo@tiscali.it' && $password === 'password123') {
                session_start();
                $_SESSION['user_email'] = $email;
                $_SESSION['logged_in'] = true;
                
                // Redirect alla dashboard o pagina protetta
                header('Location: dashboard.php');
                exit;
            } else {
                $error = "Credenziali non valide";
            }
        }
        
        // Se ci sono errori, li visualizzi
        if (isset($error)) {
            echo "<script>alert('$error');</script>";
        }
    }
    ?>
</body>
</html>