# Change Log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]
### Added
- PHP 7 Support, supported PHP 5.6 and above
- Command line tools (using symfony/command)
    - Lookup artist (music-info:search:artist <name> [<service>])
- Models
    - Album
- Spotify
	- Album

### Changed
- HTTP Proxy Header vulnerability fix
- Dependencies
- _internal_ Unit tests (aiming for 100% coverage)

### Removed
- **PHP 5.5 support**

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

[Unreleased]: https://github.com/PBXg33k/php-music-info/compare/v0.0.2...HEAD
[0.0.2]: https://github.com/PBXg33k/php-music-info/compare/v0.0.1...v0.0.2
