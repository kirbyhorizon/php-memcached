--TEST--
Set options using setOptions
--SKIPIF--
<?php if (!extension_loaded("memcached")) print "skip"; ?>
--FILE--
<?php 
$m = new Memcached();

/* existing options */
var_dump($m->setOptions(array(
	Memcached::OPT_PREFIX_KEY => 'a_prefix',
	Memcached::OPT_SERIALIZER => Memcached::SERIALIZER_PHP,
	Memcached::OPT_COMPRESSION => 0,
	Memcached::OPT_LIBKETAMA_COMPATIBLE => 1,
)));

var_dump($m->getOption(Memcached::OPT_PREFIX_KEY) == 'a_prefix');
var_dump($m->getOption(Memcached::OPT_SERIALIZER) == Memcached::SERIALIZER_PHP);
var_dump($m->getOption(Memcached::OPT_COMPRESSION) == 0);
var_dump($m->getOption(Memcached::OPT_LIBKETAMA_COMPATIBLE) == 1);

echo "test invalid options";

var_dump($m->setOptions(array(
	-1 => 123
)));

--EXPECTF--
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
test invalid options
Warning: Memcached::setOptions(): error setting memcached option in %s on line %d
bool(false)
