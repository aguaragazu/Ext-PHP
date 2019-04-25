<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('socioeducativo_m');
    $socio = new Socioeducativo();

    switch ($action) {
        case 'getSocio':
            echo $socio->getSocio($_POST);
            break;
        case 'getActualizacion':
            echo $socio->getActualizacion($_POST['socio_id'], $_POST);
            break;
        case 'create':
            echo $socio->create($_POST);
            break;
        case 'update':
            echo $socio->update($_POST);
            break;
        case 'destroy':
            echo $socio->destroy($_POST['data']);
            break;
        case 'edit':
          echo $socio->edit($_POST['id'], $_POST);
          break;
    }
