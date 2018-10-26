<?php
/**
 * Demonstrate queue behavior using Class methods
 *
 * PHP Version 5.6
 *
 * --- Description
 * Create a queue data structure.  The queue
 * should be a class with methods 'add' and 'remove'.
 * Adding to the queue should store an element until
 * it is removed
 * --- Examples
 *     const q = new Queue();
 *     q.add(1);
 *     q.remove();  // returns 1;
 *
 * @category Education
 * @package  Queueify
 * @author   kimfucious <code@abts.io>
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License v3
 * @link     https://github.com/kimfucious/phpify.git
 */

session_start();
$_SESSION["page"] = "Queue";
require_once "includes/common_functions.php";

class Queue
{
    public $data = [];
    public function add($record)
    {
        array_unshift($this->data, $record);
    }
    public function remove()
    {
        array_pop($this->data);
    }
}

$q = new Queue();

function checkQueue($q)
{
    global $queueIsEmpty;
    if (count($q) < 1) {
        $queueIsEmpty = true;
    } else {
        $queueIsEmpty = false;
    }
}

checkQueue($q->data);

if (array_key_exists("add", $_POST)) {
    $str1 = ucwords(strtolower(quasiClean($_POST["string1"])));
    if (!empty($str1)) {
        if (array_key_exists("add", $_POST)) {
            $q->add($str1);
            $_POST = array();
            checkQueue($q->data);
        }
    } else {
        $msg = "Please enter something in the field.";
        setFormDanger($msg);
    }
}
if (array_key_exists("remove", $_POST)) {
    if (count($q->data) > 1) {
        $q->remove();
        checkQueue($q->data);
    }
}
?>
<?php require_once "includes/header.php"?>
<?php require_once "includes/breadcrumbs.php"?>
  <div class="container d-flex flex-column mt-3">
    <h1 class="display-4 text-center">Queueify</h1>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>"
          class="mb-3"
          method="POST"
          style="min-width: 300px;"
          >
      <div class="form-group <?php echo $formGroupClass ?>">
        <label
          class="form-control-label text-info text-center"
          for="string1">
          Location
        </label>
        <input
          class="form-control transparent-input <?php echo $formFieldClass ?>"
          type="text"
          name="string1"
          placeholder="Madrid"
          value=
          "<?php echo isset($_POST["string1"]) ? $str1 : "" ?>"
        />
        <div class="<?php echo $feedbackClass ?>"><?php echo $fieldMessage ?>
            <?php if (!$hideHelperText): ?>
              <small
              class="form-text text-muted">
              Enter the name of a city to add to the queue.
              </small>
            <?php endif;?>
        </div>
      </div>
      <div class="d-flex justify-content-center">
        <button
          class="btn btn-outline-info border border-info"
          name="add"
          onclick=<?php call_user_func($q->add, 'fuck')?>
          style="margin:5px"
          type="submit">
          ADD
        </button>
        <button
          class="btn btn-outline-danger border border-danger"
          disabled=<?php echo $queueIsEmpty ?>
          name="remove"
          style="margin:5px"
          type="submit">
          REMOVE
        </button>
        <button
          class="btn btn-outline-secondary border border-secondary"
          name="reset"
          style="margin:5px"
          type="submit">
          RESET
        </button>
      </div>
      <br />
      <div>
        <ul class="list-group border border-info">
            <?php if ($queueIsEmpty): ?>
              <li class="list-group-item text-center text-warning">
              The queue is empty!
              </li>
            <?php else: ?>
            <?php foreach ($q->data as $item): ?>
              <li class="list-group-item text-center"><?php echo $item ?></li>
            <?php endforeach;?>
            <?php endif;?>
        </ul>
      </div>
      </div>
    </form>
    <?php print_r($_POST)?>
    <br />
    <?php print_r($q)?>
    <br />
    <?php var_dump($str1)?>
  </div>
<?php require_once "includes/footer.php"?>
