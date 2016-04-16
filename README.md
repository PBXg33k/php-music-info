# MusicInfo Library #

This PHP library enables you to combine multiple music related API Services to lookup information about music. See [Supported Services](#services) to see which services are supported.

## Requirements ##
In order to use this library your environment MUST meet the following criteria:
* PHP 5.6 (or later)


## Installation ##

### Using Composer (recommended) ###
Simply run `composer require pbxg33k/music-info`.
This will install the latest stable version.

To try the latest features, add `master-dev` as version. But be warned, this branch is unstable and not intended for production use.

### Without composer ###
1. Download this repository as a zip file.
2. Extract the content of the zip file to a directory in your application
3. Add files to your project
	* Map `pbxg33k/music-info` to this directory if your autoloader is PSR-4 compatible
	* Include `autoloader.php` to your project bootstrap if either you don't have an autoloader or your autoloader is not PSR-4 compatible

## Configuration ##



## Services ##

|   | Version | General | Track | Artist | Album |
|---|:-------:|:-------:|:-----:|:------:|:-----:|
|Spotify | 0.1 | X | X | X | X |
|VocaDB  | 0.1 | X | X | X | X |
|MiscBrainz | 0.1 | X | X | X | X |
|Echonest   | 0.1 | X | X | X | X |