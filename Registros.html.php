<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="rg.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Registrar Empleado</title>
    <style>
        .toggle-password {
            cursor: pointer;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <h1>Registrar Empleado</h1>
    
    <form action="registro.php" method="POST">
        <ul>
            <li>
                <label for="Nombre">Nombre:</label>
                <input type="text" id="Nombre" name="Nombre" placeholder="Nombre" required />
            </li>
            <li>
                <label for="Apellido">Apellido:</label>
                <input type="text" id="Apellido" name="Apellido" placeholder="Apellido" required />
            </li>
            <li>
                <label for="Telefono">Teléfono:</label>
                <input type="text" id="Telefono" name="Telefono" placeholder="Teléfono" required />
            </li>
            <li>
                <label for="rol">Rol:</label>
                <select name="Rol" id="Rol" required>
                    <option value="">Selecciona un rol</option>
                    <option value="2">Administrador</option>
                    <option value="1">Empleado</option>
                </select>
            </li>
            <li>
                <label for="Actividad">Actividad:</label>
                <select name="Actividad" id="Actividad">
                    <option value="Actividad">Selecciona una actividad</option>
                    <option value="Maquina">Máquina</option>
                    <option value="Corte">Corte</option>
                    <option value="Empaque">Empaque</option>
                </select>
            </li>
            <li>
                <label for="Clave">Contraseña:</label>
                <input type="password" id="Clave" name="Clave" placeholder="Contraseña" required />
                <span class="toggle-password" id="togglePassword">🔒</span>
            </li>    
            <li>
            <button onclick="window.location.href='empleado.php'" name="boton" >Registrar</button>
            </li>
        </ul>
    </form>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordField = document.querySelector('#Clave');

        togglePassword.addEventListener('click', function (e) {
            // Alterna entre los tipos de input "password" y "text"
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            // Alterna el emoji
            this.textContent = type === 'password' ? '🔒' : '👁️';
        });
    </script>
</body>
</html>


