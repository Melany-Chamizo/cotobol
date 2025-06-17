<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Colegiados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .panel-container {
            width: 90%;
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #003366;
            border-bottom: 2px solid #0056b3;
            padding-bottom: 0.5rem;
        }
        .form-proyecto {
            margin-top: 2rem;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .submit-btn {
            background-color: #0056b3;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- En panel.php, mejora el diseño -->
<div class="panel-container">
    <div class="panel-header">
        <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['user_name']); ?></h1>
        <div class="user-actions">
            <a href="perfil.php" class="btn btn-outline">Mi Perfil</a>
            <a href="logout.php" class="btn btn-outline">Cerrar Sesión</a>
        </div>
    </div>
    
    <div class="panel-grid">
        <div class="panel-card">
            <h3><i class="card-icon">📊</i> Mis Proyectos</h3>
            <p>Administra tus proyectos publicados</p>
            <a href="mis_proyectos.php" class="btn btn-small">Ver Todos</a>
        </div>
        
        <div class="panel-card">
            <h3><i class="card-icon">📅</i> Eventos</h3>
            <p>Próximos cursos y capacitaciones</p>
            <a href="eventos.php" class="btn btn-small">Ver Calendario</a>
        </div>
        
        <div class="panel-card">
            <h3><i class="card-icon">💼</i> Bolsa de Trabajo</h3>
            <p>Ofertas laborales para colegiados</p>
            <a href="bolsa_trabajo.php" class="btn btn-small">Ver Ofertas</a>
        </div>
    </div>
    
    <form class="form-proyecto" action="guardar_proyecto.php" method="POST" enctype="multipart/form-data">
        <h2 class="form-title">Publicar Nuevo Proyecto</h2>
        
        <div class="form-row">
            <div class="form-group">
                <label for="titulo">Título del Proyecto</label>
                <input type="text" id="titulo" name="titulo" required placeholder="Ej: Levantamiento Catastral Urbano">
            </div>
            
            <div class="form-group">
                <label for="fecha">Fecha de Realización</label>
                <input type="date" id="fecha" name="fecha" required>
            </div>
        </div>
        
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="5" required placeholder="Describa el proyecto en detalle..."></textarea>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="tecnologias">Tecnologías Utilizadas</label>
                <input type="text" id="tecnologias" name="tecnologias" placeholder="Ej: GPS RTK, AutoCAD, Drones" required>
            </div>
            
            <div class="form-group">
                <label for="ubicacion">Ubicación (opcional)</label>
                <input type="text" id="ubicacion" name="ubicacion" placeholder="Ciudad, Provincia">
            </div>
        </div>
        
        <div class="form-group">
            <label for="imagen">Imagen del Proyecto</label>
            <div class="file-upload">
                <label for="imagen" class="file-upload-label">
                    <span id="file-name">Seleccionar archivo...</span>
                    <span class="file-upload-btn">Buscar</span>
                </label>
                <input type="file" id="imagen" name="imagen" accept="image/*" required>
            </div>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="submit-btn">
                <span class="btn-text">Publicar Proyecto</span>
                <span class="btn-icon">📤</span>
            </button>
        </div>
    </form>
</div>

</body>
<script>
// En un archivo panel.js
document.addEventListener('DOMContentLoaded', function() {
    // Mostrar nombre del archivo seleccionado
    const fileInput = document.getElementById('imagen');
    const fileName = document.getElementById('file-name');
    
    fileInput.addEventListener('change', function() {
        if(this.files.length > 0) {
            fileName.textContent = this.files[0].name;
        } else {
            fileName.textContent = 'Seleccionar archivo...';
        }
    });
    
    // Validación del formulario
    const form = document.querySelector('.form-proyecto');
    form.addEventListener('submit', function(e) {
        const titulo = document.getElementById('titulo').value.trim();
        const descripcion = document.getElementById('descripcion').value.trim();
        
        if(titulo === '' || descripcion === '') {
            e.preventDefault();
            alert('Por favor complete todos los campos requeridos');
        }
    });
});
</script>
</html>