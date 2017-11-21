<?php

/**
 * Class TwitterHelper
 *
 * Provides basic functions for easier Twitter API usage
 * @property Cli_model $Cli
 * @property Twitter_model $Twitter
 */
class Maintenance extends CI_Controller {
  /**
   * Default maximum number of iterations
   */
  const DEFAULT_MAX_ITERATIONS = 150;

  /**
   * Default time to sleep if we should do multipleIterations
   */
  const SLEEP_TIME = 5;

  /**
   * Current number of iterations
   *
   * @type int
   */
  protected $currentIteration = 1;

  /**
   * The constructor loads the cli_model
   */
  public function __construct() {
    parent::__construct();

    $this->load->model('cli_model', 'Cli');
  }

  /**
   * Acquires a lock to ensure that only one quote-reader is in use at one time.
   *
   * @param string $method The name of the method requesting the lock.
   */
  protected function acquireLock($method) {
    $lock = $this->Cli->acquireLock(get_class($this), $method);

    if ($lock === false) {
      $this->Cli->log('Could not acquire lock');
      exit;
    }
  }

  /**
   * Releases a lock.
   * @param string $method The name of the method that requested the lock.
   */
  protected function releaseLock($method) {
    $this->Cli->releaseLock(get_class($this), $method);
  }

  /**
   * Called from CLI to loop through all known Twitter accounts
   *
   * @param bool $multipleIterations
   * @param int $maxIterations
   */
  public function updateTwitterFeeds($multipleIterations = false, $maxIterations = self::DEFAULT_MAX_ITERATIONS) {
    $this->load->model('cli/twitter_model', 'Twitter', true);
    $this->acquireLock('update');

    do {
      $this->currentIteration++;

      $this->Twitter->updateTweets();

      if ($multipleIterations && sleep(self::SLEEP_TIME) > 0) {
        //we got interrupted
        break;
      }
    } while ($multipleIterations && $this->currentIteration <= $maxIterations);

    $this->releaseLock('update');
  }

  public function updateInstagramFeeds($multipleIterations = false, $maxIterations = self::DEFAULT_MAX_ITERATIONS) {
    $this->load->model('cli/instagram_model', 'Instagram', true);
    $this->acquireLock('update');

    do {
      $this->currentIteration++;

      $this->Instagram->updateInstaFeeds();

      if ($multipleIterations && sleep(self::SLEEP_TIME) > 0) {
        //we got interrupted
        break;
      }
    } while ($multipleIterations && $this->currentIteration <= $maxIterations);

    $this->releaseLock('update');
  }

  public function updateCategorization() {
    $this->load->model('cli/categorization_model', 'Categorization', true);
    $this->Categorization->update();
  }
}
