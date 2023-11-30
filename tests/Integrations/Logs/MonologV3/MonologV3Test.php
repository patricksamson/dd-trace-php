<?php

namespace DDTrace\Tests\Integrations\Logs\MonologV3;

use DDTrace\Tests\Integrations\Logs\MonologV2\MonologV2Test;

class MonologV3Test extends MonologV2Test
{
    public function testDebugJsonFormatting() {
        $this->usingJson(
            'debug',
            $this->getLogger(true),
            '/^{"message":"A debug message","context":{},"level":100,"level_name":"DEBUG","channel":"test","datetime":".*","extra":{"dd.trace_id":"\d+","dd.span_id":"\d+","dd.service":"my-service","dd.version":"4.2","dd.env":"my-env"}}/'
        );
    }

    public function testLogJsonFormatting() {
        $this->usingJson(
            'log',
            $this->getLogger(true),
            '/^{"message":"A critical message","context":{},"level":500,"level_name":"CRITICAL","channel":"test","datetime":".*","extra":{"dd.trace_id":"\d+","dd.span_id":"\d+","dd.service":"my-service","dd.version":"4.2","dd.env":"my-env"}}/',
            false,
            'critical'
        );
    }
}
