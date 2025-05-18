<html lang="en" data-bs-theme="dark">

<body>
    <div class="section d-flex flex-row">
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
        <main>
            <div class="info-container">
                <h1>Listado de Jefes</h1>
            </div>
            <div class="container containerTable">
                <form class="btn-container" action="?c=Rrhh&a=editarJefe" method="post">
                    <button type="submit" class="buttonAdd">Añadir Jefe</button>
                </form>
                <table class="table table-hover mx-auto shadow-sm" id="tablaOrdenar">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Usuario</th>
                            <th>Contraseña</th>
                            <th>Rol</th>
                            <th class="acciones">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jefesInfo as $jefe): ?>
                            <tr onclick="location.href='?c=Rrhh&a=editarJefe&id=<?php echo $jefe->getId(); ?>'">
                                <td><?php echo $jefe->getName(); ?></td>
                                <td><?php echo $jefe->getSurname(); ?></td>
                                <td><?php echo $jefe->getUsername(); ?></td>
                                <td class="estado">
                                    <?php if ($jefe->getPasswordChanged()): ?>
                                        <p class="finalizado">Modificada</p>
                                    <?php else: ?>
                                        <p class="pendiente">No modificada</p>
                                    <?php endif; ?>
                                </td>
                                <td class="roles">
                                    <?php if ($jefe->getRol() == "10"): ?>
                                        <p class="jefe">Jefe</p>
                                    <?php else: ?>
                                        <p class="rrhh">RRHH</p>
                                    <?php endif; ?>
                                </td>
                                <td class="acciones">
                                    <a href="?c=Rrhh&a=editarJefe&id=<?php echo $jefe->getId(); ?>" class="iconModify">
                                        <i class="las la-edit"></i></a>

                                    <a href="?c=Rrhh&a=gestionTrabajadores" class="iconDelete" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal-<?php echo $jefe->getId(); ?>"
                                        onclick="event.stopPropagation();">
                                        <i class="las la-trash-alt"></i></a>
                                </td>
                            <?php endforeach; ?>
                    </tbody>
                </table>
                <!--acordeon que se muestra por cada jefe en resolucion movil-->
                <div class="accordion mobile-accordion" id="accordionTable">
                    <?php foreach ($jefesInfo as $jefe): ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-<?php echo $jefe->getId(); ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-<?php echo $jefe->getId(); ?>">
                                    <?php echo $jefe->getName(); ?>
                                </button>
                            </h2>
                            <div id="collapse-<?php echo $jefe->getId(); ?>" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <p><strong>Nombre:</strong> <?php echo $jefe->getName(); ?></p>
                                    <p><strong>Apellidos:</strong> <?php echo $jefe->getSurname(); ?></p>
                                    <p><strong>Usuario:</strong> <?php echo $jefe->getUsername(); ?></p>
                                    <p>
                                        <a href="?c=Rrhh&a=editarTrabajador&id=<?php echo $jefe->getId(); ?>"
                                            class="iconModify"><i class="las la-edit"></i></a>
                                        <a href="?c=Rrhh&a=gestionTrabajadores" class="iconDelete" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal-<?php echo $jefe->getId(); ?>"><i
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
    <?php foreach ($jefesInfo as $jefe): ?>
        <div class="modal fade" id="deleteModal-<?php echo $jefe->getId(); ?>" tabindex="-1"
            aria-labelledby="deleteModalLabel-<?php echo $jefe->getId(); ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmar eliminación</h5>
                        <a href="?c=Rrhh&a=gestionJefes" class="btn-close"></a>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que deseas eliminar
                        "<?php echo $jefe->getNombreApellidos(); ?>"?
                    </div>
                    <div class="modal-footer">
                        <a href="?c=Rrhh&a=gestionJefes" class="btn btn-secondary">Cancelar</a>

                        <a href="?c=Rrhh&a=eliminarJefe&id=<?php echo $jefe->getId(); ?>"
                            class="btn btn-danger">Eliminar</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="line"></div>