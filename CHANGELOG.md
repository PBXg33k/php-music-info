# Change Log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased] - N/A

## [0.0.4] - 2017-04-02
### Added
- PHP 7 Support, supported PHP 5.6 and above
- Command line tools (using symfony/command)
    - Lookup artist `music-info:search:artist <name> [<service>]`
    - Lookup track `music-info:search:track <name> [<service>]`
- Models
    - Album
- Spotify
    - Track

### Changed
- HTTP Proxy Header vulnerability fix

## [0.0.3]
### Added
- Spotify
    - Album

### Changed
- Dependencies
- _internal_ Unit tests

### Removed
- **PHP 5.5 Support**

## [0.0.2] - 2016-12-01
### Added
- Spotify
	- Tracks

### Changed
- Improved tests

## 0.0.1 - 2016-05-16
### Added
- Core
- VocaDB
	- Artist
- Spotify
	- Artist
- Unit tests

[Unreleased]: https://github.com/PBXg33k/php-music-info/compare/v0.0.4...HEAD
[0.0.4]: https://github.com/PBXg33k/php-music-info/compare/v0.0.3...v0.0.4
[0.0.3]: https://github.com/PBXg33k/php-music-info/compare/v0.0.2...v0.0.3
[0.0.2]: https://github.com/PBXg33k/php-music-info/compare/v0.0.1...v0.0.2
