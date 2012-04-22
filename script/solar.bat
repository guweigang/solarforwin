@echo off
rem -------------------------------------------------------------
rem  Solar command line script for Windows.
rem  This is the bootstrap script for running Solar on Windows.
rem  Author: roy - roy@solarphp.cn - http://roygu.com
rem  copyright (c) 2010 - http://solarphp.cn - http://solarphp.org.cn
rem -------------------------------------------------------------
set SCW_VERSION=1.1

@setlocal
rem --if the command-line parameter is -v, then print version infomation
if [%1]==[-v] GOTO:Version
if [%1]==[-h] GOTO:Help
if [%1]==[] GOTO:Help

rem --main process
set BIN_PATH=%~dp0
set CURR_SCRIPT=%~n0
for /f "delims=" %%a in (%BIN_PATH%phpenv.ini) do ( 
	for /f "tokens=1,2 delims==" %%b in ("%%a") do (
		set %%b=%%c
	)
)
if "%PHP_COMMAND%" == "" set PHP_COMMAND=%PHP_EXE% -c %PHP_INI%

if [%1]==[-phpv] GOTO:PHPV

%PHP_COMMAND% "%BIN_PATH%%CURR_SCRIPT%" %*
GOTO:EOF

:Version
@echo Solar CLI for Windows(SCW for short) %SCW_VERSION%.
@echo Copyright (c) 2010 Roy Gu - Solar Php In China.
GOTO:EOF

:Help
@echo Solar CLI Tools for Windows.
@echo Usage: solar [options] [target] ...
@echo Options:
@echo	-h			Soar CLI for Windows help infomation
@echo	-v			show version
@echo	help		        solar help system
@echo	-phpv		        get php version
@echo	make-vendor		make vendor
@echo	link-vendor		link vendor
@echo	make-app		make application
@echo	make-model		make model
@echo	link-public		link public symlink under docroot dir
@echo	make-cli		make cli
@echo	make-docbook	        make docbook
@echo	make-docs		make docs
@echo	make-tests		make tests
@echo	run-tests		run tests
@echo	unlink-vendor		unlink vendor
@echo	sync-vendor		sync vendor(only available for xp, 2000 and 2003)
GOTO:EOF

:PHPV
%PHP_COMMAND% -v
GOTO:EOF
@endlocal