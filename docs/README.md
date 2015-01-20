# Introduction

The TDD7 is a unit testing framework for Drupal 7. It is not used in the
production code, but instead to make writing unit tests much much easier and
faster. It's designed to work with PHPUnit, rather than the much slower default
simpletest framework.

# How it works

All unit tests need a predefined set of data to work with. In simple examples,
this data is provided as function arguments. In Drupal, this data often comes
from the database. When using simpletest, a replica of the drupal database
structure is provided with an alternate database prefix. When using TDD7, the
database and node structure is mocked up in software, which is much faster.

When using TDD7, production code is moved out of the root namespace into
individual namespaces, using stub functions.

*Example here*

When this function is being tested, a set of stub functions such as
*node_load()* that call the the mock framework is loaded in the same namespace
as the tested function. The test data is loaded into the test framework.
When the tesed function is run, it will call the stub functions instead of the
core functions, and the apropriate mock data will be returned.

# Concepts

## Writing tests first
Summarise here, writing the top level requirement and working back from there,
and red / green testing. Refer to other documents here.

## Namespacing
Using namespaces is an imperative part of using the TDD7 framework. Production
code should live in it's own namespace, usually divided on a per module basis.
Functions and classes can have the same name if they reside in different
namespaces.

TODO: how call outs to global work.

References:
* http://php.net/manual/en/language.namespaces.php


## Stubs
Stubs are small pieces of code that call to namespaced production code.

	<?php
	function mymodule_theme($existing = array(), $type = '', $theme = '', $path = '') {
	  return \myorg\mymodule\mymodule_theme($existing, $type, $theme, $path);
	}


## Mocks
## Rigging
## 'Production code'

# Examples

# To Do

