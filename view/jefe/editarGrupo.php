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
                <?php if (isset($grupo) && $grupo->getId()): ?>
                    <h1>Editar Grupo</h1>
                <?php else: ?>
                    <h1>Crear Grupo</h1>
                <?php endif; ?>
            </div>
            <div class="container containerTable">
                <form method="post" class="mx-auto p-5 shadow-sm formEdits" action="?c=Jefe&a=guardarGrupo"
                    id="formGrupo" novalidate>
                    <!--campo vacio para el id del grupo-->
                    <input type="hidden" name="id" value="<?php echo isset($grupo) ? $grupo->getId() : ''; ?>">
                    <!--campo oculto para el id del grupo-->
                    <div class="form-inputs">
                        <div class="mt-3">
                            <label for="inputGrupo">Nombre: </label>
                            <input type="text" class="form-control" id="inputGrupo" name="grupo"
                                value="<?php echo isset($grupo) ? $grupo->getNombre() : (isset($nombreGrupo) ? $nombreGrupo : ''); ?>"
                                required>
                        </div>

                        <div class="mt-3">
                            <label class="coordinador" for="inputCoordinador">Coordinador(a): </label>
                            <select class="form-control form-select" id="inputCoordinador" name="coordinador" required>
                                <?php if (isset($coordinadores)): ?>
                                    <?php if ($grupoId == null): ?>
                                        <option value="noSeleccion" selected disabled>Selecciona un coordinador(a)</option>
                                    <?php endif; ?>
                                    <?php foreach ($coordinadores as $coordinador): ?>
                                        <option value="<?php echo $coordinador->getId(); ?>" <?php echo (isset($coordinadorId) && $coordinador->getId() == $coordinadorId)
                                               || (isset($coordinadorSeleccionado) && $coordinadorSeleccionado == $coordinador->getId()) ? 'selected' : ''; ?>>
                                            <?php echo $coordinador->getNombreApellidos(); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="">No hay coordinadores registardos</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <!--Select multiple plugin-->
                        <label>Integrantes: </label>
                        <select class="js-sidebysidemultiselect" id="selectMultiple" multiple="multiple"
                            name="integrantesSeleccionados[]">
                            <?php if (isset($trabajadores)): ?>
                                <?php foreach ($trabajadores as $trabajador): ?>
                                    <option value="<?php echo $trabajador->getId(); ?>" <?php
                                       echo in_array($trabajador->getId(), $integrantesSeleccionados) ? 'selected' : ''; ?>>
                                        <?php echo $trabajador->getNombreApellidos(); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="">No hay integrante disponibles</option>
                            <?php endif; ?>
                        </select>

                    </div>
                    <div class="error-container">
                        <!--contenedores errores cliente-->
                        <div id="errorGrupo"></div>
                        <div id="errorCoordinador"></div>
                        <div id="errorIntegrantes"></div>
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
                            <?php if (isset($grupo) && $grupo->getId()): ?>
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