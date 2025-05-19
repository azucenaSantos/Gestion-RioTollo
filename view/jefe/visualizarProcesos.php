<html lang="en" data-bs-theme="dark">

<body>
    <div class="section">
        <!--Menu lateral, comun a todos los usuarios (con más o menos apartados) -->
        <nav class="navbar navbar-expand-lg navbar-light" style="width: 400px;">
            <div class="container-fluid lateral-menu">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item">
                            <a class="nav-section" href="?c=Jefe&a=gestionTrabajos">
                                <i class="las la-briefcase"></i>
                                <h3>Gestión de Trabajos</h3>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-section" href="?c=Jefe&a=gestionGrupos">
                                <i class="las la-object-group"></i>
                                <h3>Gestión de Grupos</h3>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-section" href="?c=Jefe&a=visualizarProcesos">
                                <i class="las la-chart-bar"></i>
                                <h3>Visualizar Procesos</h3>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--Contenedor principal, donde se cargan los contenidos del apartado seleccionado -->
        <main>
            <div class="info-container">
                <h1>Procesos de Trabajos</h1>

            </div>
            <div class="container containerTable">
                <form method="post" class="mx-auto p-5 shadow-sm formEdits" action="?c=Jefe&a=guardarTrabajo"
                    id="formProcesos" novalidate>
                    <div class="form-inputs">
                        <div class="mt-3">
                            <label for="inputZona">Zona: </label>
                            <select class="form-control form-select" id="selectorZonas" name="zona" required>
                                <?php if (isset($zonas)): ?>
                                    <?php if ($trabajoId == null): ?>
                                        <option value="noSeleccion" selected disabled>Selecciona una zona de trabajo</option>
                                    <?php endif; ?>
                                    <?php foreach ($zonas as $zona): ?>
                                        <option value="<?php echo $zona->getId(); ?>" <?php echo (isset($trabajo) && $trabajo->getZona() == $zona->getNombre())
                                               || (isset($zonaSeleccionar) && $zonaSeleccionar == $zona->getNombre()) ? 'selected' : ''; ?>>

                                            <?php echo $zona->getNombre(); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="">No hay zonas disponibles</option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div id="map"></div><!-- Mapa de Leaflet -->
                </form>


            </div>
        </main>
    </div>
    <div class="line"></div>