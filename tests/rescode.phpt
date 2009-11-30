--TEST--
Memcached result codes.
--SKIPIF--
<?php if (!extension_loaded("memcached")) print "skip"; ?>
--FILE--
<?php
$m = new Memcached();
echo $m->getResultMessage(), "\n";

$m->addServer('127.0.0.1', 11211, 1);
echo $m->getResultCode(), "\n";
echo $m->getResultMessage(), "\n";

$m->set('bar_foo', 10);
echo $m->getResultMessage(), "\n";

$m->delete('bar_foo');
echo $m->getResultMessage(), "\n";

$m->delete('bar_foo');
echo $m->getResultCode(), "\n";
echo $m->getResultMessage(), "\n";

$m->getMulti(array('asdf_a', 'jkhjkhjkb', 'nbahsdgc'));
echo $m->getResultMessage(), "\n";
$code = $m->getResultCode();

$m2 = new Memcached();
$m2->getMulti(array('asdf_a', 'jkhjkhjkb', 'nbahsdgc'));
echo $m2->getResultCode(), "\n";
echo $m2->getResultMessage(), "\n";

$m2->addServer('127.0.0.1', 7312, 1);
echo $m2->getResultCode(), "\n";
echo $m2->getResultMessage(), "\n";

$m2->delete('bar_foo');
echo $m2->getResultCode(), "\n";
echo $m2->getResultMessage(), "\n";

var_dump($m->getResultCode() == $code);
$m = new Memcached('test1');
$m->addServer('127.0.0.1', 11211);
$m2 = new Memcached('test1');

$m->delete('moikkamitakuuluu');
echo $m->getResultMessage(), "\n";
$m2->set('minapaasetannih', 10, 1);
echo $m->getResultMessage(), "\n";
echo $m2->getResultMessage(), "\n";

$m->delete('bar_foo');
// clearly "NOT FOUND"
$m->delete('bar_foo');
$res_m = $m->getResultMessage();
echo $res_m, "\n";

$m2->set('bar_foo', 10);
echo $m->getResultMessage(), "\n";
echo $m2->getResultMessage(), "\n";

$m->delete('bar_foo');
echo $m->getResultMessage(), "\n";

?>
--EXPECTF--
SUCCESS
%d
SUCCESS
SUCCESS
SUCCESS
%d
NOT FOUND
SUCCESS
%d
NO SERVERS DEFINED
%d
SUCCESS
%d
SYSTEM ERROR%s
bool(true)
NOT FOUND
NOT FOUND
SUCCESS
NOT FOUND
NOT FOUND
SUCCESS
SUCCESS
