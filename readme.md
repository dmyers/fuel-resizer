# Fuel Resizer Package

A super simple Image Resizer package for Fuel.

## About
* Version: 1.0.0
* Author: Derek Myers

## Installation

### Git Submodule

If you are installing this as a submodule (recommended) in your git repo root, run this command:

	$ git submodule add git://github.com/dmyers/fuel-resizer.git fuel/packages/resizer

Then you you need to initialize and update the submodule:

	$ git submodule update --init --recursive fuel/packages/resizer/

### Download

Alternatively you can download it and extract it into `fuel/packages/resizer/`.

## Usage

```php
Image_Resizer::resize('path/to/file.jpg', '48', '48');
```

## Updates

In order to keep the package up to date simply run:

	$ git submodule update --recursive fuel/packages/resizer/
