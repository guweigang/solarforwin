<?php
class Acme_Cli_MakeApp extends Solar_Cli_MakeApp
{
    protected function _setup()
    {
        $this->_outln("Hello, world!");
    }
    protected function _postExec()
    {

    }
}
