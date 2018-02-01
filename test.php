<?php

require_once __DIR__ . '/vendor/autoload.php';

use sekjun9878\MakePlugin\MakePlugin;

MakePlugin::makePlugin("./SampleOAuth","./build", MakePlugin::MAKEPLUGIN_COMPRESS);