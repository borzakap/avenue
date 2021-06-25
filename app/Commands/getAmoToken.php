<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use AmoCRM\Client\AmoCRMApiClient;

/**
 * Description of getAmoToken
 *
 * @author alexey
 */
class getAmoToken extends BaseCommand{
    protected $group = 'Amo';
    protected $name = 'amo:get_token';
    protected $description = "Authorization in Amo";
    protected $usage = "amo:get_token";
    protected $arguments = [];
    
    public function run(array $params = []){
        helper('amo');
        // get the AMO config
        $amoconf = config('Amo');
        // init Amo
        $apiClient = new AmoCRMApiClient($amoconf->clientId, $amoconf->clientSecret, $amoconf->redirectUri);
        // force the basedomain
        $apiClient->setAccountBaseDomain($amoconf->baseDomain);
        try {
            CLI::write(CLI::color("Try to get token", 'yellow'));

            $accessToken = $apiClient->getOAuthClient()->getAccessTokenByCode($amoconf->authorizationCode);

            if (!$accessToken->hasExpired()) {
                amo_save_token([
                    'accessToken' => $accessToken->getToken(),
                    'refreshToken' => $accessToken->getRefreshToken(),
                    'expires' => $accessToken->getExpires(),
                    'baseDomain' => $apiClient->getAccountBaseDomain(),
                ]);
            }
            
            CLI::write(CLI::color("Token saved", 'green'));

        } catch (\Exception $e) {
            
            $message = $e->getMessage();
            $code = $e->getCode();
            CLI::write(CLI::color("Error saving token. Code {$code} with Message: {$message}", 'red'));
        }
        
    }
}
