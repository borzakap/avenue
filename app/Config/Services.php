<?php

namespace Config;

use CodeIgniter\Config\BaseService;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService {

    /**
     * breadcrumb instance
     * @param type $getShared
     * @return \App\Libraries\Breadcrumb
     */
    public static function breadcrumb($getShared = true) {
        if ($getShared) {
            return static::getSharedInstance('breadcrumb');
        }

        return new \App\Libraries\Breadcrumb();
    }
    
    /**
     * language manipulation librarie instance
     * @param type $getShared
     * @return \App\Libraries\LangChanger
     */
    public static function translation($getShared = true){
        if ($getShared) {
            return static::getSharedInstance('translation');
        }
        return new \App\Libraries\LangChanger();
    }

    /**
     * phone service
     * @param string $phone
     * @return boolean
     */
    public static function phone($getShared = true){
        if ($getShared) {
            return static::getSharedInstance('phone');
        }
        return \libphonenumber\PhoneNumberUtil::getInstance();
    }

}
