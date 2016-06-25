#euro16
> A Cli tool to keep up to date with EURO - 2016

## Installation
1. First, install composer [follow the official link](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)
2. Download the package using Composer:
```
composer global require "sa7bi/euro16"
```
3. Make sure to place the `~/.composer/vendor/bin` directory (or the equivalent directory for your OS) in your PATH so the `euro16` executable can be located by your system.
4. Finally, use `euro16` to use the tool.

## Functionnalities
- [x] `results` : list all availaible results
- [x] `results --team=XX` : list all availaible results for a given team
- [ ] `rank` : display all groups ranking
- [ ] `rank --group=X` : display ranking for a specific group