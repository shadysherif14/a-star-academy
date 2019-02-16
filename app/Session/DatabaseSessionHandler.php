<?php

namespace App\Session;
use Illuminate\Support\Facades\Route;


class DatabaseSessionHandler extends \Illuminate\Session\DatabaseSessionHandler
{
    
    public function write($sessionId, $data)
    {
        
        $payload = $this->getDefaultPayload($data);
        
        if (! $this->exists) {
            $this->read($sessionId);
        }

        if ($this->exists) {

            $this->performUpdate($sessionId, $payload);
        } else {
            $this->performInsert($sessionId, $payload);
            $this->getQuery()->where('id', $sessionId)->update([
                'user_type' => $this->currentSubdomain() ?? 'user']);
        }

        return $this->exists = true;
    }
    
    protected function currentSubdomain(){
        $url = url()->current();
        $urlArray = explode('.', $url);
    
        if (sizeof($urlArray) === 3 && $urlArray[1] === 'astaracademy') {
            $subdomainArray = explode('//', $urlArray[0]);
    
            $subdomain = $subdomainArray[1];
    
            return $subdomain;
        }
        return null;
    }

}