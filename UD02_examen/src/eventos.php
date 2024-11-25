<?php
session_start();

// Verificación de sesión
if (!isset($_SESSION['login'])) {
    header('Location: ./login.php');
    exit;
}
?>

<?php
    $pagina = "eventos";
    require './includes/header.php';
    ?>
<?php
        // Datos de los profesores
        $eventos = [
          ["id" => 1, "Nombre" => "Boda de Ana y Luis", "fecha" => "2024/12/15", 
          "descripcion" => " Ceremonia en el parque central con una recepción al aire libre en un jardín privado. ", 
          "foto" => true, "pagado" => true, "ubi" => "Madrid"],

          ["id" => 2, "Nombre" => "Aniversario de Carla y Jorge", "fecha" => "2024/11/20", 
          "descripcion" => " Celebración en la playa con temática tropical y cena bajo las estrellas.", 
          "foto" => false, "pagado" => true, "ubi" => "Sevilla"],

          ["id" => 3, "Nombre" => "Fiesta de Compromiso de Marta y José", "fecha" => "2024/10/10", 
          "descripcion" => "Evento íntimo en una terraza con vista al mar, decorado con luces cálidas.", 
          "foto" => false, "pagado" => false, "ubi" => "Sevilla"],
          
          ["id" => 4, "Nombre" => "Boda de Claudia y Pablo", "fecha" => "2025/01/22", 
          "descripcion" => "Boda en un salón elegante con una ceremonia civil y recepción con cena formal.", 
          "foto" => true, "pagado" => true, "ubi" => "Barcelona"],

          ["id" => 5, "Nombre" => "Cena de Navidad de la Empresa XYZ", "fecha" => "2024/12/23", 
          "descripcion" => "Una cena formal para los empleados de XYZ en un restaurante exclusivo con temática navideña", 
          "foto" => false, "pagado" => true, "ubi" => "Madrid"],

          ["id" => 6, "Nombre" => " Baby Shower de Sara", "fecha" => "2025/02/15", 
          "descripcion" => "Celebración de bienvenida para el bebé de Sara, con decoración temática y actividades familiares. ", 
          "foto" => false, "pagado" => false, "ubi" => "Granada"]
        ];

        // Ordenar profesores si se ha enviado el formulario
        

         
            usort($eventos, function ($a, $b) {
                return strcmp($a['fecha'], $b['fecha']);
            });
            $uploadDir = __DIR__ . '/src/files_loaded/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

            // Descargar un solo alumno
if (isset($_POST['export_single']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    foreach ($ids as $id) {
        if ($ids['id'] === $id) {
            $filePath = $uploadDir . "Excursion {$id}.txt";
            $file = fopen($filePath, 'w');
            fwrite($file, "ID: {$ids['id']}, Nombre del evento: {$ids['Nombre']}, Lugar: {$ids['ubi']}, fecha: {$ids['fecha']},
            descripcion: {$ids['descripcion']}, incluye foto: {$ids['foto']}, pagado: {$ids['pagado']}  \n");
            fclose($file);

            header('Content-Type: text/plain');
            header("Content-Disposition: attachment; filename=\"evento {$id}.txt\"");
            readfile($filePath);
            exit;
        }
    }
}
        
        ?>
        <body>
        <form action="eventos.php" method="POST" class="mb-4">
        <div class="container text-center row">
            <div class="col">
            <select name="ciudad" id="1" class="form-select" aria-label="Default select example">
                <option value="M">Madrid</option>
                <option value="S">Sevilla</option>
                <option value="B">Barcelona</option>
                <option value="G">Granada</option>
            </select>
            </div>
            <div class="col">
            <select name="pagado" id="2" class="form-select" aria-label="Default select example">
                <option value="si">pagado</option>
                <option value="no">no pagado</option>
            </select>
            </div>
            </div>
        </form>
        <div class="container">
        <div class="row col-sm-12 p-4">
            <?php foreach ($eventos as $eve): ?>
                <div class="col-12 col-md-3 mb-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-header"><?= htmlspecialchars($eve["Nombre"]) ?></h5>
                            <p class="card-title"><?= htmlspecialchars($eve["ubi"]) ?></p>
                            <p class="card-text">Fecha: <?= htmlspecialchars($eve["fecha"]) ?></p>
                            <p class="card-title"><?= htmlspecialchars($eve["descripcion"]) ?></p>
                            <form method="post" class="d-inline">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($alumno['id']) ?>">
                            <button type="submit" name="export_single" class="btn btn-info">
                              
                                detalles
                                </svg>
                            </button>
                        </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
        </body>