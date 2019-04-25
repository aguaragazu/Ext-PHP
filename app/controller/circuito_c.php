<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('circuito_m');
    $circuito = new Circuito();

    switch ($action) {
        case 'read':
            echo $circuito->read($_POST);
            break;
        case 'create':
            echo $circuito->create($_POST);
            break;
        case 'update':
            echo $circuito->update($_POST);
            break;
        case 'destroy':
            echo $circuito->destroy($_POST['data']);
            break;
        case 'edit':
          echo $circuito->edit($_POST['id'], $_POST);
          break;
    }
