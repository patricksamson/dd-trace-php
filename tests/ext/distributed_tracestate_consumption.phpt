--TEST--
Distributed tracestate consumption should produce valid tracestate header
--ENV--
DD_TRACE_DEBUG_PRNG_SEED=42
DD_TRACE_128_BIT_TRACEID_GENERATION_ENABLED=1
--FILE--
<?php

$rawTracestate = 'rojo=00f067aa0ba902b7,dd=t.dm:-1;t.congo:t61rcWkgMzE';

$span = \DDTrace\start_span();

$parentId = $span->hexId();
$traceId = \DDTrace\root_span()->traceId;
$traceFlags = '01';
$traceParent = "00-$traceId-$parentId-$traceFlags";

\DDTrace\consume_distributed_tracing_headers([
    'traceparent' => $traceParent,
    'tracestate' => $rawTracestate,
]);

var_dump(\DDTrace\generate_distributed_tracing_headers(['tracecontext']));

?>
--EXPECTF--
array(2) {
  ["traceparent"]=>
  string(55) "00-%sc151df7d6ee5e2d6-a3978fb9b92502a8-01"
  ["tracestate"]=>
  string(75) "dd=t.tid:%s;t.dm:-1;t.congo:t61rcWkgMzE,rojo=00f067aa0ba902b7"
}
