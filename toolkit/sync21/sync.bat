@echo off
rem -------------------------------------------------------------
rem  sync.bat - Windows batch file for convenient execution of Sync
rem  use force default
rem  Author: roy - roy@solarphp.cn - http://roygu.com
rem  copyright (c) 2010 - http://solarphp.cn - http://solarphp.org.cn
rem -------------------------------------------------------------

@setlocal
rem --set bin path
set BIN_PATH=%~dp0

rem --run it
java -jar "%BIN_PATH%sync.jar"  --force %*
@endlocal