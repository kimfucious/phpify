<?php
/**
 *  An exercise to different sorting methods:
 *  bubble sort, selection sort, and merge sort
 *
 * PHP version 7.2
 *
 * @category Education
 * @package  Sortify
 * @author   kimfucious <code@abts.io>
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License v3
 * @link     https://github.com/kimfucious/phpify.git
 */

session_start();
$_SESSION["page"] = "Sorting";
require_once "includes/common_functions.php";

/**
 * Sort a given array with bubble sort
 *
 * @param array $arr : array from cleaned user provided series of values
 *
 * @return array
 */
function bubbleSort($arr)
{
    for ($i = 0; $i < count($arr); $i++) {
        for ($j = 0; $j < ((count($arr) - $i) - 1); $j++) {
            if ($arr[$j] > $arr[$j + 1]) {
                $bigger = $arr[$j];
                $arr[$j] = $arr[$j + 1];
                $arr[$j + 1] = $bigger;
            }
        }
    }
    return $arr;
}

/**
 * Sort a given array with selection sort
 *
 * @param array $arr : array from cleaned user provided series of values
 *
 * @return array
 */
function selectionSort($arr)
{
    for ($i = 0; $i < count($arr); $i++) {
        $indexOfMin = $i;

        for ($j = $i + 1; $j < count($arr); $j++) {
            if ($arr[$j] < $arr[$indexOfMin]) {
                $indexOfMin = $j;
            }
        }

        if ($indexOfMin !== $i) {
            $lesser = $arr[$indexOfMin];
            $arr[$indexOfMin] = $arr[$i];
            $arr[$i] = $lesser;
        }
    }
    return $arr;
}

/**
 * Performs a merge sort using recursion
 *
 * @param array $arr : array from cleaned user provided series of values
 *
 * @return func
 */
function mergeSort($arr)
{
    if (count($arr) === 1) {
        return $arr;
    }

    $center = floor(count($arr) / 2);
    $left = array_slice($arr, 0, $center);
    $right = array_slice($arr, $center);

    return merge(mergeSort($left), mergeSort($right));
}

/**
 * Performs a merge sort using recursion
 *
 * @param array $left  : left slice array from mergeSort function
 * @param array $right : right slice array from mergeSort function
 *
 * @return array
 */
function merge($left, $right)
{
    $results = [];

    while (count($left) > 0 && count($right) > 0) {
        if ($left[0] < $right[0]) {
            array_push($results, array_shift($left));
        } else {
            array_push($results, array_shift($right));
        }
    }
    return array_merge($results, $left, $right);
}
/**
 * Clean a string and return an array of integers
 *
 * @param string $str   : user provided series of values
 * @param string $regex : regular expression used to clean string
 *
 * @return array
 */
function makeArray($str, $regex)
{
    $str = preg_replace($regex, "", $str);
    return explode(",", $str);

}

if (filter_has_var(INPUT_POST, "submit")) {
    $regex = "/^,|[^0-9,]|,{2,}|,$/";
    $arr = makeArray($_POST["string1"], $regex);
    $str = preg_replace($regex, "", $_POST["string1"]);
    if (!empty($str)) {
        $bubbleStart = microtime($get_as_float = true);
        $bubbleArray = bubbleSort($arr);
        $bubbleEnd = microtime($get_as_float = true);
        $bubbleTime = round((($bubbleEnd - $bubbleStart) * 1000), 9);
        $selectStart = microtime($get_as_float = true);
        $selectArray = selectionSort($arr);
        $selectEnd = microtime($get_as_float = true);
        $selectTime = round((($selectEnd - $selectStart) * 1000), 9);
        $mergeStart = microtime($get_as_float = true);
        $mergeArray = mergeSort($arr);
        $mergeEnd = microtime($get_as_float = true);
        $mergeTime = round((($mergeEnd - $mergeStart) * 1000), 9);
    } else {
        $msg = "Please enter something.";
        setFormDanger($msg);
    }
}

?>
<?php require_once "includes/header.php"?>
<?php require_once "includes/breadcrumbs.php"?>
  <div class="container d-flex flex-column mt-3">
  <h1 class="display-4 text-center">Sortify</h1>
  <form action="<?php echo $_SERVER["PHP_SELF"] ?>"
        class="mb-3"
        method="POST"
        style="min-width: 300px;"
        >
    <div class="form-group <?php echo $formGroupClass ?>">
      <label
        class="form-control-label text-info"
        for="string1">
        Array
      </label>
      <input
        class="form-control transparent-input <?php echo $formFieldClass ?>"
        type="text"
        name="string1"
        placeholder="[9,8,7,6,5,4,3,2,1]"
        value=
        "<?php echo isset($_POST["string1"]) ? $str : "" ?>"
      />
      <div class="<?php echo $feedbackClass ?>"><?php echo $fieldMessage ?>
        <?php if (!$hideHelperText): ?>
          <small
          class="form-text text-muted">
          Enter a series of numbers separated by commas.
          The square brackets are optional.
          </small>
        <?php endif;?>
      </div>
    </div>
    <br />
      <button
        class="btn btn-block btn-outline-info border border-info"
        name="submit"
        type="submit">
        SORTIFY
        </button>
        <button
          class="btn btn-block btn-outline-secondary border border-secondary"
          name="reset"
          type="submit">
          RESET
        </button>
        <div class="mt-3">
            <?php if (isset($mergeArray)): ?>
                <h6 class="text-info">Results<h6>
                <ul class="list-group border border-info">
                    <li class="list-group-item text-center">
                      Bubble Sort
                      <small>
                        <br />
                        <?php echo "completed in $bubbleTime milliseconds" ?>
                      </small>
                    </li>
                    <li class= "list-group-item text-center">
                      <code><?php print_r($bubbleArray)?></code>
                    </li>
                    <li class="list-group-item text-center">
                      Merge Sort
                      <small>
                        <br />
                        <?php echo "completed in $mergeTime milliseconds" ?>
                      </small>
                    </li>
                    <li class= "list-group-item text-center">
                      <code><?php print_r($mergeArray)?></code>
                    </li>
                    <li class="list-group-item text-center">
                      Selection Sort
                      <small>
                        <br />
                        <?php echo "completed in $selectTime milliseconds" ?>
                      </small>
                    </li>
                    <li class= "list-group-item text-center">
                      <code><?php print_r($selectArray)?></code>
                    </li>
                </ul>
            <?php endif;?>
        </div>
      </div>
    </div>
  </form>
<?php require_once "includes/footer.php"?>
