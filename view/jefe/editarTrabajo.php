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
                <h1>Crear Trabajo</h1>
            </div>
            <div class="container containerTable">
                <form method="post" class="mx-auto p-5 shadow-sm formEdits" action="?c=Jefe&a=guardarTrabajo">
                    <!--campo vacio para el id del trabajo-->
                    <input type="hidden" name="id" value="<?php echo isset($trabajo) ? $trabajo->getId() : ''; ?>">
                    <div class="form-inputs">
                        <div class="mt-3">
                            <label for="inputTrabajo">Trabajo: </label>
                            <input type="text" class="form-control" id="inputTrabajo" name="trabajo"
                                value="<?php echo isset($trabajo) ? $trabajo->getNombre() : ''; ?>" required>
                        </div>
                        <div class="mt-3">
                            <label for="inputZona">Zona: </label>
                            <select class="form-control form-select" id="inputZona" name="zona" required>
                                <?php if (isset($zonas)): ?>
                                    <?php if ($trabajoId == null): ?>
                                        <option selected disabled>Selecciona una zona de trabajo</option>
                                    <?php endif; ?>
                                    <?php foreach ($zonas as $zona): ?>
                                        <option value="<?php echo $zona->getId(); ?>" 
                                            <?php echo isset($trabajo) && $trabajo->getZona() == $zona->getNombre() ? 'selected' : ''; ?>>
                                            <?php echo $zona->getNombre(); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="">No hay zonas disponibles</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <!--Dual Listbox-->
                        <div class="dual-listbox mt-3 listBox">
                            <div class="opcionesList">
                                <select id="opcionesDisponibles" multiple size="5">
                                    <!--se visualizan las parcelas de la zona seleccionada-->
                                </select>
                                <p>Parcelas disponibles</p>
                            </div>
                            <div class="opcionesList">
                                <select id="opcionesSeleccionadas" name="opcionesSeleccionadas[]" multiple size="5">
                                    <!-- se visualizan las parcelas para añadir al trabajo -->
                                </select>
                                <p>Parcelas seleccionadas</p>
                            </div>
                        </div>
                        <div class="buttons">
                            <button class="btn" id="addParcela" type="button">Añadir</button>
                            <button class="btn" id="removeParcela" type="button"> Quitar</button>
                        </div>
                        <div class="mt-3">
                            <label for="inputPorcentaje">Porcentaje: </label>
                            <input type="number" class="form-control" id="inputPorcentaje" name="porcentaje"
                                value="<?php echo isset($trabajo) ? $trabajo->getPorcentaje() : '0'; ?>" required>
                        </div>
                        <div class="radios mt-3">
                            <label>Finalizado: </label>
                            <div class="inputRadio" style="display: inline-block; width: 4%;">
                                <input type="radio" id="finalizadoSi" name="finalizado" value="1" <?php echo isset($trabajo) && $trabajo->getFinalizado() == 1 ? 'checked' : ''; ?>>
                                <label for="finalizadoSi">Sí</label>
                            </div>
                            <div class="inputRadio" style="display: inline-block;">
                                <input type="radio" id="finalizadoNo" name="finalizado" value="0" <?php echo isset($trabajo) && $trabajo->getFinalizado() == 0 ? 'checked' : ''; ?>>
                                <label for="finalizadoNo">No</label>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label for="inputHorario">Horario: </label>
                            <input type="time" class="form-control" id="inputHorario" name="hora_inicio"
                                value="<?php echo isset($trabajo) ? $trabajo->getHoraInicio() : ''; ?>" required>
                            <input type="time" class="form-control" name="hora_fin"
                                value="<?php echo isset($trabajo) ? $trabajo->getHoraFin() : ''; ?>" required>
                        </div>
                        <div class="mt-3">
                            <label for="inputFecha">Fecha: </label>
                            <input type="date" class="form-control" id="inputFecha" name="fecha"
                                value="<?php echo isset($trabajo) ? $trabajo->getFecha() : ''; ?>" required>
                        </div>
                            <div class="mt-3">
                            <label for="inputGrupo">Grupo: </label>
                            <select class="form-control form-select" id="inputGrupo" name="grupo" required>
                                 <?php if (isset($grupos)): ?>
                                    <?php if ($trabajoId == null): ?>
                                        <option selected disabled>Selecciona un grupo de trabajo</option>
                                    <?php endif; ?>
                                    <?php foreach ($grupos as $grupo): ?>
                                        <option value="<?php echo $grupo->getId(); ?>" 
                                            <?php echo isset($trabajo) && $trabajo->getGrupoNombre() == $grupo->getNombre() ? 'selected' : ''; ?>>
                                            <?php echo $grupo->getNombre(); ?>
                                        </option>
                                    <?php endforeach; ?>                            
                                    <option value="">
                                        <?php echo "TO.DO -> Añadir un grupo nuevo..." ?>
                                    </option>
                                <?php else: ?>
                                    <option value="">No hay grupos disponibles</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="checkbox mt-3">
                            <label for="inputAnotaciones" style="display:block">Anotaciones: </label>
                            <textarea class="form-control" id="inputAnotaciones"
                                name="anotaciones"><?php echo isset($trabajo) ? htmlspecialchars($trabajo->getAnotaciones()) : ''; ?></textarea>
                        </div>
                        <div class="btn-container">
                            <button type="submit" class="buttonAdd">Crear</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
    <div class="line"></div>