@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../vendor/phploc/phploc/phploc
php "%BIN_TARGET%" %*
