<?php

namespace App\Models;

use CodeIgniter\Model;

class SessionModel extends Model
{
    protected static $session;

    public static function startSession()
    {
        if (!isset(SessionModel::$session)) {
            SessionModel::$session = \Config\Services::session();
        }
    }

    public static function initClientSession($data)
    {
        SessionModel::startSession();
        if (is_array($data)) {
            SessionModel::$session->set($data);
        }
    }

    public static function initAdminSession($data)
    {
        SessionModel::startSession();
        if (is_array($data)) {
            SessionModel::$session->set($data);
        }
    }

    public static function destructSession()
    {
        SessionModel::startSession();
        $allData = SessionModel::getAllSessionData();
        if (!empty($allData['clientData'])) {
            foreach ($allData['clientData'] as $value) {
                SessionModel::$session->remove($value);
            }
        }
        if (!empty($allData['adminData'])) {
            foreach ($allData['adminData'] as $value) {
                SessionModel::$session->remove($value);
            }
        }
        SessionModel::$session->destroy();
    }
    

    public static function verifySession(): bool
{
    SessionModel::startSession();
    if (!isset(SessionModel::$session)) {
        return false;
    } elseif (isset(SessionModel::$session->logged_in_client) === true) {
        return true;
    } elseif (isset(SessionModel::$session->logged_in_admin) === true) {
        return true;
    } else {
        SessionModel::destructSession();
        return false;
    }
}

    public static function getSessionData($idChamp = '')
    {
        return SessionModel::$session->get($idChamp);
    }

    public static function setSessionData($tab)
    {
        SessionModel::startSession();
        if (is_array($tab)) {
            SessionModel::$session->set($tab);
        }
    }

    public static function getAllSessionData()
    {
        SessionModel::startSession();
        $clientData = [];
        $adminData = [];

        if (isset(SessionModel::$session->logged_in_client) && SessionModel::$session->logged_in_client === true) {
            $clientData = SessionModel::$session->get();
        }

        if (isset(SessionModel::$session->logged_in_admin) && SessionModel::$session->logged_in_admin === true) {
            $adminData = SessionModel::$session->get();
        }

        return [
            'clientData' => $clientData,
            'adminData' => $adminData
        ];
    }




    public static function removeSessionData($idChamp)
    {
        SessionModel::startSession();
        if (SessionModel::$session->has($idChamp)) {
            SessionModel::$session->remove($idChamp);
        }
    }


}
?>
