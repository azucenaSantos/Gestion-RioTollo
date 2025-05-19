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
                            <a href="?c=Rrhh&a=gestionTrabajadores" class="nav-section">
                                <i class="las la-user-edit"></i>
                                <h3>Gestionar Trabajadores</h3>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?c=Rrhh&a=gestionJefes" class="nav-section">
                                <i class="las la-user-shield"></i>
                                <h3>Gestionar Jefes</h3>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--Contenedor principal, donde se cargan los contenidos del apartado seleccionado -->
        <main>
            <div class="info-container">
                <?php if (isset($jefe) && $jefe->getId()): ?>
                    <h1>Editar Jefe</h1>
                <?php else: ?>
                    <h1>Crear Jefe</h1>
                <?php endif; ?>
            </div>
            <div class="container containerTable">
                <form method="post" class="mx-auto p-5 shadow-sm formEdits" action="?c=Rrhh&a=guardarJefe"
                    id="formTrabajador" novalidate>
                    <!--campo vacio para el id del jefe-->
                    <input type="hidden" name="id" id="idTrabajador"
                        value="<?php echo isset($jefe) ? $jefe->getId() : ''; ?>">
                    <div class="form-inputs">
                        <div class="mt-3">
                            <label for="inputNombre">Nombre: </label>
                            <input type="text" class="form-control" id="inputNombre" name="nombre"
                                value="<?php echo isset($jefe) ? $jefe->getName() : (isset($nombre) ? $nombre : ''); ?>"
                                required>
                        </div>

                        <div class="mt-3">
                            <label for="inputApellidos">Apellidos: </label>
                            <input type="text" class="form-control" id="inputApellidos" name="apellidos"
                                value="<?php echo isset($jefe) ? $jefe->getSurname() : (isset($apellidos) ? $apellidos : ''); ?>"
                                required>
                        </div>

                        <div class="mt-3">
                            <label for="inputUsuario">Usuario: </label>
                            <input type="text" class="form-control" id="inputUsuario" name="usuario"
                                value="<?php echo isset($jefe) ? $jefe->getUsername() : (isset($apellidos) ? $apellidos : ''); ?>"
                                required>
                        </div>

                        <div class="mt-3">
                            <label for="inputUsuario">Contraseña: </label>
                            <?php if (isset($jefe) && $jefe->getId()): ?>
                                <button type="button" class="buttonPassword" id="updatePasswordButton">
                                    Actualizar Contraseña
                                </button>
                            <?php else: ?>
                                <button type="button" class="buttonPassword2" id="assignPasswordButton" disabled>
                                    Asignación Por Defecto
                                </button>
                            <?php endif; ?>
                        </div>
                        <div class="mt-3">
                            <label for="inputRol">Rol: </label>
                            <select class="form-control form-select" id="inputRol" name="rol" required>
                                <?php if (isset($roles)): ?>
                                    <?php if ($jefeId == null): ?>
                                        <option value="noSeleccion" selected disabled>Selecciona un rol</option>
                                    <?php endif; ?>
                                    <?php foreach ($roles as $rol): ?>
                                        <option value="<?php echo $rol->getId(); ?>" <?php echo (isset($jefe) && $jefe->getRol() == $rol->getId())
                                               || (isset($rolSeleccionar) && $rolSeleccionar == $rol->getId()) ? 'selected' : ''; ?>>
                                            <?php echo $rol->getNombre(); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="">No hay roles disponibles</option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="error-container">
                        <!--contenedores errores cliente-->
                        <div id="errorNombre"></div>
                        <div id="errorApellidos"></div>
                        <div id="errorUsuario"></div>
                        <div id="errorRol"></div>
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
                            <?php if (isset($jefe) && $jefe->getId()): ?>
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