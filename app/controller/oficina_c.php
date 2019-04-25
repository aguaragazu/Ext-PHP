<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('oficina_m');
    $office = new Oficina();

    switch ($action) {
        case 'read':
            echo $office->read($_POST);
            break;
        case 'create':
            echo $office->create($_POST);
            break;
        case 'update':
            echo $office->update($_POST);
            break;
        case 'destroy':
            echo $office->destroy($_POST['data']);
            break;
        case 'edit':
          echo $office->edit($_POST['id'], $_POST);
          break;
    }
