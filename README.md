[![Build Status](https://travis-ci.org/Raffaello/recruitment-task.svg?branch=master)](https://travis-ci.org/Raffaello/recruitment-task)

[![codecov](https://codecov.io/gh/Raffaello/recruitment-task/branch/master/graph/badge.svg)](https://codecov.io/gh/Raffaello/recruitment-task)

# Recruitment task

The aim is to create a command line tool which reads data from a file, performs simple operation on this data and stores or prints a result. Input files could have different format (csv, yml, xml), but they contain the same data. The result could be stored in a plain text file or printed on stdout. Please see the input files (located in `data` directory) to check the data structure.

## Requirements

- Fork this repository.
- Bootstrap a project with Composer.
- Use PSR-4 for autoloading.
- Follow PSR-2 coding standard.
- Build the tool.
- Add some tests (any one of the following: unit/integration/functional in TDD/BDD style - it's up to you).
- Add very basic documentation in README.md (how to run the tool). You can replace this readme file.
- Push your code into your github account. Make it available for review.

## Logic

We should be able to run the tool from a command line and pass an input parameter and optional output parameter.

- Input parameter is a path to a file that should be processed.
- Output parameter is an optional path to the output file.
- If the output parameter is not provided the result should be printed to `stdout`.

The tool should parse the input file and output the result. The result is a simple sum of `value` property for every _active_ entity.

We should be able to run the tool something like:

```
$ php script.php data/file.yml

# outputs 900
```

or

```
$ php script.php --input="data/file.xml" --output="results/result.txt"

# creates results/result.txt and puts a number 900 as a content
```

## Assumptions

- File extension describes file type (*.csv, *.yml, *.xml).
- User always has to pass 1 or 2 parameters - input and optionally output.

## Recommendations

- Try to avoid using full stack frameworks (like Symfony or Laravel). Standalone libraries or components are obviously acceptable.
- Try to follow an OOP approach. Don't be afraid of "over-engineering" that tool. This task obviously is simple and could be done in a few lines of code but we're interested in your OOP knowledge.


### consideration on the implementation

- Used some symfony components to simplyfing the command and parsing
- csv file could be improved, now is it forced to have a specific ordered for the columns
- to process the file actually it would be better to parse and extract each user at time to use less memory
now is extracting everything and put in a array of users  (Users[]). 

### usage

- from the directory first run `composer install`
- then can run the test `./vendor/bin/phpunit -c .`
- run the command with eg `p src/main.php thirdbridge:file-reader data/file.csv`
