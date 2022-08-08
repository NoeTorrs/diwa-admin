<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include('aws/aws-autoloader.php');

use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Aws\Exception\AwsException;


class awslib{
     
    public function getdata(){
        $region = "ap-south-1";
        $key = "AKIA2W5CXRAPNGV24GHF";
        $secret = "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";
        $poolid = "ap-south-1_AnB6izelq";
        $appclient = "4ga1gv8d682brulvf5fijb1chn";
        $appsecret = "15j5ho6ekdtbsen4gfge49esousr74nn2k07dffdut1fcn81tfro";
        $args = [ 
                'credentials' => [
                    'key' => $key,
                    'secret' => $secret,
                ],
                'region' => $region,
                'version' => 'latest',
                'app_client_id' => $appclient,
                'app_client_secret' => $appsecret,
                'user_pool_id' => $poolid,
            ];
        $client = new CognitoIdentityProviderClient($args);	
		try {
			$result = $client->listUsers([
                'AttributesToGet' => ['email'],
				'UserPoolId' => $poolid, 
			]);
            return $result["Users"];
		} catch (AwsException $e) {
			// output error message if fails
			echo $e->getMessage()."\n";
			return error_log($e->getMessage());
		}
    }

    public function createUser($email){
        $region = "ap-south-1";
        $key = "AKIA2W5CXRAPNGV24GHF";
        $secret = "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";
        $poolid = "ap-south-1_AnB6izelq";
        $appclient = "4ga1gv8d682brulvf5fijb1chn";
        $appsecret = "15j5ho6ekdtbsen4gfge49esousr74nn2k07dffdut1fcn81tfro";
        $args = [ 
                'credentials' => [
                    'key' => $key,
                    'secret' => $secret,
                ],
                'region' => $region,
                'version' => 'latest',
                'app_client_id' => $appclient,
                'app_client_secret' => $appsecret,
                'user_pool_id' => $poolid,
            ];
        $client = new CognitoIdentityProviderClient($args); 
        try {
            $result = $client->adminCreateUser([
                'TemporaryPassword' => 'Temp@12345',
                'Username' => $email,
                'UserPoolId' => $poolid, 
                'UserAttributes' => []
            ]);
            return $result->toArray();
            // return "success";
        }catch (AwsException $e) {
            // output error
            return $e->toArray();
            // echo error_log($e->getMessage());
        }
    }

    public function confirmUser($email){
        $region = "ap-south-1";
        $key = "AKIA2W5CXRAPNGV24GHF";
        $secret = "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";
        $poolid = "ap-south-1_AnB6izelq";
        $appclient = "4ga1gv8d682brulvf5fijb1chn";
        $appsecret = "15j5ho6ekdtbsen4gfge49esousr74nn2k07dffdut1fcn81tfro";
        $args = [ 
                'credentials' => [
                    'key' => $key,
                    'secret' => $secret,
                ],
                'region' => $region,
                'version' => 'latest',
                'app_client_id' => $appclient,
                'app_client_secret' => $appsecret,
                'user_pool_id' => $poolid,
            ];
        $client = new CognitoIdentityProviderClient($args); 
        
        try {
            $result = $client->adminConfirmSignUp([
                'UserPoolId' => $poolid, // REQUIRED
                'Username' => $email, // REQUIRED
            ]);
            return $result->toArray();
        }catch (AwsException $e) {
            // output error
            return $e->toArray();
            // echo error_log($e->getMessage());
        }
    }

    public function deleteUser($email){
        $region = "ap-south-1";
        $key = "AKIA2W5CXRAPNGV24GHF";
        $secret = "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";
        $poolid = "ap-south-1_AnB6izelq";
        $appclient = "4ga1gv8d682brulvf5fijb1chn";
        $appsecret = "15j5ho6ekdtbsen4gfge49esousr74nn2k07dffdut1fcn81tfro";
        $args = [ 
                'credentials' => [
                    'key' => $key,
                    'secret' => $secret,
                ],
                'region' => $region,
                'version' => 'latest',
                'app_client_id' => $appclient,
                'app_client_secret' => $appsecret,
                'user_pool_id' => $poolid,
            ];
        $client = new CognitoIdentityProviderClient($args); 
        
        try {
            $result = $client->adminDeleteUser([
                'UserPoolId' => $poolid, // REQUIRED
                'Username' => $email, // REQUIRED
            ]);
            return "success";
        }catch (AwsException $e) {
            // output error
            return $e->toArray();
            // echo error_log($e->getMessage());
        }
    }
    public function getUser($email){
        $region = "ap-south-1";
        $key = "AKIA2W5CXRAPNGV24GHF";
        $secret = "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";
        $poolid = "ap-south-1_AnB6izelq";
        $appclient = "4ga1gv8d682brulvf5fijb1chn";
        $appsecret = "15j5ho6ekdtbsen4gfge49esousr74nn2k07dffdut1fcn81tfro";
        $args = [ 
                'credentials' => [
                    'key' => $key,
                    'secret' => $secret,
                ],
                'region' => $region,
                'version' => 'latest',
                'app_client_id' => $appclient,
                'app_client_secret' => $appsecret,
                'user_pool_id' => $poolid,
            ];
        $client = new CognitoIdentityProviderClient($args); 
        
        try {
            $result = $client->adminGetUser([
                'UserPoolId' => $poolid, // REQUIRED
                'Username' => $email, // REQUIRED
            ]);            
            return $result->toArray();
        }catch (AwsException $e) {
            // output error
            return $e->toArray();
            // echo error_log($e->getMessage());
        }
    }   



    public function setUserPassword($email){
        $region = "ap-south-1";
        $key = "AKIA2W5CXRAPNGV24GHF";
        $secret = "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";
        $poolid = "ap-south-1_AnB6izelq";
        $appclient = "4ga1gv8d682brulvf5fijb1chn";
        $appsecret = "15j5ho6ekdtbsen4gfge49esousr74nn2k07dffdut1fcn81tfro";
        $args = [ 
                'credentials' => [
                    'key' => $key,
                    'secret' => $secret,
                ],
                'region' => $region,
                'version' => 'latest',
                'app_client_id' => $appclient,
                'app_client_secret' => $appsecret,
                'user_pool_id' => $poolid,
            ];
        $client = new CognitoIdentityProviderClient($args); 
        
        try {
            $result = $client->adminSetUserPassword([
                    'Password' => 'Temp@12345', // REQUIRED
                    'Permanent' => true,
                    'UserPoolId' => $poolid, // REQUIRED
                    'Username' => $email, // REQUIRED
                ]);
            return $result->toArray();
        }catch (AwsException $e) {
            // output error
            return $e->toArray();
            // echo error_log($e->getMessage());
        }
    }
    
}

?>