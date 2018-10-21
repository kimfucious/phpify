# PHPify

A live demo of this codebase can be found at http://phpify.abts.io.

I made this to remind myself that PHP is not WordPress and that I've forgotten more PHP than I remember.

Amazingly, PHP is to-date the 4th most popular programming language in the world.

![NyanCat](https://media.giphy.com/media/Rm9RzjSAfXm4o/giphy.gif)

Doing this, I was very happy to remember that PHP has **great** documentation.  And it's really hard *not* to find a solution to whatever problem you come across on Uncle Google.

I intentionally did not spend a lot of time on the UI, it's just a [Bootswatch](https://bootswatch.com/slate/) take on Bootstrap 4.

Also, there's zero JavaScript by design.

Normally, I'd write a bunch of test cases, and use those as I have in other coding exercise project, but I have completely forgotten how to PHPUnit works.  I may come back around and fill in the blanks.

## Usage

This repo is "Dockerized" in that you can clone it and launch the whole kit and kaboodle without having to install Apache or PHP on your local machine:

> :point_up:  You will need to have Docker on your local machine to do any of the below.  Go [here](https://www.docker.com), if you're not already good to go on that front.

1. Clone the repo
```shell
git clone https://github.com/kimfucious/phpify.git
```
2. Run the docker-compose command
```shell
docker-compose up
```
3.  Open your browser to http://localhost

When the party's over you can run:
```shell
docker-compose down
```

Life is good.  Enjoy!
