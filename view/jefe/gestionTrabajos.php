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
                <h1>Listado de Trabajos</h1>
            </div>
            <div class="container containerTable">
                <form class="btn-container" action="?c=Jefe&a=editarTrabajo" method="post">
                    <button type="submit" class="buttonAdd">Añadir Trabajo</button>
                </form>
                <table class="table table-hover mx-auto shadow-sm">
                    <thead>
                        <tr>
                            <th>Trabajo</th>
                            <th>Zona</th>
                            <th>Horario</th>
                            <th>Grupo</th>
                            <th>Anotaciones</th>
                            <th>Estado</th>
                            <th class="acciones">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (empty($trabajosInfo)) {
                            echo "<tr><td colspan='7' class='text-center'>No hay trabajos registrados</td></tr>";
                        } ?>
                        <?php foreach ($trabajosInfo as $trabajo): ?>
                            <tr onclick="location.href='?c=Jefe&a=editarTrabajo&id=<?php echo $trabajo->getId(); ?>'">
                                <td><?php echo $trabajo->getNombre(); ?></td>
                                <td><?php echo $trabajo->getZona(); ?></td>
                                <td><?php echo $trabajo->getHoraInicio() . " - " . $trabajo->getHoraFin(); ?></td>
                                <td><?php echo $trabajo->getGrupoNombre() ?></td>
                                <td class="anotaciones"><?php echo $trabajo->getAnotaciones() ?></td>
                                <td class="estado">
                                    <?php if ($trabajo->getFinalizado()): ?>
                                        <p class="finalizado">Finalizado</p>
                                    <?php else: ?>
                                        <p class="pendiente">Pendiente</p>
                                    <?php endif; ?>
                                </td>
                                <td class="actions">
                                    <a href="?c=Jefe&a=editarTrabajo&id=<?php echo $trabajo->getId(); ?>"
                                        class="iconModify">
                                        <i class="las la-edit"></i>
                                    </a>
                                    <a href="?c=Jefe&a=gestionTrabajos" class="iconDelete" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal-<?php echo $trabajo->getId(); ?>"
                                        onclick="event.stopPropagation();">
                                        <!-- Evitar que el evento de clic se propague y no rediriga a la pagina de edicion de trabajo-->
                                        <i class="las la-trash-alt"></i>
                                    </a>
                                    <!-- Modal eliminar-->
                                    <div class="modal fade" id="deleteModal-<?php echo $trabajo->getId(); ?>" tabindex="-1"
                                        aria-labelledby="deleteModalLabel-<?php echo $trabajo->getId(); ?>"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirmar eliminación</h5>
                                                    <a href="?c=Jefe&a=gestionTrabajos" class="btn-close"></a>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Estás seguro de que deseas eliminar el trabajo
                                                    "<?php echo $trabajo->getNombre(); ?>"?
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="?c=Jefe&a=gestionTrabajos"
                                                        class="btn btn-secondary">Cancelar</a>

                                                    <a href="?c=Jefe&a=eliminarTrabajo&id=<?php echo $trabajo->getId(); ?>"
                                                        class="btn btn-danger">Eliminar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <div class="line"></div>