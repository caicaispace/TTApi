<?php

namespace Core\Component\Version;


abstract class AbstractRegister
{
    abstract function register(VersionList $versionList);
}