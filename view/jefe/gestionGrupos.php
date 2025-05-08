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
                <h1>Listado de Grupos</h1>
            </div>
            <div class="container containerTable">
                <form class="btn-container" action="?c=Jefe&a=editarGrupo" method="post">
                    <button type="submit" class="buttonAdd">Añadir Grupo</button>
                </form>
                <table class="table table-hover mx-auto shadow-sm">
                    <thead>
                        <tr>
                            <th>Grupo</th>
                            <th>Coordinador(a)</th>
                            <th>Integrantes</th>
                            <th class="acciones">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (empty($gruposInfo)) {
                            echo "<tr><td colspan='7' class='text-center'>No hay grupos registrados</td></tr>";
                        } ?>
                        <?php foreach ($gruposInfo as $grupo): ?>
                            <tr onclick="location.href='?c=Jefe&a=editarGrupo&id=<?php echo $grupo->getId(); ?>'">
                                <td><?php echo $grupo->getNombre(); ?></td>
                                <td><?php echo $grupo->getNombreCoordinador(); ?></td>
                                <td><?php echo $grupo->getIntegrantes() ?></td>
                                <td class="acciones">
                                    <a href="?c=Jefe&a=editarGrupo&id=<?php echo $grupo->getId(); ?>" class="iconModify">
                                        <i class="las la-edit"></i></a>

                                    <a href="?c=Jefe&a=gestionGrupos" class="iconDelete" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal-<?php echo $grupo->getId(); ?>"
                                        onclick="event.stopPropagation();">
                                        <i class="las la-trash-alt"></i></a>

                                    <!-- Modal eliminar-->
                                    <div class="modal fade" id="deleteModal-<?php echo $grupo->getId(); ?>" tabindex="-1"
                                        aria-labelledby="deleteModalLabel-<?php echo $grupo->getId(); ?>"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirmar eliminación</h5>
                                                    <a href="?c=Jefe&a=gestionGrupos" class="btn-close"></a>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Estás seguro de que deseas eliminar
                                                    "<?php echo $grupo->getNombre(); ?>"?
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="?c=Jefe&a=gestionGrupos" class="btn btn-secondary">Cancelar</a>

                                                    <a href="?c=Jefe&a=eliminarGrupo&id=<?php echo $grupo->getId(); ?>"
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
    </main>
    </div>
    <div class="line"></div>