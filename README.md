[![Build Status](https://scrutinizer-ci.com/g/PBXg33k/php-music-info/badges/build.png?b=develop)](https://scrutinizer-ci.com/g/PBXg33k/php-music-info/build-status/develop) [![Latest Stable Version](https://poser.pugx.org/pbxg33k/music-info/v/stable)](https://packagist.org/packages/pbxg33k/music-info) [![Total Downloads](https://poser.pugx.org/pbxg33k/music-info/downloads)](https://packagist.org/packages/pbxg33k/music-info) [![Latest Unstable Version](https://poser.pugx.org/pbxg33k/music-info/v/unstable)](https://packagist.org/packages/pbxg33k/music-info) [![License](https://poser.pugx.org/pbxg33k/music-info/license)](https://packagist.org/packages/pbxg33k/music-info) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/PBXg33k/php-music-info/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/PBXg33k/php-music-info/?branch=develop) [![Code Coverage](https://scrutinizer-ci.com/g/PBXg33k/php-music-info/badges/coverage.png?b=develop)](https://scrutinizer-ci.com/g/PBXg33k/php-music-info/?branch=develop)

# MusicInfo Library #

This PHP library enables you to combine multiple music related API Services to lookup information about music. See [Supported Services](#services) to see which services are supported.

## Requirements ##
In order to use this library your environment MUST meet the following criteria:
* PHP 5.6 (or later)


## Installation ##

### Using Composer (recommended) ###
Add the music-info package to your `composer.json` file.

``` json
{
    "require": {
        "pbxg33k/music-info": "dev-master"
    }
}
```

Or via the command line in the root of your project's installation.

``` bash
$ composer require "pbxg33k/music-info"
```

This will install the latest stable version.

~~To try the latest features, add `master-dev` as version. But be warned, this branch is unstable and not intended for production use.~~ **During this development stage master-dev will have the latest stable development version untill 1.0.0 has been released**

### Without composer ###
1. Download this repository as a zip file.
2. Extract the content of the zip file to a directory in your application
3. Add files to your project
	* Map `pbxg33k/music-info` to this directory if your autoloader is PSR-4 compatible
	* Include `autoloader.php` to your project bootstrap if either you don't have an autoloader or your autoloader is not PSR-4 compatible

## Configuration ##

```yaml
music_info:
    init_services: false ## Automatically initialize services on load
    services:
        - VocaDB
        - Spotify
        # - Discogs
        # - MusicBrainz
    preferred_order:
        - Spotify
        - VocaDB
        # - MusicBrainz
    # Give a weight per service
    # This will be used to *guess* the correct
    # value if multiple services return different values
    service_weight:
        - { service: VocaDB, weigth: 10 }
        - { service: Spotify, weight: 20 }
    guzzle:
        proxy: null
    # General config shared across services
    # Mainly Guzzle
    defaults:
        guzzle:
            http:
                user_agent: 'your-app-name/0.0.1 +https://www.myawsomesite.com'
    service_configuration:
        # Service Specific config
        vocadb:
            language: Default # default, japanese, romaji, english
            start: 0
            max_entries: 10
            get_total_count: false
            name_match_mode: partials # auto, partial, exact, starts_with, words
        spotify:
            client_id: null # required for Spotify
            client_secret: null # required for Spotify
            redirect_uri: null
            scopes:
              - playlist-read-private
              - user-read-private
        discogs:
            throttle: true
        musicbrainz:
            application_name: PHPMusicInfo
            application_version: 0.0.1
            application_url: https://www.github.com/PBXg33k/php-music-info
```

## Services ##

|   | Version | General | Track | Artist | Album | Comments |
|---|:-------:|:-------:|:-----:|:------:|:-----:|:--------:|
|Spotify | 0.1 | :white_check_mark: | :heavy_multiplication_x: | :white_check_mark: | :heavy_multiplication_x: ||
|VocaDB  | 0.1 | :white_check_mark: | :heavy_multiplication_x: | :white_check_mark: | :heavy_multiplication_x: ||
|MusicBrains | 0.1 | :heavy_multiplication_x: | :heavy_multiplication_x: | :heavy_multiplication_x: | :heavy_multiplication_x: ||
|~~Echonest~~   | :heavy_multiplication_x: | :heavy_multiplication_x: | :heavy_multiplication_x: | :heavy_multiplication_x: | :heavy_multiplication_x: | Service cancelled in favor of Spotify [[1]](http://developer.echonest.com/docs/v4) |

## Changelog

Please see [CHANGELOG.md](CHANGELOG.md)


## License

Copyright (c) 2016 Oguzhan Uysal
This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program.  If not, see <http://www.gnu.org/licenses/>.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.