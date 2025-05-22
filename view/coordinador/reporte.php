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
                        <li class="nav-item li-active">
                            <a class="nav-section" href="?c=Coordinador&a=reportarTrabajos">
                                <i class="las la-pen-alt"></i>
                                <h3>Reportar Trabajo</h3>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-section" href="?c=Coordinador&a=verParte">
                                <i class="las la-file"></i>
                                <h3>Visualizar Parte</h3>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--Contenido de la página-->
        <main>
            <div class="info-container">
                <h1>Reportar Trabajo</h1>
                <hr>
            </div>
            <div class="container containerTable">
                <form method="post" class="mx-auto p-5 shadow-sm formEdits" action="?c=Coordinador&a=registrarReporte"
                    id="formCoordinador" novalidate>
                    <div class="form-inputs">
                        <div class="mt-3">
                            <label for="selectorTrabajos">Trabajo: </label>
                            <select class="form-control form-select" id="selectorTrabajos" name="trabajoSelect"
                                required>
                                <?php if (isset($trabajosCoordinador)): ?>
                                    <?php foreach ($trabajosCoordinador as $trabajo): ?>
                                        <option value="<?php echo $trabajo->getId(); ?>">
                                            <?php echo $trabajo->getNombre(); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="">No hay trabajos asociados</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="inputGrupo">Grupo: </label>
                            <input type="text" class="form-control" id="inputGrupo" name="grupo" value="" required
                                readonly>
                            <!--readonly para no permitir editar el nombre por parte del coordinador-->
                        </div>
                        <!--campo oculto para recoger el id del grupo-->
                        <input type="hidden" name="idGrupo" id="idGrupo" value="">

                        <div class="mt-3 d-flex">
                            <label for="inputPorcentaje" class="form-label">Porcentaje: </label>
                            <input type="range" class="form-range form-control" min="0" max="100" step="10"
                                id="inputPorcentaje" name="porcentaje"
                                value="<?php echo isset($trabajo) ? $trabajo->getPorcentaje() : ''; ?>" required>
                            <input type="number" class="form-control form-number" name="porcentaje"
                                id="inputPorcentajeNum" min="0" max="100" step="10"
                                value="<?php echo isset($trabajo) ? $trabajo->getPorcentaje() : ''; ?>" required>
                        </div>
                        <div class="mt-3">
                            <label for="inputHorario">Horario: </label>
                            <input type="time" class="form-control" id="horaIni" name="hora_inicio"
                                value="" required readonly>
                            <input type="time" class="form-control" id="horaFin" name="hora_fin"
                                value="" required readonly>
                        </div>
                        <div class="mt-3">
                            <label for="inputFecha">Fecha: </label>
                            <input type="date" class="form-control" id="inputFecha" name="fecha"
                                value="" required readonly>
                        </div>
                    </div>
                    <div class="error-container">
                        <!--Mensajes de error, hueco necesario -->
                    </div>
                    <div class="btn-container">
                        <button type="button" class="buttonAdd" data-bs-toggle="modal" id="botonModal"
                            data-bs-target="#reportModal">
                            Reportar Trabajo
                        </button>
                    </div>
                    <!--Modal para avisar sobre el reporte-->
                    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirmación de Reporte</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" id="modalBody">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" id="buttonModal">
                                        Reportar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <div class="line"></div>
</body>