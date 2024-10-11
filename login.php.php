<?php
session_start(); // Inicia la sesión

// Verifica si la variable de sesión 'Nombre' está configurada
if (isset($_SESSION['Nombre'])) {}
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="login.css">
    <script>
        function handleLogin(event) {
            event.preventDefault();

            const Rol = document.getElementById('Rol').value;
            const Actividad = document.getElementById('section').value;
            const Clave = document.getElementById('password').value;

            // Validación básica de campos
            if (Rol === '') {
                alert('Por favor, selecciona un rol');
                return;
            }

            if (Rol === '2') { // Administrador
                if (Clave.trim() === '') {
                    alert('Por favor, ingresa tu contraseña');
                    return;
                }
                // Aquí puedes redirigir al administrador a su página correspondiente
                alert('Iniciando sesión como Administrador');
                window.location.href = 'Administrador.html';
            } else if (Rol === '1') { // Empleado
                if (Actividad === '') {
                    alert('Por favor, selecciona una actividad');
                    return;
                }
                if (Clave.trim() === '') {
                    alert('Por favor, ingresa tu contraseña');
                    return;
                }
                // Aquí puedes redirigir al empleado a su página correspondiente según la actividad
                switch (Actividad) {
                    case 'maquina':
                        alert('Iniciando sesión como Empleado con actividad: Maquina');
                        window.location.href = 'maqui.php';
                        break;
                    case 'corte':
                        alert('Iniciando sesión como Empleado con actividad: Corte');
                        window.location.href = 'Corte.html';
                        break;
                    case 'empaque':
                        alert('Iniciando sesión como Empleado con actividad: Empaque');
                        window.location.href = 'em.html';
                        break;
                    default:
                        alert('Por favor, seleccione una actividad válida.');
                        break;
                }
            }
        }

        function toggleSection() {
            var role = document.getElementById("Rol").value;
            var sectionContainer = document.getElementById("section-container");

            if (role === "1") { // Empleado
                sectionContainer.style.display = "block";
            } else {
                sectionContainer.style.display = "none";
            }
        }

        window.onload = function() {
            document.getElementById("Rol").addEventListener("change", toggleSection);
            toggleSection(); 
        };

        function togglePassword() {
            var passwordField = document.getElementById("password");
            var passwordToggle = document.querySelector(".toggle-password");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                passwordToggle.textContent = "🙈"; // Cambia el ícono cuando se muestra la contraseña
            } else {
                passwordField.type = "password";
                passwordToggle.textContent = "👁️"; // Vuelve al ícono original
            }
        }
    </script>
</head>
<body>
    <div class="login-container">
        <img src="sabanas.jpg" alt="Logo" class="logo">
        <h1>Inicio de Sesión</h1>
        <form action="confirna.php" method="POST"  class="registro.php" onsubmit="handleLogin(event)">
            <div class="">
                <label for="username">Nombre de Usuario:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="">
                <label for="Telefonoo">Telefonoo:</label>
                <input type="text" id="Telefonoo" name="Telefonoo" required>
            </div>
            <div class="">
                <label for="Rol">Selecciona tu rol:</label>
                <select id="Rol" name="Rol" required>
                    <option value="1">Empleado</option>
                    <option value="2">Administrador</option>
                </select>
            </div>
            <div id="section-container" class="" style="display:none;">
                <label for="section">Selecciona la sección:</label>
                <select id="section" name="section" required>
                    <option value="maquina">Máquina</option>
                    <option value="corte">Corte</option>
                    <option value="empaque">Empaque</option>
                </select>
            </div>
            <div class="">
                <label for="password">Contraseña:</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" required>
                    <span class="toggle-password" onclick="togglePassword()">👁️</span>
                </div>
            </div>
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>