<html lang="en" data-bs-theme="dark">

<body>
    <div class="section d-flex flex-row">
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
                <?php if (isset($trabajo) && $trabajo->getId()): ?>
                    <h1>Editar Trabajo</h1>
                <?php else: ?>
                    <h1>Crear Trabajo</h1>
                <?php endif; ?>
            </div>
            <div class="container containerTable">
                <form method="post" class="mx-auto p-5 shadow-sm formEdits" action="?c=Jefe&a=guardarTrabajo"
                    id="formTrabajo" novalidate>
                    <!--campo vacio para el id del trabajo-->
                    <input type="hidden" name="id" value="<?php echo isset($trabajo) ? $trabajo->getId() : ''; ?>">
                    <div class="form-inputs">
                        <div class="mt-3">
                            <label for="inputTrabajo">Trabajo: </label>
                            <input type="text" class="form-control" id="inputTrabajo" name="trabajo"
                                value="<?php echo isset($trabajo) ? $trabajo->getNombre() : (isset($nombre) ? $nombre : ''); ?>"
                                required>
                        </div>
                        <div class="mt-3">
                            <label for="inputZona">Zona: </label>
                            <select class="form-control form-select" id="inputZona" name="zona" required>
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
                        <!--Select multiple plugin-->
                        <div>
                            <label>Parcelas: </label>
                            <select class="js-sidebysidemultiselect" id="selectMultipleParcelas" multiple="multiple"
                                name="opcionesSeleccionadas[]" required>
                                <?php if (isset($parcelas)): ?>
                                    <?php foreach ($parcelas as $parcela): ?>
                                        <option value="<?php echo $parcela->getId(); ?>" <?php echo
                                               (in_array($parcela->getId(), $parcelasSeleccionadas)) ? 'selected' : ''; ?>>
                                            <?php echo $parcela->getNumParcela(); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="">No hay parcelas disponibles</option>
                                <?php endif; ?>

                            </select>
                        </div>
                        <div class="mt-3 d-flex">
                            <label for="inputPorcentaje" class="form-label">Porcentaje: </label>
                            <input type="range" class="form-range form-control" min="0" max="100" step="10"
                                id="inputPorcentaje" name="porcentaje"
                                value="<?php echo isset($trabajo) ? $trabajo->getPorcentaje() : '0'; ?>" required>
                            <input type="number" class="form-control form-number" name="porcentaje"
                                id="inputPorcentajeNum" min="0" max="100" step="10"
                                value="<?php echo isset($trabajo) ? $trabajo->getPorcentaje() : '0'; ?>" required>
                        </div>
                        <div class="radios mt-3">
                            <label>Finalizado: </label>
                            <div class="inputRadio" style="display: inline-block; width: 4%;">
                                <input type="radio" id="finalizadoSi" name="finalizado" value="1" <?php
                                echo (isset($trabajo) && $trabajo->getFinalizado() == 1) || (isset($finalizado) && $finalizado == 1) ? 'checked' : ''; ?>>
                                <label for="finalizadoSi">Sí</label>
                            </div>
                            <div class="inputRadio" style="display: inline-block;">
                                <input type="radio" id="finalizadoNo" name="finalizado" value="0" <?php
                                echo (isset($trabajo) && $trabajo->getFinalizado() == 0) || (isset($finalizado) && $finalizado == 0) ? 'checked' : ''; ?>>
                                <label for="finalizadoNo">No</label>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label for="inputHorario">Horario: </label>
                            <input type="time" class="form-control" id="horaIni" name="hora_inicio"
                                value="<?php echo isset($trabajo) ? $trabajo->getHoraInicio() : (isset($hora_inicio) ? $hora_inicio : ''); ?>"
                                required>
                            <input type="time" class="form-control" id="horaFin" name="hora_fin"
                                value="<?php echo isset($trabajo) ? $trabajo->getHoraFin() : (isset($hora_fin) ? $hora_fin : ''); ?>"
                                required>
                        </div>
                        <div class="mt-3">
                            <label for="inputFecha">Fecha: </label>
                            <input type="date" class="form-control" id="inputFecha" name="fecha"
                                value="<?php echo isset($trabajo) ? $trabajo->getFecha() : (isset($fecha) ? $fecha : ''); ?>"
                                required>
                        </div>
                        <div class="mt-3">
                            <label for="inputGrupo">Grupo: </label>
                            <select class="form-control form-select" id="inputGrupo" name="grupo" required
                                onchange="handleSelectChange(this)">
                                <?php if (isset($grupos)): ?>
                                    <?php if ($trabajoId == null): ?>
                                        <option value="noSeleccion" selected disabled>Selecciona un grupo de trabajo</option>
                                    <?php endif; ?>
                                    <?php foreach ($grupos as $grupo): ?>
                                        <option value="<?php echo $grupo->getId(); ?>" <?php echo (isset($trabajo) && $trabajo->getGrupoNombre() == $grupo->getNombre())
                                               || (isset($id_grupo) && $id_grupo == $grupo->getId()) ? 'selected' : ''; ?>>
                                            <?php echo $grupo->getNombre(); ?>
                                        </option>
                                    <?php endforeach; ?>
                                    <option value="nuevoGrupo">
                                        Añadir un grupo nuevo
                                    </option>
                                <?php else: ?>
                                    <option value="">No hay grupos disponibles</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="mt-3 anotaciones">
                            <label for="inputAnotaciones" style="display:block">Anotaciones: </label>
                            <textarea class="form-control" id="inputAnotaciones"
                                name="anotaciones"><?php echo isset($trabajo) ? htmlspecialchars($trabajo->getAnotaciones()) : ''; ?></textarea>
                        </div>
                    </div>
                    <div class="error-container">
                        <!--contenedores errores cliente-->
                        <div id="errorTrabajo"></div>
                        <div id="errorZona"></div>
                        <div id="errorParcelas"></div>
                        <div id="errorFinalizado"></div>
                        <div id="errorHorario"></div>
                        <div id="errorFecha"></div>
                        <div id="errorGrupoTrabajo"></div>
                        <!--contenedor errores servidor-->
                        <?php if (!empty($cadenaErrores)): ?>
                            <ul style="list-style: none;">
                                <?php foreach ($cadenaErrores as $error): ?>
                                    <div class="alert alert-danger">
                                        <li><?php echo $error; ?></li>
                                    </div>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <div class="btn-container">
                        <button type="submit" class="buttonAdd">
                            <?php if (isset($trabajo) && $trabajo->getId()): ?>
                                Editar
                            <?php else: ?>
                                Crear
                            <?php endif; ?>
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
    <div class="line"></div>

    <script>
        function handleSelectChange(select) {
            if (select.value === "nuevoGrupo") {
                // Redirige al controlador y acción deseados
                window.location.href = "?c=Jefe&a=editarGrupo";
            }
        }
    </script>