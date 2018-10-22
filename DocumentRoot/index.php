<?php
/**
 * A collection of coding exercises done in PHP
 *
 * PHP version 7.2
 *
 * @category Education
 * @package  PHPify
 * @author   kimfucious <code@abts.io>
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License v3
 * @link     https://github.com/kimfucious/phpify.git
 */

session_start();
$_SESSION["page"] = "";

?>
<?php require_once "includes/header.php"?>
<?php require_once "includes/breadcrumbs.php"?>
<div class="container-fluid">
  <div class="jumbotron text-center">
    <h1 class="display-3">PHPify</h1>
    <p class="lead">Classic coding exercises done in PHP</p>
  </div>
  <div class="d-flex justify-content-center">
    <div
      class="list-group border border-info rounded text-center"
      style="flex-basis: 50%; min-width:300px;">
      <a href="anagrams.php" class="list-group-item list-group-item-action">
        Anagrams
      </a>
      <a href="capitalize.php" class="list-group-item list-group-item-action">
        Capitalize
      </a>
      <a href="chunk.php" class="list-group-item list-group-item-action">
        Chunk Array
      </a>
      <a href="fibonacci.php" class="list-group-item list-group-item-action">
        Fibonacci
      </a>
      <a href="maxchar.php" class="list-group-item list-group-item-action">
        MaxChar
      </a>
      <a href="palindrome.php" class="list-group-item list-group-item-action">
        Palindrome
      </a>
      <a href="reverseint.php" class="list-group-item list-group-item-action">
        Reverse Integer
      </a>
      <a href="vowels.php" class="list-group-item list-group-item-action">
        Vowels
      </a>
    </div>
  </div>
</div>
<?php require_once "includes/footer.php"?>
