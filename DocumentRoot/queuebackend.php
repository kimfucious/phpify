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

require_once "includes/common_functions.php";
require_once "includes/queue_class.php";

echo $_POST["q"];
// echo json_encode($q);
// echo $q;
// $q->add($_POST["city"]);
// echo json_encode($q);
