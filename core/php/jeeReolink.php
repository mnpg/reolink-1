<?php

try {
    require_once dirname(__FILE__) . "/../../../../core/php/core.inc.php";

    if (!jeedom::apiAccess(init('apikey'), 'reolink')) {
        echo __('Vous n\'etes pas autorisé à effectuer cette action', __FILE__);
        die();
    }
    if (init('test') != '') {
        echo 'OK';
        die();
    }
    $result = json_decode(file_get_contents("php://input"), true);
    if (!is_array($result)) {
        die();
    }

    if (isset($result['message']) && $result['message'] == "motion") {
        $plugin = plugin::byId('reolink');
        $eqLogics = eqLogic::byType($plugin->getId());

        foreach ($eqLogics as $eqLogic) {
            $camera_contact_point = $eqLogic->getConfiguration('adresseip');
            $camera_AI = $eqLogic->getConfiguration('supportai');

            if (filter_var($camera_contact_point, FILTER_VALIDATE_IP)) {
              $camera_ip = $camera_contact_point;
            } else {
              $camera_ip = gethostbyname($camera_contact_point);
            }

            if ($camera_ip == $result['ip']) {
              log::add('reolink', 'debug', 'Evènement MotionState reçu depuis le daemon. Cam IP='.$result['ip'].' état='.$result['motionstate']);
              $eqLogic->checkAndUpdateCmd('MdState', $result['motionstate']);
              #log::add('reolink', 'debug', 'IP : ' . $camera_contact_point . ' / IsCamAI : ' . $camera_AI . ' / EqId : ' . $EqId . ' / Channel : ' . $channel);
              if ($camera_AI == "Oui") {
                  $camcnx = reolink::getReolinkConnection($eqLogic->getId());
                  $channel = $eqLogic->getConfiguration('channelNum') - 1;
                  $res = $camcnx->SendCMD('[{"cmd":"GetAiState","action":0,"param":{"channel":'.$channel.'}}]');
                  if (isset($res[0]['value'])) {
                    $eqLogic->checkAndUpdateCmd('MdPersonState', $res[0]['value']['people']['alarm_state']);
                    $eqLogic->checkAndUpdateCmd('MdVehicleState', $res[0]['value']['vehicle']['alarm_state']);
                  }
                  log::add('reolink', 'debug', 'Cam AI : Evènements Motion | Personne : ' . $res[0]['value']['people']['alarm_state'] . ' / Vehicule : ' . $res[0]['value']['vehicle']['alarm_state']);
              }
            }
          }
    } elseif (isset($result['message']) && $result['message'] == "subscription") {
        if ($result['state'] == 0) {
          $title = 'Plugin Reolink';
          $message = 'Notification de détection de mouvement indisponible sur la caméra : ' . $result['ip'] . ' ( Détails : ' . $result['details'] . ')';
          message::add($title, $message);
        }
    } else {
        log::add('reolink', 'error', 'unknown message received from daemon');
    }
} catch (Exception $e) {
    log::add('reolink', 'error', displayException($e));
}
?>
