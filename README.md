# Example Plugin

[![Total Downloads](https://img.shields.io/packagist/dt/veronalabs/plugin.svg)](https://packagist.org/packages/veronalabs/plugin)
[![Latest Stable Version](https://img.shields.io/packagist/v/veronalabs/plugin.svg)](https://packagist.org/packages/veronalabs/plugin)


## About
Example WordPress Plugin Based on [Rabbit Framework](https://github.com/veronalabs/rabbit)

## Requirements

1. PHP 7.4 or higher.
2. Composer

## Usage

```bash
composer require veronalabs/plugin
```

## Development

If you are planning to add style to your plugin, make sure you have the following requirements:
```bash
node.js: <= v14.16.0
npm: <= 6.14.11
```

And run these commands:

**Install packages**
```bash
npm install
```

**Run the start command**
```bash
npm start
// or
npm run start
```

### Commands

```
"compile:scss" : Compiles scss files
"postcss:autoprefixer": Parses your CSS and adds vendor prefixes
"dev": Runs "compile:scss" and "postcss:autoprefixer" in a sequence
"watch": Watches for changes in the /assets/src/scss/ folder and run "dev" command on every change
"start": Runs "dev" and "watch" commands concurrently
```