INSERT INTO `ms_roles` (`id`, `nombre`)
VALUES (1, 'Super'),
    (10, 'Jefe(a)'),
    (20, 'RRHH'),
    (30, 'Coordinador(a)'),
    (40, 'Trabajador(a)');
INSERT INTO `usuarios` (
        `nombre`,
        `apellido`,
        `nombre_usuario`,
        `contrasena`,
        `contrasena_cambiada`,
        `id_rol`
    )
VALUES (
        'Azucena',
        'Santos Estévez',
        'saazucena',
        'azucena123',
        0,
        1
    ),
    (
        'Carlos',
        'Pérez Silva',
        'pecarlos',
        '$2y$10$AWPJ3J8quMfTgI95Yp1.yeUewhpaucC3WioluUvRwGNiXfGGhkhN2',
        0,
        10
    ),
    (
        'Patricia',
        'Fernández García',
        'fepatricia',
        '$2y$10$5htYBD8dCe3kTid8G.BTwODV1e1IorQ9qefAvvzL24pltMG3EW8bS',
        0,
        20
    ),
    (
        'Rosa Maria',
        'Estévez Sobrino',
        'esrosa',
        '$2y$10$v27OgBKuhIcdP8oApbakGOTUE9GxDv3Pp/V573e3/iE2YZfl.OPIy',
        0,
        30
    ),
    (
        'Andrés',
        'Martínez Martínez',
        'maandres',
        '$2y$10$S/lz20LgnL5HAR/RuA0nVeoZZoIXhb3tSC6MhgMCLZrNoFjf87SSy',
        0,
        40
    ),
    (
        'Lucas',
        'Pérez Alonso',
        'pelucas',
        '$2y$10$cmzVxkOi27PtuOq8uc0psOx7GVVRnyylOZuFhhj7dOZXGKGArSLV2',
        0,
        30
    ),
        (
        'María',
        'Gómez López',
        'gomaria',
        '$2y$10$ZItZRykt0UorVoJmvpMWie3800PgnIyOHMb8ceh6/wEUhA7inxTP.',
        0,
        40
    ),
        (
        'Laura',
        'Navarro Ruiz',
        'nalaura',
        '$2y$10$WQhJPRm.x.5mqyyQXi085.gTHWedbIP.nGCZjUiLnxgMckkYWG0py',
        0,
        40
    ),
        (
        'Iván',
        'Sánchez Morales',
        'moivan',
        '$2y$10$aN3n3.8o8viUfl2nWtaDn.8k9XG5iugRPKVg4E3eLpMrWV.ZRkVFa',
        0,
        40
    ),
        (
        'Elena',
        'Castro Díaz',
        'caelena',
        '$2y$10$nRgQ95zrDUTzLWg9fD9SiODLlb1isdpvQRLHe/pI2M0iicw4kOssu',
        0,
        40
    );
INSERT INTO `zonas` (`nombre`, `limites`)
VALUES (
        'Nave de Abaixo',
        '{ "type": "Feature", "geometry": { "type": "Polygon", "coordinates": [[ [-8.777390060286876, 41.94046402564837], [-8.777195631354033, 41.93955288817489], [-8.775821666892796, 41.93995301893324], [-8.776184600901132, 41.94061347023447], [-8.777390060286876, 41.94046402564837] ]] }, "properties": {} }'
    ),
    (
        'Nave de Copas',
        '{ "type": "Feature", "geometry": { "type": "Polygon", "coordinates": [[ [-8.777125229797349, 41.940776264516956], [-8.777089611966488, 41.94056872919663], [-8.776163548362405, 41.94063937959385], [-8.776300083381415, 41.94084691468424], [-8.777125229797349, 41.940776264516956] ]] }, "properties": {} }'
    ),
    (
        'Nave Carretera',
        '{ "type": "Feature", "geometry": { "type": "Polygon", "coordinates": [[ [-8.776710811980422, 41.941202073499284], [-8.777068196755067, 41.94092167272851], [-8.777063301073099, 41.940812425341335], [-8.776299574706513, 41.94086704905857], [-8.776446445161497, 41.94111467598887], [-8.776710811980422, 41.941202073499284] ]] }, "properties": {} }'
    ),
    (
        'Tollo Rhodos',
        '{ "type": "Feature", "geometry": { "type": "Polygon", "coordinates": [[ [-8.771697311566726, 41.93780293545936], [-8.771625563576293, 41.93672215883703], [-8.770450690215341, 41.93648865530895], [-8.770549343703209, 41.93790300644221], [-8.771697311566726, 41.93780293545936] ]] }, "properties": {} }'
    ),
    (
        'Tollo Hortensia',
        '{ "type": "Feature", "geometry": { "type": "Polygon", "coordinates": [[ [-8.770510904411111, 41.93790054303523], [-8.770407871940051, 41.93648263684801], [-8.770128212373436, 41.936444314621525], [-8.769811755494544, 41.93647168764255], [-8.770003101513936, 41.93793338990912], [-8.770510904411111, 41.93790054303523] ]] }, "properties": {} }'
    ),
    (
        'Tollo Exterior',
        '{ "type": "Feature", "geometry": { "type": "Polygon", "coordinates": [[ [-8.769951585277795, 41.93793338990912], [-8.769767598720847, 41.93648263684801], [-8.769487939154232, 41.93652095905102], [-8.769097887653004, 41.936696145973116], [-8.768685757765496, 41.936789213829826], [-8.768869744322416, 41.93805382830223], [-8.769951585277795, 41.93793338990912] ]] }, "properties": {} }'
    ),
    (
        'Tollo Vello',
        '{ "type": "Feature", "geometry": { "type": "Polygon", "coordinates": [[ [-8.76884522014683, 41.93805224194173], [-8.768668975600889, 41.93679218734184], [-8.76799826718846, 41.93699248670248], [-8.767640882413872, 41.93701069570395], [-8.767812231278612, 41.93813964365003], [-8.76884522014683, 41.93805224194173] ]] }, "properties": {} }'
    ),
    (
        'Tollo Novo',
        '{ "type": "Feature", "geometry": { "type": "Polygon", "coordinates": [[ [-8.767724109005627, 41.9381360019145], [-8.767714317641719, 41.937698992152406], [-8.767611508322858, 41.93766621629928], [-8.767596821277749, 41.93717821827491], [-8.767288393321934, 41.93717821827491], [-8.767307976049011, 41.9381469271199], [-8.767724109005627, 41.9381360019145] ]] }, "properties": {} }'
    ),
    (
        'Tollo Vello-Novo',
        '{ "type": "Feature", "geometry": { "type": "Polygon", "coordinates": [[ [-8.767278601958054, 41.9381760609927], [-8.767263914912888, 41.93717093469385], [-8.766593206500488, 41.93718550185511], [-8.766617684909505, 41.93820155312048], [-8.767278601958054, 41.9381760609927] ]] }, "properties": {} }'
    ),
    (
        'Invernadero da Rosa',
        '{ "type": "Feature", "geometry": { "type": "Polygon", "coordinates": [[ [-8.764921265607995, 41.93837480835515], [-8.764861453999771, 41.93792180026975], [-8.765421508151803, 41.93788944242607], [-8.765301884934502, 41.93653444298943], [-8.764747268201575, 41.93657084633534], [-8.76474183078247, 41.93648186034142], [-8.764127402441346, 41.93650208444177], [-8.764306837266815, 41.93841930004763], [-8.764921265607995, 41.93837480835515] ]] }, "properties": {} }'
    );
INSERT INTO `zonas_parcelas` (`num_parcela`, `descripcion`, `id_zona`)
VALUES (101, 'Parcela 101', 1),
    (102, 'Parcela 102', 1),
    (103, 'Parcela 103', 1),
    (104, 'Parcela 104', 1),
    (105, 'Parcela 105', 1),
    (101, 'Parcela 101', 2),
    (102, 'Parcela 102', 2),
    (103, 'Parcela 103', 2),
    (200, 'Parcela 200', 3),
    (201, 'Parcela 201', 3),
    (202, 'Parcela 202', 3),
    (203, 'Parcela 203', 3),
    (01, 'Parcela 01', 5),
    (02, 'Parcela 02', 5),
    (01, 'Parcela 01', 6),
    (02, 'Parcela 02', 6),
    (03, 'Parcela 03', 6),
    (101, 'Parcela 101', 7),
    (201, 'Parcela 201', 8),
    (202, 'Parcela 202', 8),
    (01, 'Parcela 01', 10),
    (02, 'Parcela 02', 10),
    (03, 'Parcela 03', 10),
    (04, 'Parcela 04', 10);