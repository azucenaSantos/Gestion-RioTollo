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
                        <li class="nav-item"><a class="nav-section" href="?c=Jefe&a=gestionTrabajos"><i
                                    class="las la-briefcase"></i>
                                <h3>Gestión de Trabajos</h3>
                            </a></li>
                        <li class="nav-item"><a class="nav-section" href="?c=Jefe&a=gestionGrupos"><i
                                    class="las la-object-group"></i>
                                <h3>Gestión de Grupos</h3>
                            </a></li>
                        <li class="nav-item"><a class="nav-section" href="?c=Jefe&a=visualizarProcesos"><i
                                    class="las la-chart-bar"></i>
                                <h3>Visualizar Procesos</h3>
                            </a></li>
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
                <table class="table table-hover mx-auto shadow-sm desktop-table" id="tablaOrdenar">
                    <thead>
                        <tr>
                            <th>Trabajo</th>
                            <th>Zona</th>
                            <th>Horario</th>
                            <th>Grupo</th>
                            <th>Anotaciones</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($trabajosInfo as $trabajo): ?>
                            <tr onclick="location.href='?c=Jefe&a=editarTrabajo&id=<?php echo $trabajo->getId(); ?>'">
                                <td><?php echo $trabajo->getNombre(); ?></td>
                                <td><?php echo $trabajo->getZona(); ?></td>
                                <td><?php echo $trabajo->getHoraInicio() . " - " . $trabajo->getHoraFin(); ?></td>
                                <td><?php echo $trabajo->getGrupoNombre(); ?></td>
                                <td><?php echo $trabajo->getAnotaciones(); ?></td>
                                <td><?php echo $trabajo->getFinalizado() ? "Finalizado" : "Pendiente"; ?></td>
                                <td class="acciones">
                                    <a href="?c=Jefe&a=editarTrabajo&id=<?php echo $trabajo->getId(); ?>"
                                        class="iconModify"><i class="las la-edit"></i></a>
                                    <a href="?c=Jefe&a=gestionTrabajos" class="iconDelete" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal-<?php echo $trabajo->getId(); ?>"
                                        onclick="event.stopPropagation();">
                                        <i class="las la-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!--acordeon que se muestra por cada trabajo en resolucion movil-->
                <div class="accordion mobile-accordion" id="accordionTable">
                    <?php foreach ($trabajosInfo as $trabajo): ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-<?php echo $trabajo->getId(); ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-<?php echo $trabajo->getId(); ?>">
                                    <?php echo $trabajo->getNombre(); ?>
                                </button>
                            </h2>
                            <div id="collapse-<?php echo $trabajo->getId(); ?>" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <p><strong>Zona:</strong> <?php echo $trabajo->getZona(); ?></p>
                                    <p><strong>Horario:</strong>
                                        <?php echo $trabajo->getHoraInicio() . " - " . $trabajo->getHoraFin(); ?></p>
                                    <p><strong>Grupo:</strong> <?php echo $trabajo->getGrupoNombre(); ?></p>
                                    <p><strong>Anotaciones:</strong> <?php echo $trabajo->getAnotaciones(); ?></p>
                                    <p><strong>Estado:</strong>
                                        <?php echo $trabajo->getFinalizado() ? "Finalizado" : "Pendiente"; ?></p>
                                    <p>
                                        <a href="?c=Jefe&a=editarTrabajo&id=<?php echo $trabajo->getId(); ?>"
                                            class="iconModify"><i class="las la-edit"></i></a>
                                        <a href="?c=Jefe&a=gestionTrabajos" class="iconDelete" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal-<?php echo $trabajo->getId(); ?>"><i
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
    <!-- Modal eliminar-->
    <?php foreach ($trabajosInfo as $trabajo): ?>
        <div class="modal fade" id="deleteModal-<?php echo $trabajo->getId(); ?>" tabindex="-1"
            aria-labelledby="deleteModalLabel-<?php echo $trabajo->getId(); ?>" aria-hidden="true">
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
                        <a href="?c=Jefe&a=gestionTrabajos" class="btn btn-secondary">Cancelar</a>

                        <a href="?c=Jefe&a=eliminarTrabajo&id=<?php echo $trabajo->getId(); ?>"
                            class="btn btn-danger">Eliminar</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="line"></div>