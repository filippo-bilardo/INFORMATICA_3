<!-- http://204.216.213.176/inf3php/ES05/login/es05.php -->
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Effettua il login</title>
    <style>
        body {
            background-color: #f9fafb;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 16px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            margin: 0;
        }

        #login-container {
            max-width: 448px;
            width: 100%;
            background: white;
            padding: 32px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        #login-title {
            text-align: center;
            font-size: 24px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 32px;
        }

        #login-form {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        #email-container, #password-container {
            position: relative;
        }

        #email, #password {
            width: 100%;
            padding: 24px 12px 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 16px;
            outline: none;
            box-sizing: border-box;
        }

        #email:focus, #password:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
        }

        #password {
            padding-right: 40px;
        }

        #email-label, #password-label {
            position: absolute;
            left: 12px;
            top: 8px;
            font-size: 12px;
            color: #6b7280;
            pointer-events: none;
        }

        #password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
        }

        #password-toggle:hover {
            opacity: 0.7;
        }

        #eye-icon {
            width: 20px;
            height: 20px;
            color: #9ca3af;
        }

        #forgot-password {
            text-align: left;
        }

        #forgot-password a {
            color: #3b82f6;
            text-decoration: none;
            font-size: 14px;
        }

        #forgot-password a:hover {
            color: #2563eb;
        }

        #recaptcha-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        #recaptcha-checkbox {
            width: 24px;
            height: 24px;
            accent-color: #16a34a;
        }

        #recaptcha-label {
            font-size: 14px;
            color: #374151;
        }

        #recaptcha-info {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #recaptcha-logo {
            width: 40px;
            height: 40px;
        }

        #recaptcha-text {
            font-size: 10px;
            color: #6b7280;
            margin-top: 4px;
            text-align: center;
        }

        #login-button {
            width: 100%;
            padding: 12px 16px;
            border: none;
            border-radius: 24px;
            font-size: 14px;
            font-weight: 500;
            color: white;
            background-color: #1e3a8a;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        #login-button:hover:not(:disabled) {
            background-color: #1e40af;
        }

        #login-button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        #register-section {
            text-align: center;
            margin-top: 32px;
        }

        #register-text {
            color: #6b7280;
            margin-bottom: 16px;
        }

        #register-button {
            display: inline-flex;
            justify-content: center;
            padding: 12px 32px;
            border: 1px solid #d1d5db;
            border-radius: 24px;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            background: white;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        #register-button:hover {
            background-color: #f9fafb;
        }
    </style>
</head>
<body>
    <div id="login-container">
        <!-- Titolo -->
        <div id="login-title">Effettua il login</div>

        <!-- Form di login -->
        <form id="login-form" action="login_process.php" method="POST">
            <!-- Campo E-mail -->
            <div id="email-container">
                <input 
                    id="email" 
                    name="email" 
                    type="email" 
                    required 
                    value="filippo.bilardo@tiscali.it"
                >
                <label id="email-label" for="email">E-mail</label>
            </div>

            <!-- Campo Password -->
            <div id="password-container">
                <input 
                    id="password" 
                    name="password" 
                    type="password"
                    required 
                    value="........"
                >
                <label id="password-label" for="password">Password</label>
                <button 
                    type="button" 
                    id="password-toggle"
                    onclick="togglePassword()"
                >
                    <svg id="eye-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </button>
            </div>

            <!-- Link Password dimenticata -->
            <div id="forgot-password">
                <a href="#">Password smarrita?</a>
            </div>

            <!-- reCAPTCHA -->
            <div id="recaptcha-container">
                <div>
                    <input 
                        id="recaptcha-checkbox" 
                        type="checkbox" 
                        onchange="toggleRecaptcha()"
                    >
                    <label id="recaptcha-label" for="recaptcha-checkbox">Non sono un robot</label>
                </div>
                <div id="recaptcha-info">
                    <img id="recaptcha-logo" src="/api/placeholder/40/40" alt="reCAPTCHA">
                    <div id="recaptcha-text">
                        <div>reCAPTCHA</div>
                        <div>Privacy - Termini</div>
                    </div>
                </div>
            </div>

            <!-- Pulsante Accedi -->
            <div>
                <button 
                    type="submit" 
                    id="login-button"
                    disabled
                >
                    ACCEDI
                </button>
            </div>
        </form>

        <!-- Separatore e link registrazione -->
        <div id="register-section">
            <p id="register-text">Sei un nuovo utente?</p>
            <a id="register-button" href="register.php">REGISTRATI</a>
        </div>
    </div>

    <script>
        // Funzione per mostrare/nascondere la password
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
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
            const loginButton = document.getElementById('login-button');
            
            loginButton.disabled = !checkbox.checked;
        }

        // Validazione del form
        document.getElementById('login-form').addEventListener('submit', function(e) {
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
            
            console.log('Form inviato con:', { email, password });
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
        //if (isset($error) {
        //    echo "<script>alert('$error');</script>";
        //}
    }
    ?>
</body>
</html>