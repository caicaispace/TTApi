<?php

namespace Library\Component\Version;


abstract class AbstractRegister
{
    abstract function register(VersionList $versionList);
}