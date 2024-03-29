<?php
namespace mission10\redirects\controllers;

use craft\web\Controller;
use mission10\redirects\Redirects;

class RedirectsController extends Controller {

    public function actionSave(){
        $req = \Craft::$app->getRequest();
        $session = \Craft::$app->getSession();

        $from = $req->getRequiredBodyParam(name:'fromURL');
        $to = $req->getRequiredBodyParam(name:'toURL');
        $subpages = $req->getRequiredBodyParam(name:'subpages');
        
        if(empty($from) || empty($to)){
            $session->setError("You haven't filled required fields");
        }else {
            $fromResult = $this->getPathFromUrl($from);

            $from = $subpages == true ? $fromResult['path'] . "($|\/(.*)$|\?.*|\/$|\/\?.*|$)" : $fromResult['path'] . "(\?.*|\/$|\/\?.*|$)";
            $to = $this->checkToUrl($to);

            $session->setNotice('Redirect Added');
        }
        
        Redirects::$plugin->redirects->save($from,$to);

    }

    private function checkToUrl($to){
        if($to == "/"){
            return $to . '$1';
        }else{
            $toResult = $this->getPathFromUrl($to);
            $to = $toResult['path'] . '$1';
            return $to;
        }
    }

    private function getPathFromUrl($url) {
        $parsedUrl = parse_url($url);
        $path = ltrim($parsedUrl['path'] ?? '/', '/');
        $query = $parsedUrl['query'] ?? '';

        return ['path' => $path, 'query' => $query];
    }

}