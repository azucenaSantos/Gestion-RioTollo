ALTER TABLE `grupos`
ADD CONSTRAINT `grupos_ibfk_1` FOREIGN KEY (`id_coordinador`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `grupos_trabajadores`
ADD CONSTRAINT `grupos_trabajadores_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `grupos_trabajadores_ibfk_2` FOREIGN KEY (`id_trabajador`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `trabajos`
ADD CONSTRAINT `trabajos_ibfk_1` FOREIGN KEY (`id_zona`) REFERENCES `zonas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `trabajos_grupos`
ADD CONSTRAINT `trabajos_grupos_ibfk_1` FOREIGN KEY (`id_trabajo`) REFERENCES `trabajos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `trabajos_grupos_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `trabajos_parcelas`
ADD CONSTRAINT `trabajos_parcelas_ibfk_1` FOREIGN KEY (`id_parcela`) REFERENCES `zonas_parcelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `trabajos_parcelas_ibfk_2` FOREIGN KEY (`id_trabajo`) REFERENCES `trabajos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `trabajos_registro`
ADD CONSTRAINT `trabajos_registro_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `trabajos_registro_ibfk_2` FOREIGN KEY (`id_trabajo`) REFERENCES `trabajos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `usuarios`
ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `ms_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `zonas_parcelas`
ADD CONSTRAINT `zonas_parcelas_ibfk_1` FOREIGN KEY (`id_zona`) REFERENCES `zonas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;