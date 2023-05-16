<?php

namespace mission10\redirects\services;

use craft\base\Component;
use mission10\redirects\records\RedirectsRecord;

class RedirectsService extends Component {

    public function save($from,$to){
        
        $record = new RedirectsRecord();

        $record->order = null;
        $record->uri = $from;
        $record->to = $to;

        $record->save();
    }
}