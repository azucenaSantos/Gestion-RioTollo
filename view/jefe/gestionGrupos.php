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
                <table class="table table-hover mx-auto shadow-sm" id="tablaOrdenar">
                    <thead>
                        <tr>
                            <th>Grupo</th>
                            <th>Coordinador(a)</th>
                            <th>Integrantes</th>
                            <th class="acciones">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
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
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!--acordeon que se muestra por cada grupo en resolucion movil-->
                <div class="accordion mobile-accordion" id="accordionTable">
                    <?php foreach ($gruposInfo as $grupo): ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-<?php echo $grupo->getId(); ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-<?php echo $grupo->getId(); ?>">
                                    <?php echo $grupo->getNombre(); ?>
                                </button>
                            </h2>
                            <div id="collapse-<?php echo $grupo->getId(); ?>" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <p><strong>Grupo:</strong> <?php echo $grupo->getNombre(); ?></p>
                                    <p><strong>Coordinador(a):</strong> <?php echo $grupo->getNombreCoordinador(); ?></p>
                                    <p><strong>Integrantes:</strong> <?php echo $grupo->getIntegrantes(); ?></p>
                                    <p>
                                        <a href="?c=Jefe&a=editarGrupo&id=<?php echo $grupo->getId(); ?>"
                                            class="iconModify"><i class="las la-edit"></i></a>
                                        <a href="?c=Jefe&a=gestionGrupos" class="iconDelete" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal-<?php echo $grupo->getId(); ?>"><i
                                                class="las la-trash-alt"></i></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </main>
    </div>
    </div>
    <!-- Modal eliminar-->
    <?php foreach ($gruposInfo as $grupo): ?>
        <div class="modal fade" id="deleteModal-<?php echo $grupo->getId(); ?>" tabindex="-1"
            aria-labelledby="deleteModalLabel-<?php echo $grupo->getId(); ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmar eliminación</h5>
                        <a href="?c=Jefe&a=gestionGrupos" class="btn-close"></a>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que deseas eliminar el grupo
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
    <?php endforeach; ?>
    <div class="line"></div>