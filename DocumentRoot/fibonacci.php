<?php
/**
 *  A not-so-simple exercise to demonstrate how memoization using PHP
 *  to get the Nth entry from the fibonacci sequece using recursion
 *
 * PHP version 7.2
 *
 * Directions
 * Print out the Nth entry in the fibonacci series.
 * The fibonacci series is an ordering of numbers where
 * each number is the sum of the preceeding two.
 * For example, the sequence
 *  [0, 1, 1, 2, 3, 5, 8, 13, 21, 34]
 * forms the first ten entries of the fibonacci series.
 * Example:
 *   fib(4) === 3
 *
 * @category Education
 * @package  Fibonaccify
 * @author   kimfucious <code@abts.io>
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License v3
 * @link     https://github.com/kimfucious/phpify.git
 */

session_start();
$_SESSION["page"] = "Fibonacci";
require_once "includes/common_functions.php";

/**
 * Memoization function, using a cache to avoid O(2^n) performance issues.
 *
 * @param func $fn is received, and its args are stored in a cache so as to
 * reduce the number of function calls caused by the nature of recursion.
 *
 * @return int
 */
$memoize = function ($fn) {
    return function () use ($fn) {
        static $cache = [];
        $args = func_get_args();
        $key = md5(serialize($args));

        if (!isset($cache[$key])) {
            $cache[$key] = call_user_func_array($fn, $args);
        }
        return $cache[$key];
    };
};
/**
 * Fibonacci function.
 *
 * @param int $int is received and used in the well known pattern.
 * @param func &$fib is passed as a higher order function.
 * What's unique here is that $fib's innards are $memoize which takes
 * an anonymous function, which takes $fib, itself, as a argument.
 * It's like Fibonacci inception.
 *
 * @return int
 */
$fib = $memoize(
    function ($int) use (&$fib) {
        return ($int < 2) ? $int : $fib($int - 1) + $fib($int - 2);
    }
);

/**
 * Returns the ordinal suffix for a given integer
 *
 * @param int $int is used to figure out the ordinal suffix
 *
 * @return string
 */
function getSuffix($int)
{
    $j = $int % 10;
    $k = $int % 100;
    if ($j === 1 && $k !== 11) {
        return "st";
    } elseif ($j === 2 && $k !== 12) {
        return "nd";
    } elseif ($j === 3 && $k !== 13) {
        return "rd";
    } else {
        return "th";
    }
}

if (filter_has_var(INPUT_POST, "submit")) {
    $int = preg_replace("/[\D]/", "", $_POST["string1"]);
    if (!empty($int)) {
        $suffix = getSuffix($int);
        $start = microtime($get_as_float = true);
        $nth = $fib($int);
        $end = microtime($get_as_float = true);
        $time = round((($end - $start) * 1000), 4);
        if ($int > 92 && $int < 1477) {
            $msg = "The " . $int . $suffix . " value in the Fibonacci sequence can only be displayed as an exponential: $nth.
                Time to calculate: $time milliseconds.";
            setFormSuccess($msg);
        } elseif ($int > 1476) {
            $msg = "The " . $int . $suffix . " value in the Fibonacci sequence is too big to handle.";
            setFormDanger($msg);
        } else {
            $msg = "The " . $int . $suffix . " value in the Fibonacci sequence is $nth.
              Time to calculate: $time milliseconds.";
            setFormSuccess($msg);
        }
    } else {
        $msg = "Please enter something in the field.";
        setFormDanger($msg);
    }
}

?>
<?php require_once "includes/header.php"?>
<?php require_once "includes/breadcrumbs.php"?>
  <div class="container d-flex flex-column mt-3">
  <h1 class="display-4 text-center">Fibonaccify</h1>
  <form action="<?php echo $_SERVER["PHP_SELF"] ?>"
        class="mb-3"
        method="POST"
        style="min-width: 300px;"
        >
    <div class="form-group <?php echo $formGroupClass ?>">
      <label
        class="form-control-label text-info"
        for="String 1">
        Get the Nth value from the Fibonacci sequence
      </label>
      <input
        class="form-control transparent-input <?php echo $formFieldClass ?>"
        type="text"
        name="string1"
        placeholder="How many pairs of rabbits can be bred from one pair in a year?"
        value=
        "<?php echo isset($_POST["string1"]) ? $int : "" ?>"
      />
      <div class="<?php echo $feedbackClass ?>"><?php echo $fieldMessage ?></div>
        <?php if (!$hideHelperText): ?>
          <small
          class="form-text text-muted">
          Enter a number to be Fibonaccified
          </small>
        <?php endif;?>
    </div>
    <br />
      <button
        class="btn btn-block btn-outline-info border border-info"
        name="submit"
        type="submit">
        FIBONACCIFY
        </button>
        <button
          class="btn btn-block btn-outline-secondary border border-secondary"
          name="reset"
          type="submit">
          RESET INPUT
        </button>
      </div>
    </div>
  </form>
<?php require_once "includes/footer.php"?>
