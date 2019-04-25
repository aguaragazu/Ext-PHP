<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('escuela_m');
    $escuela = new Escuela();

    switch ($action) {
        case 'read':
            echo $escuela->read($_POST);
            break;
        case 'create':
            echo $escuela->create($_POST);
            break;
        case 'update':
            echo $escuela->update($_POST);
            break;
        case 'destroy':
            echo $escuela->destroy($_POST['data']);
            break;
        case 'edit':
          echo $escuela->edit($_POST['id'], $_POST);
          break;
    }
