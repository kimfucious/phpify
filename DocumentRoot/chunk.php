<?php
/**
 *  An exercise to demonstrate how to chunk an array
 *
 * PHP Version 5.6
 *
 * --- Directions
 * Given an array and chunk size, divide the array into many subarrays
 * where each subarray is of length size
 * --- Examples
 * chunk([1, 2, 3, 4], 2) --> [[ 1, 2], [3, 4]]
 * chunk([1, 2, 3, 4, 5], 2) --> [[ 1, 2], [3, 4], [5]]
 * chunk([1, 2, 3, 4, 5, 6, 7, 8], 3) --> [[ 1, 2, 3], [4, 5, 6], [7, 8]]
 * chunk([1, 2, 3, 4, 5], 4) --> [[ 1, 2, 3, 4], [5]]
 * chunk([1, 2, 3, 4, 5], 10) --> [[ 1, 2, 3, 4, 5]]
 *
 * @category Education
 * @package  Chunkify
 * @author   kimfucious <code@abts.io>
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License v3
 * @link     https://github.com/kimfucious/phpify.git
 */

session_start();
$_SESSION["page"] = "Chunk";
require_once "includes/common_functions.php";

/**
 * Create an nested array from the given string and chunk size.
 *
 * @param string $str       : user provided series of numbers
 * @param int    $chunkSize : user provided value used to determine chunk size
 *
 * @return array
 */
function chunkArray($str, $chunkSize)
{
    $arr = explode(",", $str);
    return array_chunk($arr, $chunkSize, false);
}

if (filter_has_var(INPUT_POST, "submit")) {
    $regex = "/^,|[^0-9,]|,{2,}|,$/";
    $str = preg_replace($regex, "", $_POST["string1"]);
    $chunkSize = preg_replace("/[\D]/", "", $_POST["string2"]);
    if (!empty($chunkSize) && !empty($str)) {
        $arr = chunkArray($str, $chunkSize);
    } else {
        $msg = "Please enter something in both fields.";
        setFormDanger($msg);
    }
}

?>
<?php require_once "includes/header.php"?>
<?php require_once "includes/breadcrumbs.php"?>
  <div class="container d-flex flex-column mt-3">
  <h1 class="display-4 text-center">Chunky Monkey</h1>
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
        placeholder="[1, 2, 3, 4, 5, 6, 7]"
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
    <div class="form-group <?php echo $formGroupClass ?>">
      <label
        class="form-control-label text-info"
        for="string2">
        Chunk Size
      </label>
      <input
        class="form-control transparent-input <?php echo $formFieldClass ?>"
        type="text"
        name="string2"
        placeholder="3"
        value=
        "<?php echo isset($_POST["string2"]) ? $chunkSize : "" ?>"
      />
      <div class="<?php echo $feedbackClass ?>"><?php echo $fieldMessage ?></div>
        <?php if (!$hideHelperText): ?>
          <small
          class="form-text text-muted">
          Enter the size of new arrays to be chunked
          </small>
        <?php endif;?>
    </div>
    <br />
      <button
        class="btn btn-block btn-outline-info border border-info"
        name="submit"
        type="submit">
        CHUNK
        </button>
        <button
          class="btn btn-block btn-outline-secondary border border-secondary"
          name="reset"
          type="submit">
          RESET
        </button>
        <div class="mt-3">
            <?php if (isset($arr)): ?>
                <h6 class="text-info">Results<h6>
                <ul class="list-group border border-info">
                <?php foreach ($arr as $child): ?>
                    <li class= "list-group-item d-flex justify-content-center
                                align-items-center">
                      <code><?php print_r($child)?></code>&nbsp;
                      <span class="badge badge-light">
                        <?php echo count($child) ?>
                      </span>
                    </li>
                <?php endforeach;?>
                </ul>
            <?php endif;?>
        </div>
      </div>
    </div>
  </form>
<?php require_once "includes/footer.php"?>
