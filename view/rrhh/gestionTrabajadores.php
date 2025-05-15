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
                <h1>Listado de Trabajadores</h1>
            </div>
            <div class="container containerTable">
                <form class="btn-container" action="?c=Rrhh&a=editarTrabajador" method="post">
                    <button type="submit" class="buttonAdd">Añadir Trabajador</button>
                </form>
                <table class="table table-hover mx-auto shadow-sm">
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
                        <?php
                        if (empty($trabajadoresInfo)) {
                            echo "<tr><td colspan='7' class='text-center'>No hay trabajadores registrados</td></tr>";
                        }
                        ?>
                        <?php foreach ($trabajadoresInfo as $trabajador): ?>
                            <tr onclick="location.href='?c=Rrhh&a=editarTrabajador&id=<?php echo $trabajador->getId(); ?>'">
                                <td><?php echo $trabajador->getName(); ?></td>
                                <td><?php echo $trabajador->getSurname(); ?></td>
                                <td><?php echo $trabajador->getUsername(); ?></td>
                                <td class="estado">
                                    <?php if ($trabajador->getPasswordChanged()): ?>
                                        <p class="finalizado">Modificada</p>
                                    <?php else: ?>
                                        <p class="pendiente">No modificada</p>
                                    <?php endif; ?>
                                </td>
                                <td class="roles">
                                    <?php if ($trabajador->getRol()=="30"): ?>
                                        <p class="trabajador">Trabajador</p>
                                    <?php else: ?>
                                        <p class="coordinador">Coordiandor(a)</p>
                                    <?php endif; ?>
                                </td>
                                <td class="acciones">
                                    <a href="?c=Rrhh&a=editarTrabajador&id=<?php echo $trabajador->getId(); ?>"
                                        class="iconModify">
                                        <i class="las la-edit"></i></a>

                                    <a href="?c=Rrhh&a=gestionTrabajadores" class="iconDelete" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal-<?php echo $trabajador->getId(); ?>"
                                        onclick="event.stopPropagation();">
                                        <i class="las la-trash-alt"></i></a>

                                    <!-- Modal eliminar-->
                                    <div class="modal fade" id="deleteModal-<?php echo $trabajador->getId(); ?>"
                                        tabindex="-1" aria-labelledby="deleteModalLabel-<?php echo $trabajador->getId(); ?>"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirmar eliminación</h5>
                                                    <a href="?c=Rrhh&a=gestionTrabajadores" class="btn-close"></a>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Estás seguro de que deseas eliminar
                                                    "<?php echo $trabajador->getNombreApellidos(); ?>"?
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="?c=Rrhh&a=gestionTrabajadores"
                                                        class="btn btn-secondary">Cancelar</a>

                                                    <a href="?c=Rrhh&a=eliminarTrabajador&id=<?php echo $trabajador->getId(); ?>"
                                                        class="btn btn-danger">Eliminar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>


    </div>
    <div class="line"></div>